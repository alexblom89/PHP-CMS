<?php

require_once 'client-header.php';
$page_title = null;
$content = null;

try {
    $query = "SELECT * FROM pages WHERE page_id = :page_id;";
    $cmd = $db->prepare($query);
    $cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT, 11);
    $cmd->execute();
    $page = $cmd->fetch();
    $page_title = $page['title'];
    $content = $page['content'];
}
catch (Exception $e) {
    //redirect to error page if an error is caught.
    header('location:error.php');
    exit();
}
?>

    <h1><?php echo $page_title ?></h1>
    <p><?php echo $content ?></p>

</main>
</body>
</html>

<?php

$db = null;

require_once ('footer.php');