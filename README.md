LexikJWTAuthenticationBundle & JWTRefreshTokenBundle
=====================================


What's inside
--------------

- [Symfony](https://github.com/symfony/symfony) 4.4.37
- [LexikJWTAuthenticationBundle](https://github.com/lexik/LexikJWTAuthenticationBundle) ~2.4
- [JWTRefreshTokenBundle](https://github.com/markitosgv/JWTRefreshTokenBundle) 1.0

Get started
------------

Install dependencies and libraries:

```
$ sudo apt-get install php-sqlite3 
$ composer install
```

Create the database schema for users and refresh tokens tables:
```sh
$ php bin/console doctrine:database:create
$ php bin/console doctrine:schema:update --force
```

Regenerate keys
---------------
```sh
$ php bin/console lexik:jwt:generate-keypair
```
Your keys will land in config/jwt/private.pem and config/jwt/public.pem (unless you configured a different path).

Usage
------
Recommended enabling TLS for local server:
```sh
$ symfony server:ca:install
```


Run the web server:
```sh
$ php bin/console server:run
```
or if you have Symfony-cli
```sh
$ symfony server:start
```

Register a new user:
```
$ curl -X POST https://127.0.0.1:8000/register -d _username=johndoe -d _password=test
-> User johndoe successfully created
```

Get a JWT token:
```
$ curl -X POST -H "Content-Type: application/json" https://127.0.0.1:8000/login_check -d '{"username":"johndoe","password":"test"}'
-> { "token": "[TOKEN]", "refresh_token": "REFRESH_TOKEN" }  
```

Access a secured route (to url: /api):
```
$ curl -H "Authorization: Bearer [TOKEN]" https://127.0.0.1:8000/api
-> Logged in as johndoe
```
