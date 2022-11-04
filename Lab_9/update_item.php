<?php
    isset($_POST['title'])? $title = $_POST['title']:$title ='';
    isset($_POST['year'])? $year = $_POST['year']:$year ='';
    isset($_POST['rating'])? $rating = $_POST['rating']:$rating ='';
    isset($_POST['length'])? $length = $_POST['length']:$length ='';
       
	
    echo $title." ".$year.' '.$rating.' '.$length;
    


?>