## JSONB_MERGE function in DQL


Database: PostgreSQL 9.4+

This function uses the `||` operator, which merge 2 json values into one

## Description
```
JSONB_MERGE(jsonb, jsonb)
```

 

## Initialization function in Doctrine
```
# config\packages\doctrine.yaml
doctrine: 
    orm:
        dql:
            string_functions:
                JSONB_MERGE: Emrdev\JsonbDql\Doctrine\PostgreSQL\JsonbMerge
```
If you are using DoctrineExtensions with Symfony read [How to Register custom DQL Functions](https://symfony.com/doc/current/doctrine/custom_dql_functions.html).


## Example use

Table

| id | data                             | second_data                    |
|----|----------------------------------|--------------------------------|
| 1  | {"id": 3, "text": "Hello World"} | {"id": 5, "desc": "Some text"} |



Query
```
     $queryBuilder
        ->select("JSONB_MERGE(t.data, t.second_data)");
            ->from('Table', 't');
```

Result

| column | 
|----| 
| {"id": 5, "desc": "Some text", "text": "Hello World"}|  


