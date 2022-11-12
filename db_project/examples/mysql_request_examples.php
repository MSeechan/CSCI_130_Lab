<?php

// Some examples for MySQL queries:
// Check refrences from: 
// https://dev.mysql.com/doc/refman/5.7/en/functions.html
// 

// Select the max value for a columm
$r = mysql_query("SELECT MAX(age) AS age FROM Person;");

// Select the minimum value for a column
$r = mysql_query("SELECT MIN(age) AS age FROM Person;");


// Find the number, dealer, and price of the most expensive article
$r = mysql_query("SELECT article, dealer, price FROM   shop
				  WHERE  price=(SELECT MAX(price) FROM shop);");
				  
$r = mysql_query("SELECT article, dealer, price FROM shop ORDER BY price DESC LIMIT 1;");

$r = mysql_query("SELECT s1.article, s1.dealer, s1.price 
				  FROM shop s1 LEFT JOIN shop s2 
				  ON s1.price < s2.price 
				  WHERE s2.article IS NULL;");
		  

//ON: join tables ON a column, a set of columns, or a condition. 
// Example:

$r = mysql_query("SELECT * FROM address.city JOIN address.county ON (city.countycode = address.code) WHERE ... ");

// USING: useful when both tables share a column of the exact same name on which they join. 
// Example

$r = mysql_query("SELECT director FROM film JOIN film_actor USING (film_id) WHERE ..."); 

// You dont need to fully qualify the joining columns:

// with USING:
// product_id is not prefixed
$r = mysql_query("SELECT product.name, product_id 
FROM product JOIN custumers USING (product_id)
WHERE ...");

// with ON:
// product.product_id is required here
$r = mysql_query("SELECT product.name, product.product_id 
FROM product JOIN custumers ON (product.product_id = custumers.product_id)
WHERE ...");				  




// LEFT JOIN
// : select rows from the both left and right tables that are matched,
// + all rows from the left table (t1) even with no matching rows found in the right table (t2)
$r = mysql_query("SELECT t1.c1, t1.c2, t2.c1, t2.c2
FROM    t1    LEFT JOIN t2 ON t1.c1 = t2.c1;");

// join the t1 table to the t2 table using the LEFT JOIN clause
// if a row from the left table t1 matches a row from the right table t2 based on the join condition ( t1.c1 = t2.c1 )
// -> this row will be included in the result set.
// If the row in the left table does not match with the row in the right table,
// then the row in the left table is also selected and combined with a fake row from the right table.
// The fake row contains NULL for all corresponding columns in the SELECT clause.


// Left join
// t1= A1     t2=F2    result= A1 null
//     B1        B2            B1 B2 
//     C1        C2            C1 C2 

// RIGHT JOIN = opposite order of the tables

// t1= A1     t2=F2    result= null F2
//     B1        B2            B1 B2 
//     C1        C2            C1 C2 


// CROSS JOIN: the Cartesian product of rows from the joined tables
// INNER JOIN: matches rows in one table with rows in other tables and allows you to query rows that contain columns from both tables.

// Products with the same name are removed (same name but different years or other properties)
$r = mysql_query("SELECT DISTINCT name FROM product ORDER BY name");


// Creation of a table --> PRIMARY INDEX KEY as a number !
// VARCHAR fields as primary keys are slower


// Warning:
// NULL columns require additional space in the row to record whether their values are NULL. 
// For MyISAM tables, each NULL column takes one bit extra, rounded up to the nearest byte
// (MyISAM: the default storage engine for the MySQL relational database management system)


// We want to retrieve only 1 single row !
// if it is found, when stop the search 

// Solution 1
// what NOT to do:
$r = mysql_query("SELECT * FROM user WHERE city = 'Fresno'");
if (mysql_num_rows($r) > 0) {
    // ...
}
 
// Solution 2
// Better solution:
// the database engine will stop scanning for records after it finds just 1, instead of going through the whole table or index.
$r = mysql_query("SELECT 1 FROM user WHERE city = 'Fresno' LIMIT 1");
if (mysql_num_rows($r) > 0) {
    // ...
}


// We want to access only 1 element from the array given as an output

// Solution 1
// what NOT to do:
$r = mysql_query("SELECT username FROM user ORDER BY RAND() LIMIT 1");
 
// Solution 2
// Better solution:
$r = mysql_query("SELECT count(*) FROM user");
$d = mysql_fetch_row($r);
$rand = mt_rand(0,$d[0] - 1);
 
$r = mysql_query("SELECT username FROM user LIMIT $rand, 1");


// Always specify which columns you need when you are doing your SELECT
// if you need only one column, then just specify the column you need

// Solution 1
// not preferred
$r = mysql_query("SELECT * FROM user WHERE user_id = 1");
$d = mysql_fetch_assoc($r);
echo "Welcome {$d['username']}";
 
// Solution 2 
// Better solution:
$r = mysql_query("SELECT username FROM user WHERE user_id = 1");
$d = mysql_fetch_assoc($r);
echo "Welcome {$d['username']}";

// Store IP address:
// xxx.xxx.xxx.xxx = 12+3 = 15
// --> VARCHAR(15) field 
// IP addresses as integer values with an INT = 4 bytes of space and have a fixed size field

// Knowledge about the number of elements in a table
// Primary key : from INT to TINYINT


?>