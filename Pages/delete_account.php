<?php 
    require 'config.php';
    $success=true;
    if( !isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {

        header('Location: login.php');
    }
    else{
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $sql="DELETE FROM UserInfo WHERE sno='".$_SESSION["sno"]."';";
    $result=$mysqli->query($sql);
    if(!$result){
        $success=false;
    }
    session_destroy();
}
?>
<head>
	<title>Delete Account- PacDuel</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="style.css" rel="stylesheet">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<div class="container" >
<?php if($success):?>
<h3 class="green">Account Successfully Deleted</h3>

<?php else:?>
<h3 class="red_text">Error deleting account, please try again.</h3>

<?php endif;?>
<a href="login.php"><button class="btn btn-primary">Log In</button></a>
</div>
</body>
</html>
