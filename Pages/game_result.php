<?php
//negative = score sent, positive = challenge received
require 'config.php';

if( !isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {

	header('Location: home.php');
}
else if((!isset($_POST['score'])||!$_POST['score'])||(!isset($_POST['opponent'])||!$_POST['opponent'])){
    header('Location: home.php');
}
else if(!isset($_POST['friendnum'])||!$_POST['friendnum']){
    header('Location: home.php');
}
else{
    $opponent=intval($_POST["opponent"]);
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $sql1="SELECT high_score FROM UserInfo WHERE sno=?;";
    $statement=$mysqli->prepare($sql1);
    $statement->bind_param('i',$_SESSION['sno']);
    $executed=$statement->execute();
    if(!$executed){
        echo "1";
    }
    $result=$statement->get_result();
    $row=$result->fetch_object();
    $high_score=intval($row->high_score);

    $score=intval($_POST['score']);
    if($score>$high_score){
        $updatesql="UPDATE UserInfo SET high_score=? WHERE sno=?;";
        $statement=$mysqli->prepare($updatesql);
        $statement->bind_param('ii',$score,$_SESSION['sno']);
        $executed=$statement->execute();
        if(!$executed){
            echo "2";
        }
    }
    $friendnum=$_POST["friendnum"];
    $sql1="SELECT game".$friendnum." FROM UserInfo WHERE sno=?;";
    $statement=$mysqli->prepare($sql1);
    $statement->bind_param('i',$_SESSION['sno']);
    $executed=$statement->execute();
    if(!$executed){
        echo "3";
    }
    
    $result=$statement->get_result();
    $row=$result->fetch_assoc();
    $opponentScore=intval($row["game".$friendnum]);
    $outcome="";
    $opscore=-$score;
    if($opponentScore==0){
        $outcome="waiting";
        $sql= "UPDATE UserInfo SET game".$friendnum."=? WHERE sno=?;";
        $statement=$mysqli->prepare($sql);
        $statement->bind_param("ii",$opscore,$_SESSION["sno"]);
        $executed = $statement->execute();
        if(!$executed){
            echo "6";
        }
        
        $friendsql="SELECT friend1, friend2, friend3,friend4,friend5 FROM Friends WHERE sno=?;";
        $statement=$mysqli->prepare($friendsql);
        $statement->bind_param("i",$opponent);
        $executed=$statement->execute();
        if(!$executed){
            echo "5";
        }
        $results=$statement->get_result();
        $row=$results->fetch_assoc();
        $userno=0;
        for($i=1;$i<=5;$i++){
            $temp = intval($row["friend".$i]);
            if($temp==$_SESSION["sno"]){
                $userno=$i;
            }
        }
        $sql= "UPDATE UserInfo SET game".$userno."=? WHERE sno=?;";
        $statement=$mysqli->prepare($sql);
        $statement->bind_param("ii",$score,$opponent);
        $executed = $statement->execute();
        if(!$executed){
            echo "6";
        }

    }
    else{
    if($opponentScore>$score){
        $outcome="loss";
    }

    else{
       $outcome="win";
    }//before this
    $usersql="UPDATE UserInfo SET game".$friendnum."=0 WHERE sno=?;";
    $statement=$mysqli->prepare($usersql);
    $statement->bind_param("i",$_SESSION["sno"]);
    $executed=$statement->execute();
    if(!$executed){
        echo "4";
    }

    $friendsql="SELECT friend1, friend2, friend3,friend4,friend5 FROM Friends WHERE sno=?;";
    $statement=$mysqli->prepare($friendsql);
    $statement->bind_param("i",$opponent);
    $executed=$statement->execute();
    if(!$executed){
        echo "5";
    }
    $results=$statement->get_result();
    $row=$results->fetch_assoc();
    $userno=0;
    $opponentScore = -$opponentScore;
    for($i=1;$i<=5;$i++){
        if($row["friend".$i]==($_SESSION["sno"])){
            $userno=$i;
        }
    }
    $friendsql="UPDATE UserInfo SET game".$userno."=0 WHERE sno=?;";
    $statement=$mysqli->prepare($friendsql);
    $statement->bind_param("i",$opponent);
    $executed=$statement->execute();
    if(!$executed){
        echo "6";
    }
}

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Game Result - PacDuel</title>
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="style.css" rel="stylesheet">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<div class="container" id="login-container">
    <?php if($outcome=="waiting"):?>
			<h1 class="login-header">Waiting for other player...</h1>
    <?php elseif($outcome=="win"):?>
        <h1 class="login-header">You Win!</h1>
    <?php else:?>
        <h1 class="login-header">You Lose.</h1>
    <?php endif;?>
    <div class="col text-center">
                <a href="home.php" class="btn btn-primary" id="home-button">Leaderboard</a>
				<a href="home.php" class="btn btn-primary" id="home-button">Home</a>
		</div>
					
<script>
			
	document.querySelector('form').onsubmit = function(){
	if ( document.querySelector('#username-id').value.trim().length == 0 ) {
		document.querySelector('#username-id').classList.add('is-invalid');
	} else {
		document.querySelector('#username-id').classList.remove('is-invalid');
	}

	if ( document.querySelector('#password-id').value.trim().length == 0 ) {
		document.querySelector('#password-id').classList.add('is-invalid');
	} else {
		document.querySelector('#password-id').classList.remove('is-invalid');
	}
	return ( !document.querySelectorAll('.is-invalid').length > 0 );
}
</script>

</div>
</body>
</html>