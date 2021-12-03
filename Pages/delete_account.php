<?php 
    require 'config.php';
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    //delete account using POST
    if(!$_POST["friend"]||empty($_POST["friend"])){
        $success=false;
    }
    // session_destroy(); add to JS of profile page
?>
<?php if($success):?>
<h3 class="green">Account Successfully Deleted</h3>

<?php else:?>
<h3 class="red_text">Error deleting account, please try again.</h3>

<?php endif;?>
<a href="login.php"><button class="btn btn-primary">Log In</button></a>

