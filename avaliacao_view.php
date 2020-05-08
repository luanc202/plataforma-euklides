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
	
	setcookie("avaliacao_cod_jogo",$cod_jogo);
	setcookie("avaliacao_cod_aluno", $cod_aluno);
	
	//seleciona o nome do jogo
	$query_select_jogo = "SELECT * FROM jogo j WHERE j.cod_jogo = $cod_jogo";
	//$select_jogo recebe o resultado da execução da query
	$select_jogo = mysqli_query($connect,$query_select_jogo);
	//$array_jogo recebe todos os dados recebidos
	$array_jogo = mysqli_fetch_array($select_jogo);
	//$nome_jogo recebe o nome da sala do aluno
	$nome_jogo = $array_jogo['nome'];
	
	$url = './data_perguntas/' . $nome_jogo . '/perguntas.json'; // path to your JSON file
	$data = file_get_contents($url); // put the contents of the file into a variable
	$perguntas = json_decode($data); // decode the JSON feed
	
}

// value do checkbox deve receber numero da resposta+numero da pergunta. ex: 120 - resposta 1 da pergunta 20
?>

<html>
<head>
  <title>Avaliação</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="css/avaliacao.css">
</head>
<body>
	<form class="div_dash" method="POST" action="avaliacao.php">
		<h1>Avaliação <?php echo $nome_jogo;?></h1>
		
		<?php foreach ( $perguntas as $p ) {?>
		<div class="div_pergunta">
			<p class="p_pergunta"><?php echo $p->id?> - <?php echo $p->texto?></p>
			<br /><input class="labels" type="checkbox" id="1" name="respostas_avaliacao[]" 
							value="1,<?php echo $p->id?>">
			<label for="1"> Discordo totalmente</label><br />
			<br /><input class="labels" type="checkbox" id="2" name="respostas_avaliacao[]" 
							value="2,<?php echo $p->id?>">
			<label for="2"> Discordo</label><br />
			<br /><input class="labels" type="checkbox" id="3" name="respostas_avaliacao[]" 
							value="3,<?php echo $p->id?>">
			<label for="3"> Nem discordo, nem concordo</label><br />
			<br /><input class="labels" type="checkbox" id="4" name="respostas_avaliacao[]" 
							value="4,<?php echo $p->id?>">
			<label for="4"> Concordo</label><br />
			<br /><input class="labels" type="checkbox" id="5" name="respostas_avaliacao[]" 
							value="5,<?php echo $p->id?>">
			<label for="5"> Concordo totalmente</label><br />
		</div>
		<?php }?>
		
		<input type="submit" value="Salvar" id="salvar" class="salvar" name="salvar"><br>
		
	</form>
	
</body>
</html>

