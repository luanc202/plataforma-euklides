<?php
//verifica se há o parâmetro nome na url
if (isset($_GET['nome'])){
	//se sim, a variável $nome_sala e $id_professor recebem os respectivos valores
	$nome_sala = $_GET['nome'];
	$id_professor = $_GET['cod_prof'];
	//é criado o link para a tela cadastro_view e adicionado como parâmetro o nome da sala 
	//dessa forma, os alunos podem se cadastrar direto na sala
	$link = "http://localhost/euklides/plataforma-euklides/cadastro_view.php?nome=$nome_sala&cod_prof=$id_professor";
	//emite a mensagem com o link
	echo '<p>Link para cadastro dos alunos: '.$link.'</p>';
}

?>