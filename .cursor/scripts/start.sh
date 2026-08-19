#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/../.." && pwd)"
SOCKET="/run/mysqld/mysqld.sock"

ensure_mysql_socket() {
  sudo mkdir -p /run/mysqld /var/run/mysqld
  sudo chown mysql:mysql /run/mysqld /var/run/mysqld
  if [[ -S "${SOCKET}" && ! -e /var/run/mysqld/mysqld.sock ]]; then
    sudo ln -sf "${SOCKET}" /var/run/mysqld/mysqld.sock
  fi
}

ensure_mysql_socket

echo "Starting MariaDB if needed..."
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
    echo "MariaDB is ready."
    exit 0
  fi
  sleep 1
done

echo "MariaDB failed to become ready." >&2
exit 1
