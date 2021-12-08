<?php
require 'config.php';

$success=true;
$alreadyfriends=false;

if(!$_POST["friend"]||empty($_POST["friend"])){
    $success=false;
}
else{
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $sql1="SELECT numfriends FROM Friends WHERE sno=?;";//1
    $statement=$mysqli->prepare($sql1);
    $statement->bind_param('i',$_SESSION['sno']);
    $executed=$statement->execute();
    if(!$executed){
        echo "1";
    }
    $result=$statement->get_result();
    $row=$result->fetch_object();
    $numuserfriends1=intval($row->numfriends)+1;

    $sql2 = "SELECT sno FROM UserInfo WHERE username=?;";//2
    $statement=$mysqli->prepare($sql2);
    $statement->bind_param('s',$_POST['friend']);
    $executed=$statement->execute();
    if(!$executed){
        echo "2";
    }
    $result=$statement->get_result();
    $row=$result->fetch_object();
    $sno=intval($row->sno);

    $checksql="SELECT * FROM Friends WHERE sno=? AND ? in (";
    for($i=1;$i<=$numuserfriends1;$i++){
        $checksql= $checksql."friend".$i;
        if($i!=$numuserfriends1){
            $checksql=$checksql.",";
        }
    }
    $checksql=$checksql . ");";
    $statement=$mysqli->prepare($checksql);
    $statement->bind_param("ii",$_SESSION['sno'],$sno);
    $executed=$statement->execute();
    if(!$executed){
        echo $statement->error;
    }
    $results=$statement->get_result();
    $checkrow=$results->fetch_object();
    if($checkrow && !empty($checkrow)){
        $alreadyfriends=true;
        $success=false;
    }
    else{



    $sql3="UPDATE Friends SET numfriends=?, friend".($numuserfriends1)."=? WHERE sno=?;";//3
    $statement=$mysqli->prepare($sql3);
    $statement->bind_param('iii',$numuserfriends1,$sno,$_SESSION['sno']);
    $executed=$statement->execute();
    if(!$executed){
        echo $statement->error;
    }
    
    $sql4="SELECT numfriends FROM Friends WHERE sno=?;";//4
    $statement=$mysqli->prepare($sql4);
    $statement->bind_param('i',$sno);
    $executed=$statement->execute();
    if(!$executed){
        echo "4";
    }
    $result=$statement->get_result();
    $row=$result->fetch_object();
    $numuserfriends2=intval($row->numfriends)+1;
    
    $sql5="UPDATE Friends SET numfriends=?, friend".($numuserfriends2)."=? WHERE sno=?;";//5
    $statement=$mysqli->prepare($sql5);
    $statement->bind_param('iii',$numuserfriends1,$_SESSION['sno'],$sno);
    $executed=$statement->execute();
    if(!$executed){
        echo $statement->error;
    }
    
    $mysqli->close();
}
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

<?php elseif($alreadyfriends):?>
<h3 class="red_text">Can't add user as they are already friends with you</h3>
<?php else:?>
<h3 class="red_text">Error adding friend, please try again.</h3>

<?php endif;?>
<a href="home.php"><button class="btn btn-primary">Home</button></a>

</body>
</html>