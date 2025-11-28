#!/usr/bin/env bash

set -euo pipefail

echo "Setting up test db..."

# Move the shell to the directory where the script runs
cd "$(dirname "$0")" || exit 1

docker-compose exec db sh -c 'mysql -u root -p$MYSQL_PASSWORD $MYSQL_DATABASE -e "CREATE DATABASE IF NOT EXISTS magento2_integration_tests; GRANT ALL PRIVILEGES ON magento2_integration_tests.* TO '\''magento2'\''@'\''%'\''; FLUSH PRIVILEGES;"'

echo "Done."

exit 0;