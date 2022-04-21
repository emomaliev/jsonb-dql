## JSONB_CONTAINS function in DQL


Database: PostgreSQL

This function uses the `@>` operator, which checks if the first parameter contains the right one.

## Description
```
JSONB_CONTAINS(haystack, needle)
```


**haystack** - Data from the jsonb field in which the search is performed.

**needle** - json string to search


## Initialization function in Doctrine
```
# config\packages\doctrine.yaml
doctrine: 
    orm:
        dql:
            string_functions:
                JSONB_CONTAINS: Emrdev\JsonbDql\Doctrine\PostgreSQL\JsonbContains
```
If you are using DoctrineExtensions with Symfony read [How to Register custom DQL Functions](https://symfony.com/doc/current/doctrine/custom_dql_functions.html).


## Example use

Table

| id | data                                                                      |
|----|----------------------------------------------------------------------------|
| 1  | [{"id":1,"text":"Hello world 1"},{"id":2,"text":"Hello world 2"}] |
| 2  | [{"id":4,"text":"Hello world 4"},{"id":5,"text":"Hello world 5"}] |


Query
```
     $queryBuilder->select('t')
            ->from('Table', 't')
            ->where("JSONB_CONTAINS(t.data, :search_json) = true") 
            ->setParameter('search_json', '[{"id":4}]');
```

Result

| id | data                                                                      |
|----|----------------------------------------------------------------------------| 
| 2  | [{"id":4,"text":"Hello world 4"},{"id":5,"text":"Hello world 5"}] |
