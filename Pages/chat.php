<?php
$host = "localhost";
$port = 3456;

if(!isset($_POST['friendID']) || empty($_POST['friendID'])){
    header("home.php");
}
if ( ($socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === FALSE ) {
    echo "socket_create() failed: reason: " . socket_strerror(socket_last_error());
}
else {
//attempt to connect to the first port
    echo "Attempting to connect to '$host' on port '$port'...<br>";
//check if other user is already connected
//server return that someone is already connected to the port
//check for the message that someone is already connected
    if (($result = socket_connect($socket, $host, $port)) === FALSE) {
        echo "socket_connect() failed. Reason: ($result) " . socket_strerror(socket_last_error($socket));
    }
}

$userID=$_POST['friendID'];
socket_write($socket,$userID."\r\n", strlen ($userID."\r\n"));

$data = readline('Enter your message: ');
echo "Sending data...<br>";
socket_write ($socket, $data."\r\n", strlen ($data."\r\n"));
//in java server, it'll read the what the user sent
echo "OK<br>";



echo "Reading response:<br>";
while ($out = socket_read($socket, 2048)) {
    echo $out;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Chat - PacDuel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="style.css" rel="stylesheet">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://kit.fontawesome.com/8a47b2dc26.js" crossorigin="anonymous"></script>
</head>
<body>
	<?php include 'nav.php'; ?>





    <input type="text" class="form-control" placeholder="Text to chat..." name="outgoing_chat">
</body>
</html>
