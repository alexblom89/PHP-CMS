<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saving...</title>
</head>
<body>

<?php

// store form inputs in variables
$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$ok = true;

//check if username field is empty.
if (empty($username)) {
    echo 'Username is required<br />';
    $ok = false;
}

if (empty($password)) {
    echo 'Password is required<br />';
    $ok = false;
}
//check if passwords are the same, if not inform user that they must match.
if ($password != $confirm) {
    echo 'Passwords must match<br />';
    $ok = false;
}

if ($ok) {
    // hash the password
    $password = password_hash($password, PASSWORD_DEFAULT);

    try {

        // connect
        require_once 'db.php';

        // duplicate username check before insert.
        $sql = "SELECT * FROM administrators WHERE username = :username";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
        $cmd->execute();
        $user = $cmd->fetch();

        if (!empty($user)) {
            echo 'Username already taken!<br />';
        } else {
            // set up & run insert
            $sql = "INSERT INTO administrators (username, password) VALUES (:username, :password)";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
            $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);
            $cmd->execute();
        }

        // disconnect
        $db = null;

        // redirect to login page
        header('location:administrators.php');
    }
    catch (Exception $e) {
        //redirect to error page if an error is caught.
        header('location:error.php');
        exit();
    }
}
?>

</body>
</html>

