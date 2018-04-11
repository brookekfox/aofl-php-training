CREATE DATABASE my_rdb;

CREATE TABLE my_rdb.transaction (
  email              VARCHAR(30),
  transaction_amount DECIMAL,
  transaction_date   DATE,
  payment_type       VARCHAR(10)
);

CREATE TABLE my_rdb.parent
(
  email VARCHAR(30),
  name  VARCHAR(30)
);

CREATE TABLE my_rdb.parent_payment_type
(
  email VARCHAR(30),
  name  VARCHAR(30)
);

SHOW TABLES FROM my_rdb;

DESC my_rdb.parent;


INSERT INTO my_rdb.parent
SET

  email = 'john3@parent.com',
  name    = 'john';

SELECT *
FROM my_rdb.parent;


INSERT INTO my_rdb.parent
(email, name)
VALUES
  ('mary@parent.com', 'Mary'),
  ('peter@parent.com', 'Peter');


DELETE FROM my_rdb.parent
WHERE parent_id = 5;


ALTER TABLE my_rdb.parent
  ADD parent_id INT(10) AUTO_INCREMENT PRIMARY KEY;

INSERT INTO my_rdb.parent
(email, name)
VALUES
  ('peter@parent.com', 'Peter');


SELECT *
FROM my_rdb.parent_payment_type;

DESC my_rdb.parent_payment_type;

ALTER TABLE my_rdb.parent_payment_type
  ADD parent_payment_type_id INT(10) AUTO_INCREMENT PRIMARY KEY;

INSERT INTO my_rdb.parent_payment_type
(parent_id, name)
VALUES
  (1, 'Visa'),
  (1, 'MC'),
  (2, 'Visa'),
  (2, 'Amex'),
  (4, 'MC'),
  (4, 'Amex');

ALTER TABLE my_rdb.parent_payment_type
  ADD parent_id INT(10);

ALTER TABLE my_rdb.parent_payment_type
  DROP email;

UPDATE my_rdb.parent_payment_type
SET name = 'Discover'
WHERE parent_payment_type_id = 7;

CREATE TABLE my_rdb.profile
(
  email VARCHAR(30),
  name  VARCHAR(30),
  profile_id INT(10) AUTO_INCREMENT PRIMARY KEY,
  parent_id INT(10)
);

DESC my_rdb.profile;

SELECT *
FROM my_rdb.profile;

ALTER TABLE my_rdb.profile
  CHANGE column child_name name  VARCHAR(30)
;

INSERT INTO my_rdb.profile
(parent_id, name)
VALUES
  (1, 'Anna'),
  (1, 'Bobby'),
  (2, 'Tina'),
  (2, 'Rob'),
  (4, 'Madonna'),
  (4, 'Cher');

DESC my_rdb.transaction;

SELECT *
FROM my_rdb.transaction;

ALTER TABLE my_rdb.transaction
  ADD transaction_id INT(10) AUTO_INCREMENT PRIMARY KEY,
  ADD parent_id INT(10),
  DROP email;


INSERT INTO my_rdb.transaction
(transaction_amount, transaction_date, payment_type, parent_id)
VALUES
  (20, '2017-01-01', 'Visa', 1),
  (20, '2017-02-02', 'Amex', 2),
  (20, '2017-03-03', 'Discover', 4),
  (20, '2017-04-03', 'Discover', 4);


DESC my_rdb.parent;

SELECT
  parent_id,
  name
FROM my_rdb.parent
WHERE parent_id IN (2,3,4);

select * from my_rdb.profile;

explain SELECT
  p.name parent_name,
  pr.parent_id,
  pr.name child_name,
  pr.profile_id
FROM my_rdb.parent p
  JOIN my_rdb.profile pr
    ON p.parent_id = pr.parent_id
ORDER BY pr.name;

# Show latest profile created
SELECT
  pr.profile_id,
  pr.name
FROM my_rdb.profile pr
ORDER BY pr.profile_id DESC
LIMIT 1;

# Show unique payment types enabled by parent
# and show count of each instance of payment type
SELECT name,parent_id
FROM my_rdb.parent_payment_type;

SELECT name, count(*) as count
FROM my_rdb.parent_payment_type
group by name;


select 1,2,3;

SELECT
  name,
  1 as number,
  COUNT(name) AS Instances,
  GROUP_CONCAT(parent_id) AS ids
FROM my_rdb.parent_payment_type
GROUP BY name;


DESC my_rdb.parent_payment_type;

# Show parents that have more than two payment types
explain SELECT
  parent_id,
  COUNT(*) AS instance,
  GROUP_CONCAT(name)
FROM my_rdb.parent_payment_type
GROUP BY parent_id
HAVING instance > 2;

INSERT INTO my_rdb.parent_payment_type
SET name    = 'Discover',
  parent_id = 1;


DESC my_rdb.parent;

SELECT *
        FROM my_rdb.parent
;


INSERT INTO my_rdb.parent
SET email = 'mary@parent.com',
  name    = 'Mary';


ALTER TABLE my_rdb.parent
  ADD CONSTRAINT UNIQUE (email);

DELETE FROM my_rdb.parent
WHERE parent_id = 8;

# Update name for parent_id 4 from Peter to Paul
UPDATE my_rdb.parent
SET name = 'Paul'
WHERE parent_id = 4;

# Add peter@parent.com to parent.
# If email exists, update name to 'Pierre'
INSERT INTO my_rdb.parent
SET email = 'peter@parent.com',
  name    = 'Pierre'
ON DUPLICATE KEY
UPDATE name = 'Pierre';

# Add index to column parent.name
ALTER TABLE my_rdb.parent
  ADD INDEX (name);



