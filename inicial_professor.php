<?php
//caso o professor tenha criado uma nova sala, a vari�vel $nome_sala ir� receber o nome digitado
$nome_sala = $_POST['nome_sala'];
//caso o professor tenha criado uma nova sala, a vari�vel $jogo ir� receber o c�digo do jogo selecionado
$cod_jogo = $_POST['jogo'];
//recebe o cookie referente ao email enviado pela p�gina login.php
$email = $_COOKIE['email'];
//exclui o cookie recebido
unset($_COOKIE['email']);

//cria a conex�o
$connect = mysqli_connect('localhost','root','admin');
//seleciona o banco de dados euklides
$db = mysqli_select_db($connect,'euklides');

//criada a query descobrir o id do professor com o email digitado
$query_select_professor = "SELECT id FROM professor WHERE email = '$email'";
//a vari�vel $select_professor recebe o resultado da execu��o dessa query
$select_professor = mysqli_query($connect,$query_select_professor);
//o array $array_professor recebe todos os valores da busca
$array_professor = mysqli_fetch_array($select_professor);
//a vari�vel $id_professor recebe o id do professor
$id_professor = $array_professor['id'];

//cria a query para criar uma nova sala
$query = "INSERT INTO sala (nome,professor_id) VALUES ('$nome_sala',$id_professor)";
//a vari�vel $insert recebe o resultado (true ou false) da inser��o
$insert = mysqli_query($connect,$query);

//cria a query para obter o id da sala
$query_select_sala = "SELECT id FROM sala WHERE nome='$nome_sala'";
//a vari�vel $select_sala recebe o resultado da execu��o da query
$select_sala = mysqli_query($connect,$query_select_sala);
//o array $array_sala recebe os valores retornados
$array_sala = mysqli_fetch_array($select_sala);
//a vari�vel $id_sala recebe o valor do array corresponde ao id
$id_sala = $array_sala['id'];

//cria a query para cadastrar o jogo e a sala na tabela sala_jogo
$query_insert_sala_jogo = "INSERT INTO sala_jogo (sala_id,jogo_id) VALUES ($id_sala,$cod_jogo)";
$insert_sala_jogo = mysqli_query($connect,$query_insert_sala_jogo);

//se a inser��o tiver ocorrido
if($insert){
	//emite a mensagem, encaminha para a p�gina sala.php e coloca com par�metro o nome da sala
	echo"<script language='javascript' type='text/javascript'>
				alert('Sala cadastrada com sucesso!');";
	echo "javascript:window.location='sala.php?nome=".$nome_sala."';</script>";

//se a inser��o n�o tiver ocorrido
} else {
	//emite a mensagem e encaminha para a p�gina inicial_professor.php
	echo"<script language='javascript' type='text/javascript'>
		          alert('N�o foi poss�vel cadastrar essa sala');window.location
		          .href='inicial_professor.php'</script>";
}

?>