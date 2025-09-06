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