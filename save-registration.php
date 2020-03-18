<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saving...</title>
</head>
<body>

<?php

// store form inputs in variables
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$ok = true;

// validate inputs
if(empty($email)) {
    echo'Email is required<br />';
    $ok = false;
}

if (empty($username)) {
    echo 'Username is required<br />';
    $ok = false;
}

if (empty($password)) {
    echo 'Password is required<br />';
    $ok = false;
}

if ($password != $confirm) {
    echo 'Passwords must match<br />';
    $ok = false;
}

if ($ok) {
    // hash the password
    $password = password_hash($password, PASSWORD_DEFAULT);
    //echo $password;

    try {

        // connect
        require_once 'db.php';

        // separated username and email into two separate fields to allow users to have a non-email format username instead.
        // duplicate username check before insert.
        $sql = "SELECT * FROM users_2 WHERE username = :username";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
        $cmd->execute();
        $user = $cmd->fetch();

        // duplicate email check before insert.
        $sql2 = "SELECT * FROM users_2 WHERE email = :email";
        $cmd = $db->prepare($sql2);
        $cmd->bindParam(':email', $email, PDO::PARAM_STR, 50);
        $cmd->execute();
        $mail = $cmd->fetch();

        if (!empty($user)) {
            echo 'Username already taken!<br />';
        } else if (!empty($email)) {
            echo 'Email Address already exists.<br/>';
        } else {
            // set up & run insert
            $sql = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
            $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);
            $cmd->bindParam(':email', $email, PDO::PARAM_STR, 255);
            $cmd->execute();
        }

        // disconnect
        $db = null;

        // redirect to login page
        header('location:login.php');
    }
    catch (Exception $e) {
        header('location:error.php');
        exit();
    }
}
?>

</body>
</html>
