<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<?php
$username = $_POST['username'];
$password = $_POST['password'];

require_once 'db.php';

$sql = "SELECT user_id, password FROM users_2 WHERE username = :username";

$cmd = $db->prepare($sql);
$cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
$cmd->execute();
$user = $cmd->fetch();

if (!password_verify($password, $user['password'])) {
    header('location:login.php?invalid=true');
    exit();
}
else {
    // access the existing session.
    session_start();

    // create a session variable called "user_id" and fill it from the id in our login query above
    $_SESSION['user_id'] = $user['user_id'];

    // store username in a 2nd session variable to display in navbar
    $_SESSION['username'] = $username;

    // redirect to home page.
    header('location:index.php');
}

$db = null;

?>

</body>
</html>
