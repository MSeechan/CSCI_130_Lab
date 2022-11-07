<?php
    if (isset($_POST['curr_index'])) {
        $index = $_POST['curr_index'];
        $x = json_decode(index);
        $back = json_encode($x);
        // $json = file_get_contents('movies_data.json');
        // $arr = json_decode($json);
        // $arr_str = json_encode($arr[$index]);
        echo $back;
    }
?>
?>