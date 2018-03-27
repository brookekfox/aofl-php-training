CREATE DATABASE testdb;

CREATE TABLE testdb.parent (
  email     VARCHAR(30),
  name      VARCHAR(30),
  parent_id INT(10) AUTO_INCREMENT PRIMARY KEY
);

CREATE TABLE testdb.transaction (
  transaction_amount DECIMAL,
  transaction_date   DATE,
  payment_type       VARCHAR(10),
  parent_id          INT(10),
  transaction_id     INT(10) AUTO_INCREMENT PRIMARY KEY
);

CREATE TABLE testdb.parent_payment_type (
  payment_type           VARCHAR(30),
  parent_id              INT(10),
  parent_payment_type_id INT(10) AUTO_INCREMENT PRIMARY KEY
);

DESC testdb.transaction;

INSERT INTO testdb.parent
(email, name)
VALUES
  ('john@parent.com', 'John'),
  ('peter@parent.com', 'Peter'),
  ('mary@parent.com', 'Mary');

ALTER TABLE testdb.parent ADD parent_id INT(10) AUTO_INCREMENT PRIMARY KEY;

SELECT name, count(*) as count FROM testdb.parent_payment_type GROUP BY name;

SELECT
  name,
  COUNT(name) AS instances,
  GROUP_CONCAT(parent_id) AS ids
FROM testdb.parent_payment_type
GROUP BY name;

SELECT
  parent_id,
  COUNT(*) AS instance,
  GROUP_CONCAT(name) AS types
FROM testdb.parent_payment_type
GROUP BY parent_id
HAVING instance > 1;

ALTER TABLE testdb.parent ADD CONSTRAINT UNIQUE (email);

UPDATE testdb.parent SET name = 'Paul' WHERE parent_id = 4;

INSERT INTO testdb.parent
SET
  email = 'peter@parent.com',
  name = 'Pierre'
ON DUPLICATE KEY
UPDATE name = 'Pierre';

ALTER TABLE testdb.parent ADD INDEX (name);
