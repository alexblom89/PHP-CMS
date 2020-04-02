<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Gotu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css" />

</head>
<body class="d-flex flex-column" style="background-color: #eeeeee">

<?php
try {
    require_once 'db.php';

// grab page_id from URL parameter, query database for user_id that matches the current page_id to dynamically grab the
// user_id without requiring a session variable.
    $page_id = $_GET['page_id'];
    $id_query = "SELECT user_id FROM pages WHERE page_id = :page_id;";
    $cmd = $db->prepare($id_query);
    $cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
    $cmd->execute();
    $user = $cmd->fetch();

    $user_id = $user['user_id'];

    $query = "SELECT * FROM pages WHERE user_id = :user_id;";
    $cmd = $db->prepare($query);
    $cmd->bindParam(':user_id', $user_id, PDO::PARAM_INT, 11);
    $cmd->execute();
    $pages = $cmd->fetchAll();

    $logo_query = "SELECT * FROM logos WHERE user_id = :user_id LIMIT 1;";
    $cmd = $db->prepare($logo_query);
    $cmd->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $cmd->execute();
    $logo = $cmd->fetch();
    $logo_name = $logo['logo_name'];
}
catch
    (Exception $e) {
        //redirect to error page if an error is caught.
        header('location:error.php');
        exit();
    }

?>

    <!-- navbar from https://www.w3schools.com/bootstrap4/bootstrap_navbar.asp -->
    <nav class="navbar navbar-expand-md navbar-light" style="background-color: #dd99ff">
        <!-- Add logo to header -->
        <div class="navbar-header">
            <?php echo '<a class="navbar-brand" id="brand" href="home.php"><img src="uploads/logo/' . $logo_name . '" alt="Pizza Logo"/></a>';?>
        </div>
        <!-- Toggle/collapse Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <!-- Loop through pages db and create navbar links for each page -->
            <ul class="nav nav-pills">
            <?php
                foreach($pages as $value){
                    echo '<li class="nav-item"><a class="nav-link active mx-3 bg-dark" href="index.php?page_id=' . $value['page_id'] . '">' . $value['title'] . '</a></li>';
                }

                ?>
            </ul>
        </div>
    </nav>
<main id="page-content">




