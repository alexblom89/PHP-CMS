<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saving...</title>
</head>
<body>

<?php
session_start();
// store form inputs in variables
$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$admin_id = $_POST['admin_id']; //empty when adding, not empty when editing
// grab user_id value from session variable
$_SESSION['user_id'];
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

//    try {

        // connect
        require_once 'db.php';

        // duplicate username check before insert.
        $sql = "SELECT * FROM administrators WHERE username = :username";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
        $cmd->execute();
        $user = $cmd->fetch();

        if(!empty($username)){
            echo 'Username already taken!</br>';
        }
        else if(empty($admin_id)){
            $sql = "INSERT INTO administrators (username, password, user_id) VALUES (:username, :password, :user_id)";
        }
        else {
            $sql = "UPDATE administrators SET admin_id = :admin_id, username = :username, password = :password, user_id = :user_id WHERE admin_id = :admin_id";
        }

        $cmd = $db->prepare($sql);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
        $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);
        $cmd->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT, 11);
        if(!empty($admin_id)){
            $cmd->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
        }
        $cmd->execute();


        // disconnect
        $db = null;

        // show success message and redirect to administrators page
        header('location:administrators.php');
//    }
//    catch (Exception $e) {
//        //redirect to error page if an error is caught.
//        header('location:error.php');
//        exit();
//    }
}
?>

</body>
</html>

