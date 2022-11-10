<?php
    $recv_json = file_get_contents('movies_data.json');  
    $json_arr = json_decode($recv_json);
    $last_obj = end($json_arr);
    // $last_id = $last_obj->id;
    // check if input was set, update to new value. if not, don't replace
    if($_POST['title']){$set_title = $_POST['title'];};
    if($_POST['year']){$set_year = $_POST['year'];};
    if($_POST['rating']){$set_rating = $_POST['rating'];};
    if($_POST['length']){$set_length = $_POST['length'];};
    if($_POST['recommended']){$set_recommended = $_POST['recommended'];};
    if($_POST['synopsis']){$set_synopsis = $_POST['synopsis'];};
   
    $str = 'set_title='.$set_title.','.'movie_id='.$last_obj->movie_id+1;
    $a= json_encode($str);
    //$movie->year.' '.$movie->rating.' '.$movie->length.' '.$movie->synopsis.' '.$id;  
    echo $a;        
       
    // write to (filename, encoded json)
    // file_put_contents('movies_data.json', json_encode($json_arr));
    // reroute to the same site after saving the updated movie data
    // header("Location: http://localhost/mysite/db_project/movies.html");
?>