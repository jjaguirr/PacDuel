<!-- <?php
require 'config.php';
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$sql = "SELECT * FROM universities";
$results=$mysqli->query($sql);
if(!$results){
	echo $mysqli->connect_error;
    exit();
}
?> -->
<!DOCTYPE html>
<html>
<head>
	<title>Sign Up - PacDuel</title>
	<link href="https://fonts.googleapis.com/css?family=Fugaz+One&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="style.css" rel="stylesheet">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
	
<div class="container">
		<div class="row">
			<h1 class="brand-yellow header">Sign Up</h1>
		</div> 
	</div> 

	<div class="container">

		<form action="signup_confirmation.php" method="POST" enctype="multipart/form-data">
			<div class="row">
				
					<label for="firstname-id" class="col-sm-3 text-sm-right col-form-label">First Name: <span class="text-danger">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="firstname-id" name="firstname">
					<small id="firstname-error" class="invalid-feedback">First Name is required.</small>
				</div>
			</div>
			<div class="row">
				
					<label for="lastname-id" class="col-sm-3 text-sm-right col-form-label">Last Name: <span class="text-danger">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="lastname-id" name="lastname">
					<small id="lastname-error" class="invalid-feedback">Last Name is required.</small>
				</div>
			</div>  

			<div class="row">
				<label for="email-id" class="col-sm-3 text-sm-right form-label" >Email: <span class="text-danger">*</span></label>
				<div class="col-sm-9">
					<input type="email" class="form-control" id="email-id" name="email">
					<small id="email-error" class="invalid-feedback">Email is required.</small>
					</div>
			</div>

			<div class="row">
				<label for="password-id" class="col-sm-3 form-label text-sm-right">Password: <span class="text-danger">*</span></label>
				<div class="col-sm-9">
					<input type="password" class="form-control" id="password-id" name="password">
					<small id="password-error" class="invalid-feedback">Password is required.</small>
					</div>
			</div> 
			<div class="row">
				<label for="university-input" class="col-sm-3 form-label text-sm-right">University: <span class="text-danger">*</span></label>
				<div class="col-sm-9">
					<select class="form-control" id="university-input" name="university">
						<option selected disabled value="">--</option>
						<?php while($row = $results->fetch_assoc()): ?>
						<option value=<?php echo $row['id'];?>><?php echo $row['name']; ?></option>
					<?php endwhile;?>
					</select>
					<small id="university-error" class="invalid-feedback">University is required.</small>
					</div>
			</div> 
			<div class="row">
				<label for="picture-id" class="col-sm-3 form-label text-sm-right">Picture (Square Preferred): <span class="text-danger">*</span></label>
				<div class="col-sm-9">
					<input type="file" id="picture-id" name="picture" accept="image/png, image/jpg, image/jpeg">
					<p class="text-danger"id="picture-error"></p>
					</div>
			</div> 
			<div class="row">
					<div class="col-md-2 mx-auto">
					<span class="text-danger font-italic">* Required</span>
				</div>
			</div>

			<div class="row">
				<div class="col-md-2 mx-auto">
					<button type="submit" class="btn btn-primary">Sign Up</button>
					</div>

			</div> 

			<div class="row">
				<div class="col-md-3 mx-auto">
					<a href="login.php">Already have an account</a>
			</div> 

		</form>
	</div> 
<script>
			
	document.querySelector('form').onsubmit = function(){
	if ( document.querySelector('#firstname-id').value.trim().length == 0 ) {
		document.querySelector('#firstname-id').classList.add('is-invalid');
	} else {
		document.querySelector('#firstname-id').classList.remove('is-invalid');
	}

	if ( document.querySelector('#lastname-id').value.trim().length == 0 ) {
		document.querySelector('#lastname-id').classList.add('is-invalid');
	} else {
		document.querySelector('#lastname-id').classList.remove('is-invalid');
	}
	if ( document.querySelector('#email-id').value.trim().length == 0 ) {
		document.querySelector('#email-id').classList.add('is-invalid');
	} else {
		document.querySelector('#email-id').classList.remove('is-invalid');
	}
	if ( document.querySelector('#password-id').value.trim().length == 0 ) {
		document.querySelector('#password-id').classList.add('is-invalid');
	} else {
		document.querySelector('#password-id').classList.remove('is-invalid');
	}
	if ( document.querySelector('#university-id').value == "" ) {
		document.querySelector('#university-id').classList.add('is-invalid');
	
	} else {
		document.querySelector('#university-id').classList.remove('is-invalid');
	}
	if ( document.querySelector('#picture-id').value.trim().length ==0) {
				document.querySelector('#picture-error').
					innerHTML="Picture is required.";
					document.querySelector("#picture-id").classList.add("is-invalid");
			} 
	else {
				document.querySelector('#picture-id').document.querySelector("#picture-error").innerHTML="";
				
			
			}
	
	return ( !document.querySelectorAll('.is-invalid').length > 0);

}
</script>
</body>
</html>