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
$admin_id = $_POST['admin_id']; //empty when adding, not empty when editing
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

        if(empty($admin_id)){
            $sql = "INSERT INTO administrators (username, password) VALUES (:username, :password)";
        }
        else {
            $sql = "UPDATE administrators SET username = :username, password = :password WHERE admin_id = :admin_id";
        }

        $cmd = $db->prepare($sql);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
        $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);
        if(!empty($admin_id)){
            $cmd->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
        }
        $cmd->execute();


        // disconnect
        $db = null;

        // show success message and redirect to administrators page
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

