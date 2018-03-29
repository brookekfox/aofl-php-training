CREATE DATABASE testdb;

CREATE TABLE testdb.parent (
  email     VARCHAR(30),
  name      VARCHAR(30),
  parent_id INT(10) AUTO_INCREMENT PRIMARY KEY
);

CREATE TABLE testdb.dog (
  name      VARCHAR(30),
  parent_id INT(10),
  dog_id INT(10) AUTO_INCREMENT PRIMARY KEY
);

CREATE TABLE testdb.parent_payment_type (
  payment_type           VARCHAR(30),
  parent_id              INT(10),
  parent_payment_type_id INT(10) AUTO_INCREMENT PRIMARY KEY
);

DESC testdb.transaction;

INSERT INTO testdb.parent (email, name) VALUES ('brooke@parent.com', 'Brooke'), ('mike@parent.com', 'Mike'), ('joey@parent.com', 'Joey');

INSERT INTO testdb.dog (parent_id, name) VALUES (1, 'Tina'), (2, 'Lizzie');
INSERT INTO testdb.dog (parent_id, name) VALUES (1, 'Sandy');

ALTER TABLE testdb.parent ADD parent_id INT(10) AUTO_INCREMENT PRIMARY KEY;

SELECT name, count(*) as count FROM testdb.dog GROUP BY name;

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
