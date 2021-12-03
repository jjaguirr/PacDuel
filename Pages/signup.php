
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
			<form action="signup_confirmation.php" method="POST">
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
					<input type="text" class="form-control" id="username-id" name="username" placeholder="username">
					<small id="username-error" class="invalid-feedback">Username is required.</small>
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
	if ( document.querySelector('#username-id').value.trim().length == 0 ) {
		document.querySelector('#username-id').classList.add('is-invalid');
	} 
	else {
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
</body>
</html>