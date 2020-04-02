<?php
$title = 'Registration';
require_once('header.php');
?>

    <h1 class="text-justify">Register With Us!</h1>
    <form method="post" action="save-registration.php" class="form-group">
        <fieldset  class="form-group">
            <label for="username" class="col-md-2">Username:</label>
            <input name="username" id="username" required type="email"/>
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
        <div class="offset-md-2">
            <input type="submit" value="Register" class="btn btn-info" onclick="return comparePW()"/>
        </div>
    </form>
</main>

<?php
require_once 'footer.php';
?>


