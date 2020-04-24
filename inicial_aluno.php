<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Inicial aluno</title>
</head>
<body>
  <form method="POST" action="inicial_aluno.php">
	<input type="submit" value="Criar sala" id="nova_sala" name="nova_sala">
  </form>
</body>
</html>

<?php
$email = $_COOKIE['email'];

$connect = mysqli_connect('localhost','root','admin');
$db = mysqli_select_db($connect,'euklides');

$query_select_aluno = "SELECT s.nome FROM aluno a, sala s WHERE a.email = '$email' AND
					s.id = a.sala_id";
$select_aluno = mysqli_query($connect,$query_select_aluno);
$array_aluno = mysqli_fetch_array($select_aluno);
$nome_sala = $array_aluno['nome'];

echo '<p>Você está na sala '.$nome_sala.'</p>';
?>
