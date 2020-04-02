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

// parse the page_id from the url
$page_id = $_GET['page_id'];

// connect
try {


    require_once 'db.php';

    $sql = "DELETE FROM pages WHERE page_id = :page_id";

// pass the page_id parameter to the command
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
    $cmd->execute();

// disconnect
    $db = null;

// redirect
    header('location:pages.php');
}
catch (Exception $e) {
    //redirect to error page if an error is caught.
    header('location:error.php');
    exit();
}
?>

</body>
</html>
