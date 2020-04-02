<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Deleting...</title>
</head>
<body>

<?php
session_start();
// make this page private
require_once 'authorization.php';

// parse the admin_id from the url
$admin_id = $_GET['admin_id'];

// connect
try {

    require_once 'db.php';

    $sql = "DELETE FROM administrators WHERE admin_id = :admin_id";

// pass the admin_id parameter to the command
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
    $cmd->execute();

// disconnect
    $db = null;

// redirect
    header('location:administrators.php');
}
catch (Exception $e) {
    //redirect to error page if an error is caught.
    header('location:error.php');
    exit();
}
?>

</body>
</html>
