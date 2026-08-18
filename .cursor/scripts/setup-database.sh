#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/../.." && pwd)"
SQL_DUMP="${ROOT_DIR}/localhost.sql"
DB_NAME="adwiti_claimsmitra_db"
DB_USER="adwiti_claimsmitra_db"
DB_PASS="ij9eSb4PFkPunwU"
SOCKET="/run/mysqld/mysqld.sock"

mysql_admin() {
  if mysqladmin ping --socket="${SOCKET}" --silent 2>/dev/null; then
    sudo mysql --socket="${SOCKET}" "$@"
  else
    sudo mysql "$@"
  fi
}

mysql_client() {
  mysql --socket="${SOCKET}" -u "${DB_USER}" -p"${DB_PASS}" "$@"
}

echo "Ensuring MariaDB is running..."
if ! mysqladmin ping --socket="${SOCKET}" --silent 2>/dev/null; then
  sudo mkdir -p /run/mysqld
  sudo chown mysql:mysql /run/mysqld
  if ! pgrep -x mariadbd >/dev/null 2>&1; then
    sudo mysqld_safe \
      --datadir=/var/lib/mysql \
      --socket="${SOCKET}" \
      --pid-file=/run/mysqld/mysqld.pid \
      >/tmp/claimsmitra-mysqld.log 2>&1 &
  fi
fi

for _ in $(seq 1 60); do
  if mysqladmin ping --socket="${SOCKET}" --silent 2>/dev/null; then
    break
  fi
  sleep 1
done

if ! mysqladmin ping --socket="${SOCKET}" --silent 2>/dev/null; then
  echo "MariaDB did not become ready." >&2
  exit 1
fi

mysql_admin -e "
CREATE DATABASE IF NOT EXISTS \`${DB_NAME}\` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
CREATE USER IF NOT EXISTS '${DB_USER}'@'localhost' IDENTIFIED BY '${DB_PASS}';
GRANT ALL PRIVILEGES ON \`${DB_NAME}\`.* TO '${DB_USER}'@'localhost';
FLUSH PRIVILEGES;
"

TABLE_COUNT="$(mysql_admin -N -e "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema='${DB_NAME}';")"
if [[ "${TABLE_COUNT}" == "0" ]]; then
  echo "Importing ${SQL_DUMP}..."
  mysql_admin "${DB_NAME}" < "${SQL_DUMP}"
else
  echo "Database ${DB_NAME} already initialized (${TABLE_COUNT} tables)."
fi

DB_CONFIG="${ROOT_DIR}/application/config/database.php"
if grep -q "'database' => 'testing_db'" "${DB_CONFIG}"; then
  sed -i "s/'database' => 'testing_db'/'database' => '${DB_NAME}'/" "${DB_CONFIG}"
fi

USER_COUNT="$(mysql_client "${DB_NAME}" -N -e "SELECT COUNT(*) FROM claims_users;" 2>/dev/null || echo 0)"
echo "Database ready with ${USER_COUNT} users."
