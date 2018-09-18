Registration & Login Demo Project
===

##### Registration & Login Demo Code based on Symfony 4.1+ & PHP 7.2+

## Quickstart - Installation
- Download and **Install Docker**:
https://www.docker.com/community-edition#/download
- Execute: **git clone https://github.com/rakodev/sf4-registration-login.git**
- Execute: **cd sf4-registration-login/**
- Install Project:
```sh
sh ./setup.sh
```

#### Run the project
- **That's all!** Now you can open this address on your browser:
    - [http://localhost:8010/](http://localhost:8011/)
- PhpMyAdmin, You can see the Mysql Database:
    - [http://localhost:8013/](http://localhost:8013/)
    - username: **docker**
    - password: **docker**

## Docker Stop
```sh
docker-compose stop
```

# Improvements to do
- Build a User micro service
- Write Unit Tests
- Documentation with Swager 

## Project creation - Good to Know
```sh
docker-compose up -d
docker-compose exec --user www-data php-fpm-app bash -c 'cd /app && composer create-project symfony/website-skeleton .'
docker-compose exec --user www-data php-fpm-app bash -c 'cd /app && composer require guzzlehttp/guzzle symfony/orm-pack symfony/form symfony/security-bundle symfony/validator'
```


