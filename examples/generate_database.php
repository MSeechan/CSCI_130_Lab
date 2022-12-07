<?php
include 'student.php';

// Create a default database with 10 students
echo 'Generate database...<br>';
$nstudents=10;
$a0=array();
for ($i=0;$i<$nstudents;$i++) {
	echo '.....Create student '. $i . '<br>';
	$a0[$i]=new Student();
}

echo 'Save database...<br>';
// Open and create a file named mydatabase.json
$myfile = fopen("mydatabase.json","w");
$tmp=json_encode($a0,JSON_PRETTY_PRINT); // Dont use JSON_PRETTY_PRINT if you want to read a SINGLE line in the file !
fwrite($myfile,$tmp); // write the content in the file
fclose($myfile);
echo 'Done.';



$myfile = fopen("mydatabase1.json","w");
for ($i=0;$i<$nstudents;$i++) {
	$tmp=json_encode($a0[$i]); // Dont use JSON_PRETTY_PRINT if you want to read a SINGLE line in the file !
	fwrite($myfile,$tmp); // write the content in the file
	fwrite($myfile,"\r\n");
}
fclose($myfile);
echo 'Done.';



?>