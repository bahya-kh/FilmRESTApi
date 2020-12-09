### Project description
    this is a REST API with Symfony 4, it allows CRUD to a Film Class.
### Setup project

```
- Composer
    composer install
- Create Database
    bin/console doctrine:database:create
- Create Migrations
    bin/console doctrine:migrations:generate
- Load Migrations
    bin/console doctrine:migrations:migrate
- load fixtures
    bin/console doctrine:fixtures:load
```
- run application
    symfony server:start
```