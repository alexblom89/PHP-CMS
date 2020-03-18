<?php
$title = 'Registration';
require_once('header.php');
?>

<main class="container">
    <h1>Register With Us!</h1>
    <form method="post" action="save-registration.php">
        <fieldset class="form-group">
            <label for="email" class="col-md-2">Email Address:</label>
            <input name="email" id="email" required type="email"/>
        </fieldset>
        <fieldset class="form-group">
            <label for="username" class="col-md-2">Username:</label>
            <input name="username" id="username" required/>
        </fieldset>
        <fieldset class="form-group">
            <label for="password" class="col-md-2">Password:</label>
            <input type="password" name="password" id="password" required
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"/>
            <img id="showIcon" src="img/show.png" alt="Show/Hide Password" onclick="showPW()">
        </fieldset>
        <fieldset class="form-group">
            <label for="confirm" class="col-md-2">Confirm Password:</label>
            <input type="password" name="confirm" id="confirm" required
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                    onkeyup="return comparePW()"/>
            <span id="pwMsg"></span>
        </fieldset>
        <div class="offset-md-2">
            <input type="submit" value="Register" class="btn btn-info" onclick="return comparePW()"/>
        </div>
    </form>
</main>

<?php
require_once 'footer.php';
?>


