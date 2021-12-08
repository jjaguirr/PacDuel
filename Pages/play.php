<?php 
    require 'config.php';
    if( !isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {

        header('Location: login.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Play - PacDuel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="style.css" rel="stylesheet">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body id="game">

    <?php include 'nav.php';?>
	
<div class="container">

<p><a href="https://github.com/daleharvey/pacman" target="_blank">Credits: https://github.com/daleharvey/pacman</a></p>

<div id="pacman"></div>


<form  action="game_result.php" method="GET">
    <input type="hidden" id="score" name="score">
    <button type="submit" id="result" class="btn login-btn">View Results</button> 
    <h3 class="white"id="scoredisplay"></h3>
</form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="game.js"></script>
</body>
</html>