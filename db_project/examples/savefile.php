<?php

if (isset($_POST["mynewdata"]))
{
  $data = $_POST["mynewdata"];

} 
else 
{
  $data = null;
  echo "no data supplied";
}

// Overwrite the previous file
$f = fopen("mydatabase.json","w");
fwrite($f,$data);
fclose($f);

/*
$f = fopen("mydatabase.json","w");
fwrite($f,$data);
fclose($f);
*/

?>