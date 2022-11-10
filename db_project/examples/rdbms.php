<?php

include 'student.php';

// You need the key word global to use these variables in the functions
// You may create an object or an array that encapsulate all these variables

$servername = "localhost"; // default server name
$username = "hubert"; // user name that you created
$password = "Rc8piTPGijEkPKds"; // password that you created
//$dbname = "myDB";

// Create a database
function CreateDB($name) {
	global $servername, $username, $password;
	// Create connection
	$conn = new mysqli($servername, $username, $password);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error ."<br>");
	} 
	echo "Connected successfully <br>";
	// Creation of the database
	$sql = "CREATE DATABASE ". $name;
	if ($conn->query($sql)) {
		echo "Database ". $name ." created successfully<br>";
	} else {
		echo "Error creating database ". $name ." : " . $conn->error ."<br>";
	}
	// close the connection
	$conn->close();
}

// Delete a database
function DeleteDB($name) {
	global $servername, $username, $password;
	// Create connection
	$conn = new mysqli($servername, $username, $password);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error ."<br>");
	} 
	echo "Connected successfully <br>";
	// Creation of the database
	$sql = "DROP DATABASE ". $name;
	if ($conn->query($sql)) {
		echo "Database ". $name ." deleted successfully<br>";
	} else {
		echo "Error creating database: ". $name ." : " . $conn->error ."<br>";
	}
	// close the connection
	$conn->close();
}


// Some functions to show there are multiple solutions
function Test() {
	$obj=new Student();

	// This part will return only the name of the public properties (class) !
	$class_vars= get_class_vars('Student');
	echo count($class_vars);
	echo '<br>';
	foreach ($class_vars as $key => $value){
	  echo 'key:'. $key . '  value:' . $value;  
	  echo '<br>'; 

	}

	// This part will return only the name and value of the public properties (object)
	$obj_vars=get_object_vars($obj);
	echo count($obj_vars);
	echo '<br>';
	foreach ($obj_vars as $key => $value){
	  echo 'key:'. $key . '  value:' . $value;  
	  echo '<br>'; 
	}
	echo '<br>';
	var_dump(get_object_vars($obj));

	$reflect = new ReflectionClass('Student'); // PHP special class
	$props = $reflect->getProperties();
	$ownProps = [];
	foreach ($props as $prop) {
		if ($prop->class === 'Student') {
			$ownProps[] = $prop->getName();
		}
	}
	var_dump($ownProps);
	echo '<br>';
	$vproperty=Array();
	foreach ($ownProps as $key => $value){
	  echo 'key:'. $key . '  value:' . $value . ' ';  
	  var_dump($value);
	  echo '<br>'; 
	  array_push($vproperty,$value);
	}
	echo 'Content of vproperty: <br>';
	var_dump($vproperty);

	$ref = new ReflectionClass('Student');  
	$ownProps = array_filter($ref->getProperties(), function($property) {return $property->class == 'Student'; });

	  foreach ($ownProps as $key => $value){
	  echo 'key:'. $key . '  value:' . $value . ' ';  
	  var_dump($value);
	  echo '<br>';  
	}

}

// Insert table
function InsertTable($c,$db) {
	global $servername, $username, $password;
	// Create connection
	$conn = new mysqli($servername, $username, $password, $db);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$reflect = new ReflectionClass($c);
	$props = $reflect->getProperties();
	$ownProps = [];
	foreach ($props as $prop) {
		if ($prop->class === $c) {
			$ownProps[] = $prop->getName();
		}
	}
	
	$vproperty=Array();
	foreach ($ownProps as $key => $value){
	  echo 'key:'. $key . '  value:' . $value . ' type:' . gettype($value);  
	  // var_dump($value);
	  echo '<br>'; 
	  array_push($vproperty,$value);
	}
	
	// By default we create an index for each element we will insert, it can be used as a key
	// be careful to the key words in SQL that you cannot use as names for the columns
	$sql = "CREATE TABLE ". $c . "(	idx INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, ";
	for ($i=0;$i<count($vproperty);$i++) {
		// Here we assume everything is a string	
		$sql .=$vproperty[$i] . " VARCHAR(30) NOT NULL, ";
	}
	$sql .=" reg_date TIMESTAMP )";
	echo $sql . '<br>';
	if ($conn->query($sql) === TRUE) {
		echo "Table ". $c ." created successfully<br>";
	} else {
		echo "Error creating table: " . $conn->error ."<br>";
	}
		
	// close the connection
	$conn->close();
}


// Insert table
function InsertTable1($c,$db) {
	global $servername, $username, $password;
	// Create connection
	$conn = new mysqli($servername, $username, $password, $db);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$o=new $c(); 
	
	// we use what we did with JSON to go back to a std class that embeds everything 
	$jo=json_encode($o);
	$o=json_decode($jo);
	
	$obj_vars=get_object_vars($o);
	echo count($obj_vars);
	echo '<br>';
	$vproperty=Array();
	foreach ($obj_vars as $key => $value){
	  echo 'key:'. $key . '  value:' . $value;  
	  echo '<br>';
	  array_push($vproperty,$key);
	}
	echo '<br>';
	
	// By default we create an index for each element we will insert, it can be used as a key
	// be careful to the key words in SQL that you cannot use as names for the columns
	$sql = "CREATE TABLE ". $c . "(	idx INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, ";
	for ($i=0;$i<count($vproperty);$i++) {
		// Here we assume everything is a string	
		$sql .=$vproperty[$i] . " VARCHAR(30) NOT NULL, ";
	}
	$sql .=" reg_date TIMESTAMP )";
	echo $sql . '<br>';
	if ($conn->query($sql) === TRUE) {
		echo "Table ". $c ." created successfully<br>";
	} else {
		echo "Error creating table: " . $conn->error ."<br>";
	}
		
	// close the connection
	$conn->close();
}


function InsertSTR($o) {
	$nameclass=get_class($o);
	$jo=json_encode($o);
	$o=json_decode($jo);
	$obj_vars=get_object_vars($o);
	echo count($obj_vars);
	echo '<br>';
	$vkey=Array();
	$vvalue=Array();
	foreach ($obj_vars as $key => $value){
	  echo 'key:'. $key . '  value:' . $value;  
	  echo '<br>';
	  array_push($vkey,$key);
	  array_push($vvalue,$value);
	}
	
	// Insert elements in the database
	$sql = "INSERT INTO ". $nameclass ." (";
	for ($i=0;$i<count($vkey)-1;$i++) {
		$sql .= $vkey[$i] . " , ";
	}
	$sql .= $vkey[count($vkey)-1] .") VALUES ("; 
	for ($i=0;$i<count($vvalue)-1;$i++) {
		$sql .="'". $vvalue[$i] . "' , ";
	}
	$sql .="'". $vvalue[count($vvalue)-1] ."')";
	return $sql;
	
}

// insert an object o in the database in the corresponding table
function InsertItem($o,$db) {
	
	// get the class of the object
	global $servername, $username, $password;
	// Create connection
	$conn = new mysqli($servername, $username, $password, $db);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$sql=InsertSTR($o);
	
	echo $sql;
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully<br>";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error ."<br>";
	}

	// close the connection
	$conn->close();
		
}

// insert an array of objects vo in the database in the corresponding table
function InsertItems($vo,$db) {
	// get the class of the object
	global $servername, $username, $password;
	// Create connection
	$conn = new mysqli($servername, $username, $password, $db);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$sql="";
	for ($i=0;$i<count($vo);$i++) {
		$sql.=InsertSTR($vo[$i]) . ";"; // dont forget the semicolon
	}
	
	if ($conn->multi_query($sql) === TRUE) {  // notice the difference MULTI query
		 $last_id = $conn->insert_id;
		echo "New records created successfully. Last inserted ID is: " . $last_id ."<br>";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
	}
	// close the connection
	$conn->close();
}


// to get the array with references !!!
function refValues($arr){
    if (strnatcmp(phpversion(),'5.3') >= 0) { //Reference is required for PHP 5.3+
        $refs = array();
        foreach($arr as $key => $value)
            $refs[$key] = &$arr[$key];
        return $refs;
    }
    return $arr;
}


function InsertItems1($vo,$db) {
	// get the class of the object
	global $servername, $username, $password;
	// Create connection
	$conn = new mysqli($servername, $username, $password, $db);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	// Retrieve the name of the columns: there are many possibilities
	// through SQL or through the way we created the table !
	// $sql = "SHOW COLUMNS FROM your-table";
    //$result = mysqli_query($conn,$sql);
    //while($row = mysqli_fetch_array($result)){
    //    echo $row['Field']."<br>";
    //}
	
	$o=$vo[0];
	$nameclass=get_class($o);
	// Get the list of the columns
	$jo=json_encode($o);
	$o=json_decode($jo);
	
	$obj_vars=get_object_vars($o);
	echo count($obj_vars);
	echo '<br>';
	$vproperty=Array();
	foreach ($obj_vars as $key => $value){
	  echo 'key:'. $key . '  value:' . $value;  
	  echo '<br>';
	  array_push($vproperty,$key);
	}
	
	$str1="";
	$sql = "INSERT INTO ". $nameclass ." (";
	for ($i=0;$i<count($vproperty)-1;$i++) {
		$sql .= $vproperty[$i] . " , ";
		$str1.="s";
	}
	$str1.="s";
	
	$sql .= $vproperty[count($vproperty)-1] .") VALUES ("; 
	for ($i=0;$i<count($vproperty)-1;$i++) {
		$sql .="?, ";
	}
	$sql .="?)";
	echo "Statement:<br>";
	echo $sql ."<br>";
	$stmt = $conn->prepare($sql);
	if ($stmt==FALSE) {
		echo "There is a problem with prepare <br>";
		echo $conn->error; // Need to connect/reconnect before the prepare call otherwise it doesnt work
	}
	var_dump($vproperty);
	
	// Problem: to call the bind_param we have a variable number of elements.
	// Solution: call_user_func_array
	// &$stmt,'bind_param' : need to decompose the reference of the object and the method that is called
	// $params contains the list of all the different paramters we want to give to the bind_param
	
//	$params = array_merge(array(str_repeat('s',count($vproperty))),$vproperty);
//	echo "<br>Params:<br>";
//	var_dump($params);
//	call_user_func_array(array(&$stmt,'bind_param'),refValues($params));
	// call_user_func_array — Call a callback with an array of parameters
	
	echo $str1 . " " . count($vproperty) ."<br>";
	// No need to have the complicated call_user_func_array: just use ... 
	$stmt->bind_param($str1, ...$vproperty);
	
	// set parameters and execute
	for ($i=0;$i<count($vo);$i++) {	
		echo "Execute for item ". $i ."<br>";
		$o=$vo[$i];
		$nameclass=get_class($o);
		// Get the list of the columns
		$jo=json_encode($o);
		$o=json_decode($jo);
		
		$obj_vars=get_object_vars($o);
		echo count($obj_vars);
		echo '<br>';
		$vvalue=Array(); // array containing the list of parameters
		$j=0;
		foreach ($obj_vars as $key => $value){
		  echo 'key:'. $key . '  value:' . $value;  
		  echo '<br>';
		  $vproperty[$j]=$value;
		  $j=$j+1;
		  
		}
		$stmt->execute();
	}
	
	echo "New records created successfully<br>";

	$stmt->close();
	// close the connection
	$conn->close();
}


function GetTable($MyClass,$db) {
	
	global $servername, $username, $password;
	// Create connection
	$conn = new mysqli($servername, $username, $password, $db);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$o=new $MyClass(); 
	$nameclass=get_class($o);
	// Selection of data 
	$sql = "SELECT * FROM ". $nameclass;
	$result = $conn->query($sql);
	$vo=array();
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$o=new $MyClass();
			$str=json_encode($row); // transform the row which is an array into JSON string
			$o1=json_decode($str,true);  // true so we return an array and not an object !!
			// echo "<hr>". $str;
			$o->Set($o1); // std object to MyClass object
			array_push($vo,$o);
		}
	} else {
		echo "0 results";
	}
	// close the connection
	$conn->close();
	return $vo;
}

?>