<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/header_style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div class="topnav">
		<form method="POST" action="header.php">
			<p></p>
			<input type="submit" value="Sair" id="button_sair" name="button_sair">
<!-- 			<input type="image" class="img_user" id="img_user" name="img_user" src="imgs/copy_icon.png" alt="Icone usuario"> -->
			<label>Euklides</label>
		</form>
	</div>
</body>
</html>

<?php

	if (isset($_POST["button_sair"])) {
		session_start();
		session_destroy();
		header("location: http://localhost/euklides/plataforma-euklides/index.php");
	}

?>