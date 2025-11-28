#!/usr/bin/env bash

set -euo pipefail

echo "Initializing DockerMagento2..."

# Move the shell to the directory where the script runs
cd "$(dirname "$0")" || exit 1

echo "Searching for magento-docker to run init..."
if [[ -x magento-docker ]]; then
  yes | ./magento-docker init || true
else
  echo "Did not find it magento-docker :-("
  exit 1
fi

echo "Clearing previous db key..."
rm -f ../app/etc/env.php

echo "Cloud deploy and post-deploy..."
./magento-docker ece-deploy
./magento-docker ece-post-deploy

echo "INIT COMPLETE"

exit 0