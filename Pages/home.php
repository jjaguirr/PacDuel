<?php
require 'config.php';
if( !isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {

    header('Location:login.php');

}
else{

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$sql1="SELECT numfriends FROM Friends WHERE sno=?;";
$statement=$mysqli->prepare($sql1);
$statement->bind_param('i',$_SESSION['sno']);
$executed=$statement->execute();
if(!$executed){
    echo "1";
}
$result=$statement->get_result();
$row=$result->fetch_object();
$numuserfriends=intval($row->numfriends);
$sql="SELECT UserInfo.username, UserInfo.profimage, UserInfo.sno FROM Friends INNER JOIN UserInfo ON (Friends.friend1=UserInfo.sno";
for($i=1;$i<$numuserfriends;$i++){
    $sql=$sql ." OR Friends.friend".($i+1)."=UserInfo.sno";
}

$sql=$sql.") WHERE Friends.sno=?;";
$statement=$mysqli->prepare($sql);
$statement->bind_param('i',$_SESSION['sno']);
$statement->execute();
$results=$statement->get_result();
if(!$results){
	echo $mysqli->connect_error;
    exit();
}


$sql2="SELECT game1, game2, game3, game4, game5 FROM UserInfo WHERE sno=?;";
$statement=$mysqli->prepare($sql2);
$statement->bind_param('i',$_SESSION['sno']);
$executed=$statement->execute();
if(!$executed){
    echo "2";
}
$result=$statement->get_result();
$gamerow=$result->fetch_assoc();

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
    <h2 class="white"> Ready to play!</h2> 
    <?php $friendnum=1;?> 
    <?php while($row=$results->fetch_assoc()):?>
    <?php if($gamerow["game".$friendnum]>=0):?>
    <div class="row userrow">
    <img src="prof_pictures/<?php echo $row['profimage']; ?>.jpg" class="profpic">
    <h3 class="white"><?php echo $row['username']?></h3>
    <!-- <form action="chat.php" method="POST" class="nobackground">
        <input type="hidden" name="friend" value="<?php echo $row['sno']?>">
        <button type="submit" class="nobackground"><i class="far fa-comment-alt white"></i></button>
    </form>  this is the chat function we were going to implement-->
    <form action="play.php" method="POST">
    <input type="hidden" name="opponent" value="<?php echo $row['sno']?>">
    <input type="hidden" name="friendnum" value=<?php echo $friendnum;?>>
    <button type="submit" class="nobackground"><i class="fas fa-play white icon"></i></button>
    </form>
    <form action="delete_friend.php" method="POST" class="nobackground">
    <input type="hidden" name="friend" value="<?php echo $row['sno']?>">
    <input type="hidden" name="friendnum" value=$friendnum>
    <button type="submit" class="nobackground"><i class="fas fa-times white icon"></i></button>
    </form>
    </div>

    <?php endif;?>
    <?php $friendnum++;?>
    <?php endwhile?>
    <?php
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $sql="SELECT UserInfo.username, UserInfo.profimage, UserInfo.sno FROM Friends INNER JOIN UserInfo ON (Friends.friend1=UserInfo.sno";
    for($i=1;$i<$numuserfriends;$i++){
        $sql=$sql ." OR Friends.friend".($i+1)."=UserInfo.sno";
    }

    $sql=$sql.") WHERE Friends.sno=?;";
    $statement=$mysqli->prepare($sql);
    $statement->bind_param('i',$_SESSION['sno']);
    $statement->execute();
    $results=$statement->get_result();
    $mysqli->close();?>

    <h2 class="white"> Waiting to play...</h2>
    <?php $friendnum=1;?>
    <?php while($row=$results->fetch_assoc()):?>
    <?php if($gamerow["game".$friendnum]<0):?>
    <div class="row userrow">
    <img src="prof_pictures/<?php echo $row['profimage']; ?>.jpg" class="profpic">
    <h3 class="white"><?php echo $row['username']?></h3>
    <!-- <form action="chat.php" method="POST" class="nobackground">
        <input type="hidden" name="friend" value="<?php echo $row['sno']?>">
        <button type="submit" class="nobackground"><i class="far fa-comment-alt white"></i></button>
    </form>  this is the chat function we were going to implement-->

    <form action="delete_friend.php" method="POST" class="nobackground">
    <input type="hidden" name="friend" value="<?php echo $row['sno']?>">
    <input type="hidden" name="friendnum" value=$friendnum>
    <button type="submit" class="nobackground"><i class="fas fa-times white icon"></i></button>
    </form>
    </div>
    <?php endif;?>
    <?php $friendnum++;?>
    <?php endwhile?>

    </div>
</body>
</html>