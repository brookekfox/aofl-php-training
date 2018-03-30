# CLASS 3 - MYSQL BASICS

- simplify data
- avoid duplication

### RELATIONAL DATABASE
- table relations and referential integrity are maintained by
  - primary keys - unique value stored in a table with its data i.e. user_id on user table
  - foreign keys - unique value stored in a table separate from its data i.e. path_id on user table
  - properly defined relation databases are "normalized"
  - normalization - slicing up data into pieces (tables) that relate
  - First Normal Form (1NF) - splitting up multiple values in a column into multiple rows
```
        user | hobbies                 user | hobbies
        -----------------------   =>   ---------------
        John | biking, swimming        John | biking
                                       John | swimming
```
  - Second Normal Form (2NF) - 1NF + no columns that relate to other columns
```
        name | park     | date visited | state
        --------------------------------------
        John | Yosemite | 1/1/18       | CA
```
    - here, state should be associated to the park via a key (park_id), not to the John row
    - park should be its own table
```
        name | date visited | park_id       id  | park     | state
        -----------------------------       ----------------------
        John | 1/1/18       | 123           123 | Yosemite | CA
```
  - Third Normal Form (3NF)
```
        name | park     | date visited | vehicle | mileage
        --------------------------------------------------
        John | Yosemite | 1/1/18       | minivan | 25 mpg
```
    - here, park, vehicle, and park_vehicle should all be their own tables
    - mileage should come from the combination park_vehicle table
```
        name | date visited | park_id | vehicle_id | park_vehicle_id
        ------------------------------------------------------------
        John | 1/1/18       | 123     | 456        | 789

        id  | vehicle       id  | park_id | vehicle_id | mileage
        -------------       ------------------------------------
        456 | minivan       789 | 123     | 456        | 25mpg
```

- you might want a non-relational database (NoSQL) if you're not sure what the data will look like (searching can be tougher and slower)

- information_schema is a default database created by mysql that describes all the databases
- mysql is a default database created by mysql that describes access levels, etc


### NOTES

##### DATA TYPES
- STRING(30) allocates space for 30 characters no matter what, VARCHAR(30) allocates the space needed (0-30 chars)
- DECIMAL is fine for keeping track of dollars, not great for calculations on numbers - don't use decimal precision calculations on for money - rather multiply by 100 and use INT
- DATE is a string, DATETIME is an integer, TIMESTAMP updates automatically (when the row is modified)

##### OTHER KEYWORDS
- AUTO_INCREMENT is based on all values ever created (not just the ones currently in the db)
- INDEX: storage in another location that is purely for finding things more easily - store just the column needed (and id) in a different column so that retrieval is much faster than returning the entire row of columns. indexing on name, for example, stores the rows in alphabetical order.
- EXPLAIN: keyword to use at the beginning of any query to show more information about it; it's good for debugging
