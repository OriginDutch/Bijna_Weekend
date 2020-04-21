<?php
include('functions.php');
include('sidebar.php');
?>

<!DOCTYPE html>
<html>

<head>
	<title>Inloggen</title>
	<link rel="stylesheet" type="text/css" href="style.css?version=51">
</head>

<body>

	<form method="post" action="login.php">
        <?php require_once('errors.php'); ?>

		<div class="input-group">
			<input type="text" name="email" placeholder="e-mail">
		</div>

		<div class="input-group">
			<input type="password" name="password" placeholder="wachtwoord">
		</div>

		<div class="input-group">
			<button type="submit" class="btn" name="login_btn">Inloggen</button>
		</div>
	</form>
</body>

</html>