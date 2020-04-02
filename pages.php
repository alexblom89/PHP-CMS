<?php
$title = 'Administrators';
require_once ('header.php');
require_once ('authorization.php');
?>
<div class="d-flex justify-content-center"></div>
<div class="w-50 p-3">
    <h1>List of Pages</h1>

    <?php

    if (!empty($_SESSION['user_id'])) {
        echo '<a href="edit-page.php">Add a New Page</a>';
    }

    try {

        $query = "SELECT * FROM pages WHERE user_id = :user_id;";
        $cmd = $db->prepare($query);
        $cmd->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT, 11);
        $cmd->execute();
        $pages = $cmd->fetchAll();

// Create a grid with a header row

        echo '<table class="table table-striped table-hover"><thead><th>Title</th><th></th><th></th></thead>';

        foreach ($pages as $value) {
            echo '<tr><td>' . $value['title'] . '</td>

             <td><a href="edit-page.php?page_id=' . $value['page_id'] . '" class="btn btn-danger">Edit</a></td>

             <td><a href="delete-page.php?page_id=' . $value['page_id'] . '" class="btn btn-danger"
            onclick="return confirmDelete();">Delete</a></td>

             </tr>';
        }

// End the HTML table
        echo '</table>';

// Disconnect from the database
        $db = null;
    }
    catch (Exception $e){
        header('location:error.php');
        exit();
    }
    ?>
</div>
<?php
require_once 'footer.php';
?>

