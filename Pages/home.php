<?php
require 'config.php';
if( !isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {

    header('Location:login.php');
    //login features?
}
else{

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$sql="SELECT UserInfo.username, UserInfo.profimage FROM Friends INNER JOIN UserInfo ON(Friends.friend1=UserInfo.sno) WHERE Friends.sno=".$_SESSION['sno'].";";
$results=$mysqli->query($sql);
if(!$results){
	echo $mysqli->connect_error;
    exit();
}
$mysqli->close();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home - PacDuel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="style.css" rel="stylesheet">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://kit.fontawesome.com/8a47b2dc26.js" crossorigin="anonymous"></script>
</head>
<body>
	<?php include 'nav.php'; ?>
    <div class="container mid">
    <form class="mid form-inline mr-auto" action="search_results.php" method="GET">
        <div class="form-group">
  	    <input class="form-control mr-sm-2" type="text" placeholder="Add a Friend..." aria-label="Search" name="search_query">
        <button class="btn btn-primary" type="submit">Search</button>
</div>
    </form>
    <?php if(!$results || empty($results)):?>
    <h2 class="white">No Friends yet!</h2>
    <?php else:?>
        
    <?php while($row=$results->fetch_assoc()):?>
    
    <div class="row userrow">
    <img src="prof_pictures/<?php echo $row['profimage']; ?>.jpg" class="profpic">
    <h3 class="white"><?php echo $row['username']?></h3>
    <i class="far fa-comment-alt white"></i>
    <a href="play.php"><i class="fas fa-play white icon"></i></a>
    <form action="delete_friend.php" method="POST">
    <input type="hidden" name="friend" value="<?php echo $row['username']?>">
    <button type="submit"><i class="fas fa-times white icon"></i></button>
    </form>
    </div>
    <?php endwhile?>
    <?php endif;?>

    </div>
</body>
</html>
