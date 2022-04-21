## JSONB_CONTAINS function in DQL


Database: PostgreSQL

This function uses the `@>` operator, which checks if the first parameter contains the right one.

## Description
```
JSONB_CONTAINS(haystack, needle)
```


**haystack** - Data from the jsonb field in which the search is performed.

**needle** - json string to search
 

##Example

Table

| id | data                                                                      |
|----|----------------------------------------------------------------------------|
| 1  | [{"id":1,"email":"info@example.com"},{"id":2,"email":"info2@example.com"}] |
| 2  | [{"id":4,"email":"info4@example.com"},{"id":5,"email":"info5@example.com"}] |


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
| 2  | [{"id":4,"email":"info4@example.com"},{"id":5,"email":"info5@example.com"}] |
