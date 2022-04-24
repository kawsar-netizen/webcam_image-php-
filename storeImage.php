<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "webcam_Image");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
// $first_name = mysqli_real_escape_string($link, $_REQUEST['first_name']);
// $last_name = mysqli_real_escape_string($link, $_REQUEST['last_name']);
// $email = mysqli_real_escape_string($link, $_REQUEST['email']);

// file_put_contents('im.txt', json_encode($_POST));

$img = $_POST['images'];
$folderPath = "upload/";

$image_parts = explode(";base64,", $img);
$image_type_aux = explode("image/", $image_parts[0]);
$image_type = $image_type_aux[1];

$image_base64 = base64_decode($image_parts[1]);
$fileName = uniqid() . '.png';

$file = $fileName;
file_put_contents($file, $image_base64);

print_r($fileName);

 
// Attempt insert query execution
$sql = "INSERT INTO images (images) VALUES ('$file')";
if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>