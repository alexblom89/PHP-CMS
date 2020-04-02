<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

<?php
// get the uploaded file object
$file = $_FILES['logo_file'];

// access & display properties of the uploaded file
$name = $file['name'];
echo 'Name: $name<br/>';

$tmp_name = $file['tmp_name'];
echo "Tmp Name: $tmp_name<br/>";

$type = mime_content_type($tmp_name);
echo "Type: $type<br />";

$size = $file['size'];
echo "Size: $size<br />";

// create a unique name for each upload to prevent file overwriting unless it's the same file and session
session_start();
$name = session_id() . '-' . $name;

// move the file out of tmp to the uploads folder for permanent storage
move_uploaded_file($tmp_name, "uploads/logo/$name");

?>
</body>
</html>

