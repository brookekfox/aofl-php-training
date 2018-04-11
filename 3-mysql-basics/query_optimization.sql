
# CREATE TABLE `transaction` (
#   `transaction_amount` decimal(10,0) DEFAULT NULL,
#   `transaction_date` date DEFAULT NULL,
#   `payment_type` varchar(10) DEFAULT NULL,
#   `transaction_id` int(10) NOT NULL AUTO_INCREMENT,
#   `parent_id` int(10) DEFAULT NULL,
#   PRIMARY KEY (`transaction_id`)
# ) ENGINE=InnoDB
# 
INSERT INTO my_rdb.transaction
(transaction_amount,transaction_date,payment_type,parent_id)
SELECT 20,FROM_UNIXTIME(RAND() * (1514678400 - 1483228800) + 1483228800) as 'transaction_date'
,CASE(FLOOR(RAND() * (5-1) +1)) WHEN 1 THEN 'Visa' WHEN 2 THEN 'MC' WHEN 3 THEN 'Amex' WHEN 4 THEN 'Discover' ELSE 2 END as 'payment_type'
, FLOOR(RAND() * (5-1) +1) as 'parent_id'
FROM my_rdb.transaction a join my_rdb.transaction b
LIMIT 200000;


SELECT count(1) FROM my_rdb.transaction;

EXPLAIN SELECT * from my_rdb.transaction;

desc my_rdb.transaction;


# Show all transactions for the first quarter
SELECT transaction_date,transaction_amount,payment_type
FROM my_rdb.transaction
WHERE transaction_date BETWEEN '2017-01-01' AND '2017-03-31'
ORDER BY transaction_date;

# Show all transaction count for each payment type for the second quarter
SELECT payment_type,count(1) as 'instances'
FROM my_rdb.transaction
WHERE transaction_date BETWEEN '2017-04-01' AND '2017-06-30'
GROUP BY payment_type;

DESC my_rdb.transaction;

SHOW INDEX FROM my_rdb.transaction;

# Show all transaction count for payment_types Visa and MC
# for parent ids 1 and 4 for the second quarter
SELECT payment_type,count(1) as 'instances'
FROM my_rdb.transaction
WHERE parent_id IN(1,4)
AND transaction_date BETWEEN '2017-04-01' AND '2017-06-30'
AND payment_type IN('Visa','MC')
GROUP BY payment_type;


# Add index to my_rdb.transaction
ALTER TABLE my_rdb.transaction
ADD INDEX(parent_id);

# Drop index for parent_id
ALTER TABLE my_rdb.transaction
DROP INDEX parent_id;

# Add index transaction_date
ALTER TABLE my_rdb.transaction
ADD INDEX(transaction_date);

# Add compound index to my_rdb.transaction
ALTER TABLE my_rdb.transaction
ADD INDEX(transaction_date,parent_id,payment_type);


FLUSH QUERY CACHE;

# Show all transaction count 
# for parent ids 1 for the second quarter
EXPLAIN SELECT payment_type,count(1) as 'instances'
FROM my_rdb.transaction
WHERE parent_id IN(1)
GROUP BY payment_type;


# Show all transaction count 
# for parent ids 1 and 4 for Apr 1
EXPLAIN SELECT payment_type,count(1) as 'instances'
FROM my_rdb.transaction
WHERE parent_id IN(1)
AND transaction_date = '2017-04-01'
GROUP BY payment_type;


# Show all transaction count 
# for parent ids 1 and 4 for the second quarter
EXPLAIN SELECT payment_type,count(1) as 'instances'
FROM my_rdb.transaction
WHERE parent_id IN(1,4)
AND transaction_date BETWEEN '2017-04-01' AND '2017-06-30'
GROUP BY payment_type;

