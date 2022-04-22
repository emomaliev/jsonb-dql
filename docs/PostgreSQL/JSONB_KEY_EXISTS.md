## JSONB_KEY_EXISTS function in DQL


Database: PostgreSQL 9.4+

This function uses `?` operator that checks if a string exists as a JSONB value key

## Description
```
JSONB_KEY_EXISTS(haystack, key)
```


**haystack** - jsonb data (not multidimensional, since the check occurs only on the top level).

**key** - string


## Initialization function in Doctrine
```
# config\packages\doctrine.yaml
doctrine: 
    orm:
        dql:
            string_functions:
                JSONB_KEY_EXISTS: Emrdev\JsonbDql\Doctrine\PostgreSQL\JsonbKeyExists
```
If you are using DoctrineExtensions with Symfony read [How to Register custom DQL Functions](https://symfony.com/doc/current/doctrine/custom_dql_functions.html).


## Example use

Table

| id | data                                                                      |
|----|----------------------------------------------------------------------------|
| 1  | {"id":1,"text":"Hello world 1"} |
| 2  | {"text":"Hello world 5"} |


Query
```
     $queryBuilder->select('t')
            ->from('Table', 't')
            ->where("JSONB_KEY_EXISTS(t.data, 'id') = true");
```

Result

| id | data                                                                      |
|----|----------------------------------------------------------------------------| 
| 1  | {"id":1,"text":"Hello world 1"} | 
