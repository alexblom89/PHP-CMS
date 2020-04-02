
<?php
$logo_name = null;
// get the uploaded file object
$file = $_FILES['logo_file'];

$name = $file['name'];

$tmp_name = $file['tmp_name'];

// create a unique name for each upload to prevent file overwriting unless it's the same file and session
session_start();
$logo_name = session_id() . '-' . $name;

// move the file out of tmp to the uploads folder for permanent storage
move_uploaded_file($tmp_name, "uploads/logo/$logo_name");

try {
    require_once 'db.php';

    $sql = "INSERT INTO logos (user_id, logo_name) VALUES (:user_id, :logo_name);";

    $cmd = $db->prepare($sql);
    $cmd->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
    $cmd->bindParam(':logo_name', $logo_name, PDO::PARAM_STR, 255);
    $cmd->execute();

    $db = null;

    header('location:logo.php');
}
catch (Exception $e) {
    //redirect to error page if an error is caught.
    header('location:error.php');
    exit();
}


