# JsonbDql


Doctrine Query Language functions for working with the Jsonb type for databases such as: PostgreSQL


Supported functions
------------
| Database   | Function      |
|------------|----------------|
| PostgreSQL | [JSONB_CONTAINS](docs/PostgreSQL/JSONB_CONTAINS.md) | 


Installation
------------
```
composer require emrdev/jsonb-dql
```




#### Example of registering the desired functions 
```
# config\packages\doctrine.yaml
doctrine: 
    orm:
        dql:
            string_functions:
                JSONB_CONTAINS: Emrdev\JsonbDql\Doctrine\PostgreSQL\JsonbContains
```

If you are using DoctrineExtensions with Symfony read [How to Register custom DQL Functions](https://symfony.com/doc/current/doctrine/custom_dql_functions.html).
