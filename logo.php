<?php
$title = 'Upload Logo';
require_once('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logo Upload Page</title>
</head>
<body>

<form method="post" action="upload-logo.php" enctype="multipart/form-data">
    <fieldset>
        <label for="logo_file">Upload Logo File:</label>
        <input name="logo_file" id="logo_file" type="file" />
    </fieldset>
    <button>Submit</button>
</form>
</body>
</html>

<?php
require_once 'footer.php';
?>