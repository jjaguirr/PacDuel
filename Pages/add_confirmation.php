<?php
require 'config.php';

$success=true;

if(!$_POST["friend"]||empty($_POST["friend"])){
    $success=false;
}
else{
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $sql="SELECT numfriends FROM Friends WHERE sno=".$_SESSION['sno'].";";
    $numuserfriends1=intval($mysqli->query($sql))+1;
    $findsql = "SELECT sno FROM UserInfo WHERE username='".$_POST["friend"]."';";
    $sno=intval($mysqli->query($findsql));
    // check if already friends/if need to add columns
    $sql="UPDATE Friends SET numfriends=".($numuserfriends1).", friend".($numuserfriends1)."=".$sno." WHERE sno=". $_SESSION['sno'].";";
    $executed=$mysqli->query($sql);
    if(!$executed) {
        echo $mysqli->error;
    }
    $sql="SELECT numfriends FROM Friends WHERE sno=".$sno.";";
    $numuserfriends2=intval($mysqli->query($sql))+1;
    $sql="UPDATE Friends SET numfriends=".($numuserfriends2).", friend".($numuserfriends2)."='".$_SESSION["sno"]."' WHERE sno=". $sno.";";
    $executed=$mysqli->query($sql);
    if(!$executed) {
        echo $mysqli->error;
    }
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
    <?php echo $findsql. $sno?>
<h3 class="green">Friend Successfully Added</h3>

<?php else:?>
<h3 class="red_text">Error adding friend, please try again.</h3>

<?php endif;?>
<a href="home.php"><button class="btn btn-primary">Home</button></a>

</body>
</html>