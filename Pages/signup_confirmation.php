<?php
  require 'config.php';
  $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  if($mysqli->connect_errno) {
    echo $mysqli->connect_error;
    exit();
  }
  $sql_registered = "SELECT * FROM UserInfo WHERE username ='".$_POST["username"]."';";
  $results_registered = $mysqli->query($sql_registered);
  if(!$results_registered){
    echo $mysqli->error;
    exit();
  }
  if($results_registered->num_rows > 0){
    $error = "Username has been already taken. Please choose another one.";
    $mysqli->close();
  }
  else{

  $pass=hash("sha256",$_POST["password"]);
  $image=strval(rand(1,6));
  $friends=0;
  $sql_prepared1="INSERT INTO Friends(username,numfriends)
  VALUES(?,?);";
  $statement=$mysqli->prepare($sql_prepared1);
  $statement->bind_param("si", $_POST["username"],$friends);

  $executed=$statement->execute();
  if(!$executed) {
      echo $mysqli->error;
  }
  $sql_prepared2 = "INSERT INTO UserInfo(username, passcode, profimage)
  VALUES(?, ?, ?);";
  $statement=$mysqli->prepare($sql_prepared2);
  $statement->bind_param("sss", $_POST["username"], $pass,$image);

  $executed=$statement->execute();
  if(!$executed) {
      echo $mysqli->error;
    }
  $mysqli->close();

}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign Up Confirmation - PacDuel</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="style.css" rel="stylesheet">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<?php include 'nav.php'; ?>
  <div class="container mid">
    
    <h1 class="login-header">Sign Up</h1>
    

  
  <?php if(isset($error) && !empty($error)):?>
    <p class="text-danger text-center"><?php echo $error;?></p>
    <div class="mid" >
    <a href="signup.php"><button class="btn btn-primary mx-auto" id="view-event">Try again</button></a>
  </div>
  <?php else:?>
  <div class="mid">
    <p class="text-success text-center">Account Successfully Created</p>
  </div>
  <div class="mid">
    <a href="login.php"><button class="btn btn-primary mx-auto" id="view-event">Log in</button></a>
  </div>
  <?php endif;?>
  </div>
</body>
</html>