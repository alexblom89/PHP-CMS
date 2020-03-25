<?php
$title = 'Administrators';
require_once ('header.php');
require_once ('authorization.php');
?>

<h1>List of Administrators</h1>

<?php

if (!empty($_SESSION['user_id'])) {
    echo '<a href="edit-admin.php">Add a New Administrator</a>';
}

try {

    require_once 'db.php';

    $query = "SELECT * FROM administrators;";
    $cmd = $db->prepare($query);
    $cmd->execute();
    $admins = $cmd->fetchAll();

// 4a. Create a grid with a header row

    echo '<table class="table table-striped table-hover"><thead><th>Username</th><th></th><th></th></thead>';

    foreach ($admins as $value) {
        echo '<tr><td>' . $value['username'] . '</td>

             <td><a href="edit-admin.php?admin_id=' . $value['admin_id'] . '" class="btn btn-danger">Edit</a></td>

             <td><a href="delete-admin.php?admin_id=' . $value['admin_id'] . '" class="btn btn-danger"
            onclick="return confirmDelete();">Delete</a></td>

             </tr>';
    }

// 5a. End the HTML table
    echo '</table>';

// 6. Disconnect from the database
    $db = null;
}
catch (Exception $e){
    header('location:error.php');
    exit();
}
require_once 'footer.php';
?>

