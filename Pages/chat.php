<?php
require 'config.php';
$host = "localhost";
$port = 3457;

if ( ($socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === FALSE ) {
    echo "socket_create() failed: reason: " . socket_strerror(socket_last_error());
}
else {
    // echo "Attempting to connect to '$host' on port '$port'...<br>";
    if (($result = socket_connect($socket, $host, $port)) === FALSE) {
        echo "socket_connect() failed. Reason: ($result) " . socket_strerror(socket_last_error($socket));
    }
}

// if(!$_POST["friend"]){
//     header('Location: home.php');
// }
$friend=intval($_POST["friend"]);


$new_messages=array();

if($_PUSH["outgoing_chat"] && !empty($_PUSH["outgoing_chat"])){
    array_push($new_messages,"u:".$_PUSH["outgoing_chat"]);
}

socket_write($socket,$_SESSION['sno']."\r\n", strlen ($_SESSION['sno']."\r\n"));
socket_write($socket,$friend."\r\n", strlen ($friend."\r\n"));
$msg=socket_read($socket,2048)



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
<div id="messages">
        <div class="incoming_message"><?php echo $msg;?></div>
<?php foreach($_POST["messages"] as &$message):?>
    <?php if(substr($message,0,2)=="u:"):?>
        <div class="outgoing_message"><?php echo substr($message,2);?></div>
    <?php else:?>
        <div class="incoming_message"><?php echo substr($message,2);?></div>
    <?php endif;?>
    <?php endforeach;?>
    <div class="incoming_message"><?php echo $out;?></div>
    <?php array_push($new_messages,"f:".$out)?>
</div>
<form action="" method="POST" id="messagebox" onsubmit="addprefix()">
    <?php foreach($_POST["messages"] as &$message):?>
    <input type="text" value=$message name="messages[]" class="nod">
    <?php endforeach;?>
    <?php foreach($new_messages as &$message):?>
    <input type="text" value=$message name="messages[]" class="nod">
    <?php endforeach;?>

    <div class="form-group">
    <input type="text" class="form-control" placeholder="Text to chat..." name="outgoing_chat" id="outgoing_chat">
    <button type="submit" class="btn btn-primary" id="submitFormData">Send</button>
</div>
</form>
<div class="endchat">
<a href="home.php"><button class="red btn" >End Chat</button></a>
</div>

<script>
function addprefix(){
    var outgoing_chat=document.getElementById("outgoing_chat").value;
    var newchat="u:"+outgoing_chat;
    document.getElementById("outgoing_chat").setAttribute("value",newchat);
    
}
</script>
</body>
</html>
