<?php
require 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title> Your Profile - PacDuel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="style.css" rel="stylesheet">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<?php include 'nav.php'; ?>
<div class="prof">
<img src="prof_pictures/<?php echo $_SESSION['profimage']?>.jpg" class="enlarged">
<h1 id="prof_username"><?php echo $_SESSION['username']?></h1>
<a href="change_username.php"?><button class="btn btn-primary">Change Username</button></a>
<a href="delete_account.php"?><button class="red btn ">Delete Account</button></a>
<!-- add javascript for changing & deleting -->
</div>
</body>
</html>