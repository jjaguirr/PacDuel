<nav class="navbar navbar-custom">
  <a class="navbar-brand" href="home.php">PacDuel</a>
  <?php if ( !isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] ) : ?>
    <ul class="navbar-nav ml-auto">
       <li class="nav-item">
        <a class="nav-link" href="login.php">Log In/Register</a>
      </li>
      </ul>
    <?php else : ?>
    	<div class="p-2 ml-auto"><a href="profile.php?name=<?php echo $_SESSION['username']?>" id="prof_link"><?php echo $_SESSION["username"]?></a></div>

		<a class="p-2" href="logout.php">Logout</a>
  <?php endif;?>

</nav>