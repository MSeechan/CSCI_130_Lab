<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>CSci 130 - Web Programming </title>
<style>
	.error {color: #FF0000;}
</style>
</head>
<body>

<?php
include 'student.php';

$myarray=LoadDB();

// open  the file
function LoadDB() {
	$a=array();
	$k=0;
	$myfile = fopen("mydatabase1.json","r");
	while(!feof($myfile)) {
	  // $a[$k]=json_decode(fgets($myfile));
	  $a[$k]=new Student();
	  $a[$k]->Set(json_decode(fgets($myfile),true));
	  $k=$k+1;
	}
	fclose($myfile);
	return $a;
}

function SaveDB($a) {
	$myfile = fopen("mydatabase1.json","w");
	for ($i=0;$i<count($a);$i++) {
		$str=json_encode($a[i]);
		$str=$str . "\n";
		fwrite($myfile,$str);
	}
	fclose($myfile);
}

// Default values for the different fields
$first_name="unknown";
$last_name="unknown";
$address="";
$dob="";
$idnum="";
$gpa="";
$units="";

// Remark:
// name: identifier that is sent to the server when you submit the form (PHP)
// id: unique identifier for the browser, clientside (JS)

// Warning:
// The following things are considered to be empty:
// "" (an empty string)
// 0 (0 as an integer)
// "0" (0 as a string)
// NULL
// FALSE
// array() (an empty array)
// var $var; (a variable declared, but without a value in a class)
		
if ($_SERVER["REQUEST_METHOD"] == "POST") { // first check what is used to retrieve the information
	// check vindex from the HTML5 name NOT the HTML5 id !!!! 
	$vindex = (isset($_POST['vindex'])) ? $_POST['vindex'] : 0;
	   			
	$first_name=$myarray[$vindex]->GetFirstName();
	$last_name=$myarray[$vindex]->GetLastName();
	$dob=$myarray[$vindex]->GetDOB();
	$idnum=$myarray[$vindex]->GetID();
	$gpa=$myarray[$vindex]->GetGPA();
	$units=$myarray[$vindex]->current_units;
			
}

// Evaluate and normalize the different inputs
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);

?>

<h1>Student</h1>
<!-- the main form -->
<section>
<form method="post" action="index_v3.php">  
<table>
<tr><td>First Name: <?php echo $first_name; ?></td></tr>
<tr><td>Last Name: <?php echo $last_name; ?></td></tr>
<tr><td>Address: <?php echo $address ?></td></tr>
<tr><td>DOB: <?php echo $dob ?></td></tr>
<tr><td>ID number: <?php echo $idnum; ?></td></tr>
<tr><td>GPA: <?php echo $gpa ?></td></tr>
<tr><td>Units: <?php echo $units ?></td></tr>
<tr><td>Index: <input type="text" id="vindex" name="vindex" value="0"></td><tr>
<tr><td><input type="submit" name="submit" value="Submit"></td></tr>
</table> 
</form>
</section>

</body>
</html>