<?php
$target_dir = "assets/"; // you must create this directory in the folder where you have the PHP file
$target_file = $target_dir . basename($_FILES["img_path"]["name"]);

echo "<p>Upload information</p><ul>";
echo  "<li>Target folder for the upload :". $target_file . "</li>";
echo  "<li>File name :". basename($_FILES["img_path"]["name"]) . "</li>";
// basename: Returns the base name of the given path

$uploadOk = 1;

$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Verify if the image file is an actual image or a fake image
if(isset($_POST["submit"])) {
  
    $check = getimagesize($_FILES["img_path"]["tmp_name"]);
    if($check !== false) {
        $message = "<li>File is an image of type - " . $check["mime"] . ".</li>";
        $uploadOk = 1;
    } else {
        $message = "<li>File is not an image.</li>";
        $uploadOk = 0;
    }
}
// Verify if file already exists
if (file_exists($target_file)) {
    $message = "<li>The file already exists.</li>";
    $uploadOk = 0;
}
// Verify the file size
if ($_FILES["img_path"]["size"] > 500000) {
    $message = "<li>The file is too large.</li>";
    $uploadOk = 0;
}
// Verify certain file formats
if($imageFileType != "jpg" && $imageFileType != "png") {
    $message = "<li>Only jpg and png files are allowed for the upload.</li>";
    $uploadOk = 0;
}
// Verify if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $message = "<li>The file was not uploaded.</li>";
} else { // upload file
    if (move_uploaded_file($_FILES["img_path"]["tmp_name"], $target_file)) {
        $message = "<li>The file ". basename( $_FILES["img_path"]["name"]). " has been uploaded.</li>";
    } else {
        $message = "<li>Error uploading your file.</li>";
    }
}
?>