<?php
if (isset($_GET['nome'])){
	$nome_sala = $_GET['nome'];
	$link = "http://localhost/euklides/cadastro_view.php?nome=$nome_sala";
	echo '<p>Link para cadastro dos alunos: '.$link.'</p>';
}

?>