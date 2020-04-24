<?php
$nome_sala = $_POST['nome_sala'];
$email = $_COOKIE['email'];

$connect = mysqli_connect('localhost','root','admin');
$db = mysqli_select_db($connect,'euklides');

$query_select_professor = "SELECT id FROM professor WHERE email = '$email'";
$select_professor = mysqli_query($connect,$query_select_professor);
$array_professor = mysqli_fetch_array($select_professor);
$id_professor = $array_professor['id'];

$query = "INSERT INTO sala (nome,professor_id) VALUES ('$nome_sala',$id_professor)";
$insert = mysqli_query($connect,$query);

if($insert){
	echo"<script language='javascript' type='text/javascript'>
				alert('Sala cadastrada com sucesso!');";
	echo "javascript:window.location='sala.php?nome=".$nome_sala."';</script>";


} else {
	echo"<script language='javascript' type='text/javascript'>
		          alert('Não foi possível cadastrar essa sala');window.location
		          .href='inicial_professor.php'</script>";
}

?>