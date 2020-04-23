<?php
include('functions.php');
// include('usersidebar.php');
?>

<!DOCTYPE html>
<html>

<head>
	<title>Inloggen</title>
	<link rel="stylesheet" href="css/stylingglobal.css">
</head>

<body>
	<div class="content">
		<form method="post">
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
	</div>
</body>

</html>