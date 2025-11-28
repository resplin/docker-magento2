# docker-magento2
Docker / Magento2 Local Development Setup

# Testing
## Integration
### Setup test DB
```sql
CREATE DATABASE magento2_integration_tests;
CREATE USER 'magento2'@'%' IDENTIFIED BY 'magento2';
GRANT ALL PRIVILEGES ON magento2_integration_tests.* TO 'magento2'@'%';
```
### Setup PHPUnit
`dev/tests/integration/phpunit.xml.dist`

- Copy `dev/tests/integration/etc/install-config-mysql.php.dist` copy to `dev/tests/integration/etc/install-config-mysql.php`
- Add test DB credentials

## Unit
`dev/tests/unit/phpunit.xml.dist`

# Commands
| Command                                  | Notes                                                                                                                                                                            |
|------------------------------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `vendor/bin/ece-docker build:compose`    | Regenerates the `docker-compose.yml` configuration file and overwrites existing. Custom configurations across builds by adding settings to a `docker-compose.override.yml` file. |
| `vendor/bin/ece-docker build:compose -h` | View available build options.                                                                                                                                                    |
|                                          |                                                                                                                                                                                  |
|                                          |                                                                                                                                                                                  |
|                                          |                                                                                                                                                                                  |

# Notes
Custom PHP configuration file:

`cp .docker/config.php.dist .docker/config.php`






