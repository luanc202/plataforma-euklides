<?php
//caso o professor tenha criado uma nova sala, a variável $nome_sala irá receber o nome digitado
$nome_sala = $_POST['nome_sala'];
//recebe o cookie referente ao email enviado pela página login.php
$email = $_COOKIE['email'];
//exclui o cookie recebido
unset($_COOKIE['email']);

//cria a conexão
$connect = mysqli_connect('localhost','root','admin');
//seleciona o banco de dados euklides
$db = mysqli_select_db($connect,'euklides');

//criada a query descobrir o id do professor com o email digitado
$query_select_professor = "SELECT id FROM professor WHERE email = '$email'";
//a variável $select_professor recebe o resultado da execução dessa query
$select_professor = mysqli_query($connect,$query_select_professor);
//o array $array_professor recebe todos os valores da busca
$array_professor = mysqli_fetch_array($select_professor);
//a variável $id_professor recebe o id do professor
$id_professor = $array_professor['id'];

//cria a query para criar uma nova sala
$query = "INSERT INTO sala (nome,professor_id) VALUES ('$nome_sala',$id_professor)";
//a variável $insert recebe o resultado da inserção
$insert = mysqli_query($connect,$query);

//se a inserção tiver ocorrido
if($insert){
	//emite a mensagem, encaminha para a página sala.php e coloca com parâmetro o nome da sala
	echo"<script language='javascript' type='text/javascript'>
				alert('Sala cadastrada com sucesso!');";
	echo "javascript:window.location='sala.php?nome=".$nome_sala."';</script>";

//se a inserção não tiver ocorrido
} else {
	//emite a mensagem e encaminha para a página inicial_professor.php
	echo"<script language='javascript' type='text/javascript'>
		          alert('Não foi possível cadastrar essa sala');window.location
		          .href='inicial_professor.php'</script>";
}

?>