<?php
  require 'config.php';
  $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  if($mysqli->connect_errno) {
    echo $mysqli->connect_error;
    exit();
  }
  $sql_registered = "SELECT * FROM profiles
  WHERE email = '".$_POST["email"]."';";
  $results_registered = $mysqli->query($sql_registered);
  if(!$results_registered){
    echo $mysqli->error;
    exit();
  }
  if($results_registered->num_rows > 0){
    $error = "Email has been already taken. Please choose another one.";
    $mysqli->close();
  }
  else{
  $target_dir ="profile_images/";
  $target_file = $target_dir . basename($_FILES["picture"]["name"]);
  move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file);
  $pass=hash("sha256",$_POST["password"]);
  $sql_prepared = "INSERT INTO profiles(firstname, lastname, photo_path, university_id, email, password)
    VALUES(?, ?, ?, ?, ?, ?);";
    $statement=$mysqli->prepare($sql_prepared);
    $statement->bind_param("sssiss", $_POST["firstname"], $_POST["lastname"], $_FILES["picture"]["name"], $_POST["university"], $_POST["email"], $pass);

  $executed=$statement->execute();
  if(!$executed) {
      echo $mysqli->error;
    }
  $mysqli->close();

}

?><!DOCTYPE html>
<html>
<head>
	<title>Sign Up Confirmation - PacDuel</title>
	<link href="https://fonts.googleapis.com/css?family=Fugaz+One&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="style.css" rel="stylesheet">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<?php include 'nav.php'; ?>
  <div class="container">
    <div class="row">
      <h1 class="brand-yellow header">Sign Up</h1>
    </div> 
  </div> 
  <?php if(isset($error) && !empty($error)):?>
    <p class="text-danger text-center"><?php echo $error;?></p>
    <div class="text-center" >
    <a href="signup.php"><button class="btn btn-primary mx-auto" id="view-event">Try again</button></a>
  </div>
  <?php else:?>
    <p class="text-success text-center">Account Successfully Created</p>
  
  <div class="text-center" >
    <a href="login.php"><button class="btn btn-primary mx-auto" id="view-event">Log in</button></a>
  </div>
  <?php endif;?>
</body>
</html>