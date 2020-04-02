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
$title = $_POST['title'];
$content = $_POST['content'];
$page_id = $_POST['page_id']; //empty when adding, not empty when editing
// grab user_id value from session variable
$_SESSION['user_id'];
$ok = true;

//check if username field is empty.
if (empty($title)) {
    echo 'Title is required<br />';
    $ok = false;
}

if (empty($content)) {
    echo 'The page must have content.<br />';
    $ok = false;
}

if ($ok) {

    try {

        // connect
        require_once 'db.php';

        // duplicate username check before insert.
        $sql = "SELECT * FROM pages WHERE title = :title";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':title', $title, PDO::PARAM_STR, 50);
        $cmd->execute();
        $title_check = $cmd->fetch();

        if(!empty($title_check)){
            echo 'Page title already used, please enter a unique page title.</br>';
        }

        // insert statement
        if(empty($page_id)){
            $sql = "INSERT INTO pages (user_id, title, content) VALUES (:user_id, :title, :content)";
        }
        else {
            $sql = "UPDATE pages SET user_id = :user_id, title = :title, content = :content WHERE page_id = :page_id";
        }

        $cmd = $db->prepare($sql);
        $cmd->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $cmd->bindParam(':title', $title, PDO::PARAM_STR, 45);
        $cmd->bindParam(':content', $content, PDO::PARAM_LOB);
        if(!empty($page_id)){
            $cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
        }

        $cmd->execute();


        // disconnect
        $db = null;

        // show success message and redirect to administrators page
        header('location:pages.php');
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

