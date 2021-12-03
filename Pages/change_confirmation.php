<?php
require 'config.php';

$success=true;

if(!$_POST["username"]|empty($_POST["username"])){
    $success=false;
}
else{
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    //check if username is in use

    $sql="UPDATE UserInfo VALUES username='".$_POST['username']."' WHERE username=".$_SESSION['username'].";";
    $executed=$mysqli->query($sql);
    if(!$executed) {
        echo $mysqli->error;
    }
    $sql="UPDATE Friends VALUES username='".$_POST['username']."' WHERE username=".$_SESSION['username'].";";
    $executed=$mysqli->query($sql);
    if(!$executed) {
        echo $mysqli->error;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Username- PacDuel</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="style.css" rel="stylesheet">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<?php if($success):?>
<h3 class="green">Username Successfully Changed</h3>

<?php else:?>
<h3 class="red_text">Error changing username, please try again.</h3>

<?php endif;?>
<a href="home.php"><button class="btn btn-primary">Home</button></a>	

</form>
</div>
</body>
</html>

