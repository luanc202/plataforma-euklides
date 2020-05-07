<?php
include 'header.php';
//cria a conexão
$connect = mysqli_connect('localhost','root','admin');
//seleciona o banco de dados euklides
$db = mysqli_select_db($connect,'euklides');

$nome_jogo = "";

if(isset($_GET['cod_jogo'])){
	$cod_jogo = $_GET['cod_jogo'];
	$cod_aluno = $_GET['cod_aluno'];
	
	//seleciona o nome do jogo
	$query_select_jogo = "SELECT * FROM jogo j WHERE j.cod_jogo = $cod_jogo";
	//$select_jogo recebe o resultado da execução da query
	$select_jogo = mysqli_query($connect,$query_select_jogo);
	//$array_jogo recebe todos os dados recebidos
	$array_jogo = mysqli_fetch_array($select_jogo);
	//$nome_jogo recebe o nome da sala do aluno
	$nome_jogo = $array_jogo['nome'];
	
	$json_str = '{"perguntas": '.
			'[{"id":1, "texto":"Teste 1"},'.
			'{"id":2, "texto":"Teste 2"}'.
			']}';

// 	$json_file = file_get_contents("data_perguntas/perguntas.json");
// 	$json_str = json_decode($json_file, true);
// 	$perguntas = $json_str->perguntas;

	$jsonObj = json_decode($json_str);
	$perguntas = $jsonObj->perguntas;
	
}

// value do checkbox deve receber letra+numero da pergunta. ex: a2 - letra a da pergunta 2
?>

<html>
<head>
  <title>Avaliação</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="css/avaliacao.css">
</head>
<body>
	<div class="div_dash">
		<h1>Avaliação <?php echo $nome_jogo;?></h1>
		
		<?php foreach ( $perguntas as $p ) {?>
		<div class="div_pergunta">
			<p class="p_pergunta"><?php echo $p->id?> - <?php echo $p->texto?></p>
			<br /><input class="labels" type="checkbox" id="1" name="check_list[]" 
							value="1">
			<label for="1"> Discordo totalmente</label><br />
			<br /><input class="labels" type="checkbox" id="2" name="check_list[]" 
							value="1">
			<label for="2"> Discordo</label><br />
			<br /><input class="labels" type="checkbox" id="3" name="check_list[]" 
							value="1">
			<label for="3"> Nem discordo, nem concordo</label><br />
			<br /><input class="labels" type="checkbox" id="4" name="check_list[]" 
							value="1">
			<label for="4"> Concordo</label><br />
			<br /><input class="labels" type="checkbox" id="5" name="check_list[]" 
							value="1">
			<label for="5"> Concordo totalmente</label><br />
		</div>
		<?php }?>
		
	</div>
	
</body>
</html>