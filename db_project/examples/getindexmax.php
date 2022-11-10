<?php
// CSci 130 - Web Programming
$mydata=file_get_contents("mydatabase.json");
// convert the string into JSON object
$mydata=json_decode($mydata);
$l=count($mydata); // number of elements in the collection
echo $l;
?>