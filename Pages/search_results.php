<?php
require 'config.php';
if( !isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {

    header('Location: login.php');
}

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$sql="SELECT * FROM UserInfo";
if(!empty($_GET['search_query'])){
	$sql = $sql . " WHERE username LIKE'%". $_GET['search_query']."%';";
}


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
	<title>Search Results - PacDuel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="style.css" rel="stylesheet">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<?php include 'nav.php'; ?>
<div class="container">
<?php if(!$results || $results==""):?>
	<div class="row">
		<h3> No people found!</h3>
	</div>
<?php else:?>
<?php while($row=$results->fetch_assoc()): ?>
	<div class="row">
	<img src="prof_pictures/<?php echo $row['profimage']; ?>.jpg" class="profpic">
    <h3><?php echo $row['username']?></h3>
	<form action="add_confirmation.php" method="POST">
	<input type="hidden" name="friend" value="<?php echo $row['username'];?>" >
    <button type="submit" class="btn btn-primary" >Add</button>
	</form>
    </div>
<hr class="my4">
<?php endwhile?>
<?php endif;?>
</div>
</body>
</html>