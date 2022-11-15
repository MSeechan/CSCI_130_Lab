<?php

if (isset($_POST['input'])) {
            $index = $_POST['input'];
            $json = file_get_contents('movies_data.json');
            $arr = json_decode($json);
            $arr_str = json_encode($arr[$index-1]);
            echo $arr_str;
        }
?>