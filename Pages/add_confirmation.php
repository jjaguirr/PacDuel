<?php
require 'config.php';

$success=true;

if(!$_POST["friend"]||empty($_POST["friend"])){
    $success=false;
}
else{
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $sql="SELECT numfriends FROM Friends WHERE username='".$_SESSION['username']."';";
    $numuserfriends=intval($mysqli->query($sql));
    // check if already friends/if need to add columns
    $sql="UPDATE Friends SET numfriends=".($numuserfriends+1).", friend".($numuserfriends+1)."='".$_POST["friend"]."' WHERE username='". $_SESSION['username']."';";
    $executed=$mysqli->query($sql);
    if(!$executed) {
        echo $mysqli->error;
    }
    $sql="SELECT numfriends FROM Friends WHERE username='".$_POST['friend']."';";
    $numuserfriends=intval($mysqli->query($sql));
    $sql="UPDATE Friends SET numfriends=".($numuserfriends+1).", friend".($numuserfriends+1)."='".$_SESSION["username"]."' WHERE username='". $POST['friend']."';";
    $mysqli->close();
}

?>
<!DOCTYPE html>
<head>
    <title>Friend Added - PacDuel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="style.css" rel="stylesheet">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<html>
<body>
<?php include 'nav.php'?>
<?php if($success):?>
<h3 class="green">Friend Successfully Added</h3>

<?php else:?>
<h3 class="red_text">Error adding friend, please try again.</h3>

<?php endif;?>
<a href="home.php"><button class="btn btn-primary">Home</button></a>

</body>
</html>