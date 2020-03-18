<?php
// exit if user is not authenticated
if (empty($_SESSION['user_id'])) {
    header('location:login.php');
    exit();
}
