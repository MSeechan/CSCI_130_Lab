<?php
    include "create_class.php";

    $conn = mysqli_connect("localhost", "myuser", "mypass", "new_db");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error ."<br>");
    } 
    
    $sql = "SELECT COUNT(*) AS Total FROM new_tbl;";
    $result = $conn->query($sql);
    $total = $result->fetch_assoc();
    $total = $total["Total"];
    
    // sort by  col
    if (isset($_POST['col1'])){
        $sql = "SELECT pkey, col1, col2, col3 FROM new_tbl ORDER BY col1 ASC";
    
    }
    // sort by pkey/id
    if (isset($_POST['id'])){
        $sql = "SELECT pkey, col1, col2, col3 FROM new_tbl ORDER BY new_tbl.pkey ASC";
    }
    $result = $conn->query($sql);

    // get the sort results back 
   
	$i=0;
	$new_arr= Array();
	//if row exists from query, get it and assign row's col-name 
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
		$newClass=new NewClass();
		$newClass->id=($row["pkey"]);
		$newClass->col1=($row["col1"]);
		$newClass->col2=($row["col2"]);
		$newClass->col3=($row["col3"]);
		// each row becomes a class inst
		$new_arr[$i]=$newClass;
		$i+=1;
		}// send back array of classes and add total to the arr end
		$new_arr[$i]= $total;
		$all_ret_data = json_encode($new_arr);
		echo $all_ret_data;
	}else {
		echo "sorting Error: " . $sql . "<br>" . $conn->error;
	}
    
    $conn->close();
?>