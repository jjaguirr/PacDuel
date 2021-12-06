<?php 
    require 'config.php';
    if( !isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {

        header('Location: login.php');
    }
    else{
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    //find friend and delete them
    $executed=$mysqli->query($sql);
    $success=true;
    if(!$executed){
        $success=false;
    }
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
