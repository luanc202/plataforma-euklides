<?php
//verifica se h� o par�metro nome na url
if (isset($_GET['nome'])){
	//se sim, a vari�vel $nome_sala recebe o nome da sala
	$nome_sala = $_GET['nome'];
	//� criado o link para a tela cadastro_view e adicionado como par�metro o nome da sala 
	//dessa forma, os alunos podem se cadastrar direto na sala
	$link = "http://localhost/euklides/plataforma-euklides/cadastro_view.php?nome=$nome_sala";
	//emite a mensagem com o link
	echo '<p>Link para cadastro dos alunos: '.$link.'</p>';
}

?>