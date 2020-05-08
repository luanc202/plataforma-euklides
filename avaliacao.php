<?php
//cria a conexão
$connect = mysqli_connect('localhost','root','admin');
//seleciona o banco de dados euklides
$db = mysqli_select_db($connect,'euklides');

if(isset($_COOKIE['avaliacao_cod_jogo']) && isset($_POST['respostas_avaliacao'])){
	$cod_jogo = $_COOKIE['avaliacao_cod_jogo'];
	$cod_aluno = $_COOKIE['avaliacao_cod_aluno'];
	//exclui os cookies
	unset($_COOKIE['avaliacao_cod_jogo']);
	unset($_COOKIE['avaliacao_cod_aluno']);
	
	$salvar = $_POST['salvar'];
	
	if (isset($salvar)){
		//para cada uma das respostas
		foreach($_POST['respostas_avaliacao'] as $selected) {
			
			$array = explode(',',$selected);
			$resposta = intval($array[0]);
			$pergunta = intval($array[1]);
			
			$query_avaliacao = "INSERT INTO avaliacao (num_pergunta,num_resposta,aluno_id,jogo_id) VALUES 
			($pergunta,$resposta,$cod_aluno,$cod_jogo)";
			$insert = mysqli_query($connect,$query_avaliacao);
			
		}
		if($insert){
			echo"<script language='javascript' type='text/javascript'>
		          alert('Avaliacao cadastrada!');window.location.
		          href='inicial_aluno.php'</script>";
		}else{
			//se tiver sido uma falha, aparecer a mensagem o usu�rio ser� encaminhado para o cadastro novamente
			echo"<script language='javascript' type='text/javascript'>
		          alert('Não foi possível cadastrar esse aluno');window.location
		          .href='inicial_aluno.php'</script>";
		}
	}
}

?>