<?php

require_once 'client-header.php';
$page_title = null;
$content = null;

$query = "SELECT * FROM pages WHERE page_id = :page_id;";
$cmd = $db->prepare($query);
$cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT, 11);
$cmd->execute();
$page = $cmd->fetch();
$page_title = $page['title'];
$content = $page['content'];

?>

<body>
    <h1><?php echo $page_title ?></h1>
    <p><?php echo $content ?></p>
</body>
</html>

<?php

$db = null;