<?php
$title = 'Administrator Registration    ';
require_once('header.php');
require_once ('authorization.php');

// initialize admin variable
$page_id = null;
$title = null;
$content = null;

if(!empty($_GET['page_id'])){

    $admin_id = $_GET['page_id'];

    require_once 'db.php';

    // fetch the selected admin
    $sql = "SELECT * FROM pages WHERE page_id = :page_id";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
    $cmd->execute();

    // use fetch without a loop instead of fetchAll with a loop as we're only selecting a single record
    $page = $cmd->fetch();
    $title = $page['title'];
    $content = $page['content'];

    // disconnect
    $db = null;
}
?>

<main class="container">
    <h1 class="text-justify">Page Setup</h1>
    <form method="post" action="save-page.php" class="form-group">
        <fieldset  class="form-group">
            <label for="title" class="col-md-2">Title:</label>
            <input name="title" id="title" required value="<?php echo $title ?>"/>
        </fieldset>
        <fieldset  class="form-group">
            <label for="content" class="col-md-2">Content:</label>
            <input name="content" id="content" required value="<?php echo $content ?>"/>
        </fieldset>
        <fieldset  class="form-group">
            <input name="page_id" id="page_id" type="hidden" value="<?php echo $page_id ?>"/>
        </fieldset>
        <div class="offset-md-2">
            <input type="submit" value="Save" class="btn btn-info"/>
        </div>
    </form>
</main>

<?php
require_once 'footer.php';
?>


