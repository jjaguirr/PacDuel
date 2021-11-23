
<!DOCTYPE html>
<html>
<head>
	<title>Sign Up - PacDuel</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="style.css" rel="stylesheet">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
	
<div class="container" id="signin-container">
			<h1 class="login-header">Sign Up</h1>
			<form action="login.php" method="POST">
				<div class="row mb-3">
				<div class="font-italic text-danger col-sm-9">
					<?php
						if ( isset($error) && !empty($error) ) {
							echo $error;
						}
					?>
				</div>
			</div>
			<div class="form-group">
					<input type="text" class="form-control" id="firstname-id" name="firstname" placeholder="First Name">
					<small id="firstname-error" class="invalid-feedback">First Name is required.</small>
				</div>
				<div class="form-group">
					<input type="text" class="form-control" id="lastname-id" name="lastname" placeholder="Last Name">
					<small id="lastname-error" class="invalid-feedback">Last Name is required.</small>
				</div>
				<div class="form-group">
					<input type="text" class="form-control" id="email-id" name="email" placeholder="email">
					<small id="email-error" class="invalid-feedback">Email is required.</small>
				</div>
			

			
				<div class="form-group">
					<input class="form-control" type="password" id="password-id" name="password" placeholder="password">
					<small id="password-error" class="invalid-feedback">Password is required.</small>
			</div> 

			<div class="col text-center">
					<button type="submit" class="btn btn-primary login-btn">Register</button>
					</div>
				
		</form>
		
<script>
			
	document.querySelector('form').onsubmit = function(){
	if ( document.querySelector('#firstname-id').value.trim().length == 0 ) {
		document.querySelector('#firstname-id').classList.add('is-invalid');
	} 
	else {
		document.querySelector('#firstname-id').classList.remove('is-invalid');
	}
	if ( document.querySelector('#lastname-id').value.trim().length == 0 ) {
		document.querySelector('#lastname-id').classList.add('is-invalid');
	} 
	else {
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
	return ( !document.querySelectorAll('.is-invalid').length > 0 );
</script>
</body>
</html>