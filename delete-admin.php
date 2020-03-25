<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Deleting...</title>
</head>
<body>

<?php
// auth check
session_start();

// make this page private
require_once 'authorization.php';
//if (empty($_SESSION['userId'])) {
//    header('location:login.php');
//    exit();
//}

// parse the artistId from the url parameter
$admin_id = $_GET['admin_id'];

// connect
require_once 'db.php';

$sql = "DELETE FROM administrators WHERE admin_id = :admin_id";

// pass the admin_id parameter to the command
$cmd = $db->prepare($sql);
$cmd->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);

// execute the deletion
$cmd->execute();

// disconnect
$db = null;

// redirect back to updated administrators list page
header('location:administrators.php');
?>

</body>
</html>
