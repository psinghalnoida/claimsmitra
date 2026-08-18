#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/../.." && pwd)"
cd "${ROOT_DIR}"

echo "Installing PHP dependencies..."
if [[ -f composer.phar ]]; then
  php composer.phar install --no-interaction --no-progress --prefer-dist
elif command -v composer >/dev/null 2>&1; then
  composer install --no-interaction --no-progress --prefer-dist
else
  echo "Composer not found; vendor directory must already be present." >&2
fi

"${ROOT_DIR}/.cursor/scripts/setup-database.sh"

echo "Install complete."
