<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/header_style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div class="topnav">
		<form method="POST" action="header.php">
			<input type="submit" value="Sair" id="button_sair" name="button_sair">
<!-- 			<input type="image" class="img_user" id="img_user" name="img_user" src="imgs/copy_icon.png" alt="Icone usuario"> -->
			<img alt="Euklides" src="http://localhost/plataforma-euklides/imgs/euklides_marca.png" width=160px height=60px>
		</form>
	</div>
</body>
</html>

<!-- header para todas as telas exceto a de cadastro/login que não tem botão de sair -->


<?php

	if (isset($_POST["button_sair"])) {
		session_start();
		session_destroy();
		header("location: http://localhost/plataforma-euklides/index.php");
	}

?>