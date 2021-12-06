<?php
require 'config.php';
if( !isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {

    header('Location: login.php');
}

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$sql="SELECT username,high_score,profimage FROM UserInfo ORDER BY high_score DESC";
$results=$mysqli->query($sql);
if(!$results){
	echo $mysqli->connect_error;
    exit();
}
$mysqli->close();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Leaderboard - PacDuel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="style.css" rel="stylesheet">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<?php include 'nav.php'; ?>
<div class="container">
    <h1 class="login-header">Leaderboard</h1>
<?php if(!$results || $results==""):?>
	<div class="row">
		<h3> No people found!</h3>
	</div>
<?php else:?>
    <?php $counter=1;?>
<?php while($row=$results->fetch_assoc()): ?>
	<div class="row">
	<img src="prof_pictures/<?php echo $row['profimage']; ?>.jpg" class="profpic">
    <h3 class="white"><?php echo $counter.". ".$row['username']." - ".$row["high_score"]?></h3>
    <?php $counter++;?>
    </div>
<hr class="my4">
<?php endwhile?>
<?php endif;?>
</div>
</body>
</html>