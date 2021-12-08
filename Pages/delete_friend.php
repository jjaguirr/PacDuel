<?php 
    require 'config.php';
    if( !isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {

        header('Location: login.php');
    }
    if(!isset($_POST['friend'])||!$_POST['friend']){
        header('Location: home.php');
    }
    else{
    $friend=intval($_POST['friend']);
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    //remove from user's list
    $sql1="SELECT * FROM Friends WHERE sno=?;";
    $statement=$mysqli->prepare($sql1);
    $statement->bind_param('i',$_SESSION['sno']);
    $executed=$statement->execute();
    if(!$executed){
        echo "1";
    }
    $result=$statement->get_result();
    $row=$result->fetch_assoc();
    $numfriends1=intval($row["numfriends"]);
    
    $found=false;
    for($i=1;$i<=$numfriends1;$i++){
        if($found){
            $removesql="UPDATE Friends SET friend".($i-1)."=? WHERE sno=?;";
            $statement=$mysqli->prepare($removesql);
            $statement->bind_param("ii",$row["friend".$i],$_SESSION['sno']);
            $executed=$statement->execute();
            if(!$executed){
                echo "2";
            }
            if($i==$numfriends1){
            $removesql="UPDATE Friends SET friend".($i)."=NULL, numfriends=? WHERE sno=?;";
            $statement=$mysqli->prepare($removesql);
            $statement->bind_param("ii",($numfriends1-1),$_SESSION["sno"]);
            $executed=$statement->execute();
            if(!$executed){
                echo "3";
            }
            }
        }
        else if(intval($friend)==intval($row["friend".$i])){
            $found=true;
        }
    }
        
    //remove from friend's list
    $sql2="SELECT * FROM Friends WHERE sno=?;";
    $statement=$mysqli->prepare($sql2);
    $statement->bind_param('i',$friend);
    $executed=$statement->execute();
    if(!$executed){
        echo "4";
    }
    $result=$statement->get_result();
    $row=$result->fetch_assoc();
    $numfriends1=intval($row["numfriends"]);
    $found=false;
    for($i=1;$i<=$numfriends1;$i++){
        if($found){
            $removesql="UPDATE Friends SET friend".($i-1)."=? WHERE sno=?;";
            $statement=$mysqli->prepare($removesql);
            $statement->bind_param("ii",$row["friend".$i],$friend);
            $executed=$statement->execute();
            if(!$executed){
                echo "2";
            }
            if($i==$numfriends1){
            $removesql="UPDATE Friends SET friend".($i)."=NULL, numfriends=? WHERE sno=?;";
            $statement=$mysqli->prepare($removesql);
            $statement->bind_param("ii",($numfriends1-1),$_SESSION["sno"]);
            $executed=$statement->execute();
            if(!$executed){
                echo "3";
            }
            }
        }
        else if(intval($friend)==intval($row["friend".$i])){
            $found=true;
        }
    }
    //delete games
}

    
?>
<head>
	<title>Delete Friend- PacDuel</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="style.css" rel="stylesheet">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<?php include "nav.php"?>
<div class="container" >
<?php if($success):?>
<h3 class="green">Friend Successfully Deleted</h3>

<?php else:?>
<h3 class="red_text">Error deleting friend, please try again.</h3>

<?php endif;?>
<a href="home.php"><button class="btn btn-primary">Home</button></a>
</div>
</body>
</html>
