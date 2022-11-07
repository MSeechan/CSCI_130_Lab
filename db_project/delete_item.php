<?php
    if (isset($_POST['curr_index'])) {
        $index = $_POST['curr_index'];
        $json = file_get_contents('movies_data.json');  //get movies json
        $arr = json_decode($json);                      //decode to arr
        unset($arr[$index]);
        $arr_str = json_encode($arr);
        echo $arr_str;
    }
?>
