<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>COMP1006 Assignment 2 - <?php echo $title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Gotu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css" />

</head>
<body class="d-flex flex-column" style="background-color: #eeeeee">

    <!-- navbar from https://www.w3schools.com/bootstrap4/bootstrap_navbar.asp -->
    <nav class="navbar navbar-expand-md navbar-light" style="background-color: #dd99ff">
        <a class="navbar-brand" id="title" href="home.php">COMP1006 Assignment 2 CMS</a>

        <!-- Toggle/collapse Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <!-- These links will only show up for authenticated users of the site. -->
            <ul class="nav nav-pills">
                <?php

                session_start();

                try {
                    require_once 'db.php';

                    $query = "SELECT * FROM pages WHERE user_id = :user_id;";
                    $cmd = $db->prepare($query);
                    $cmd->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT, 11);
                    $cmd->execute();

                    $page = $cmd->fetch();
                    $page_id = $page['page_id'];
                    $page_title = $page['title'];

                    if (!empty($_SESSION['user_id'])) {
                        echo '<li class="nav-item"><a class="nav-link active mx-3 bg-dark" href="administrators.php">Administrators</a></li>
                    <li class="nav-item"><a class="nav-link active mx-3 bg-dark" href="pages.php">Pages</a></li>
                    <li class="nav-item"><a class="nav-link active mx-3 bg-dark" href="logo.php">Logo</a></li>
                    <li class="nav-item"><a class="nav-link active mx-3 bg-dark" href="index.php?page_id=' . $page_id . '">Public Site</a></li>';
                    }
                }
                catch (Exception $e) {
                    //redirect to error page if an error is caught.
                    header('location:error.php');
                    exit();
                }
                ?>
            </ul>
            <ul class="nav nav-pills ml-auto">
                <?php
                // display username and logout links if user is logged in.
                if (!empty($_SESSION['user_id'])) {
                    echo '<li class="nav-item"><a class="nav-link active mx-3 bg-dark" href="#">' . $_SESSION['username'] . '</a></li>
                    <li class="nav-item"><a class="nav-link active mx-3 bg-dark" href="logout.php">Logout</a></li>';
                }
                //display register and login links.
                else {
                    echo '<li class="nav-item">
                        <a class="nav-link active mx-3 bg-dark" href="register.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active mx-3 bg-dark" href="login.php">Login</a>
                    </li>';
                }

                ?>
            </ul>
        </div>
    </nav>
<main id="page-content">
