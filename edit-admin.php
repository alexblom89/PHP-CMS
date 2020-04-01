<?php
$title = 'Administrator Registration';
require_once('header.php');
require_once ('authorization.php');

// initialize admin variable
$admin_id = null;
$username = null;

if(!empty($_GET['admin_id'])){

    $admin_id = $_GET['admin_id'];

    require_once 'db.php';

    // fetch the selected admin
    $sql = "SELECT * FROM administrators WHERE admin_id = :admin_id";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
    $cmd->execute();

    // use fetch without a loop instead of fetchAll with a loop as we're only selecting a single record
    $admin = $cmd->fetch();
    $username = $admin['username'];

    // disconnect
    $db = null;
}
?>

<main class="container">
    <h1 class="text-justify">Edit Administrator</h1>
    <form method="post" action="save-admin.php" class="form-group">
        <fieldset  class="form-group">
            <label for="username" class="col-md-2">Username:</label>
            <input name="username" id="username" required type="email" value="<?php echo $username ?>"/>
        </fieldset>
        <fieldset  class="form-group">
            <label for="password" class="col-md-2">Password:</label>
            <input type="password" name="password" id="password" required
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"/>
            <!-- add show/hide option for passwords using javascript to change between them. -->
            <img id="showIcon" src="img/show.png" alt="Show/Hide Password" onclick="showPW()">
        </fieldset>
        <fieldset  class="form-group">
            <label for="confirm" class="col-md-2">Confirm Password:</label>
            <input type="password" name="confirm" id="confirm" required
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                   onkeyup="return comparePW()"/>
            <img id="showIcon" src="img/show.png" alt="Show/Hide Password" onclick="showPW()">
            <span id="pwMsg"></span>
        </fieldset>
        <input name="admin_id" id="admin_id" value="<?php echo $admin_id; ?>" type="hidden" />
        <div class="offset-md-2">
            <input type="submit" value="Save" class="btn btn-info" onclick="return comparePW()"/>
        </div>
    </form>
</main>

<?php
require_once 'footer.php';
?>



