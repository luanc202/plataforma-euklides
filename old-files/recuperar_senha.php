<?php
if( !empty($_POST) ){
	// processar o pedido
	$connect = mysqli_connect('localhost','root','admin');
	$db = mysqli_select_db($connect,'euklides');
	
	$user = $_POST['email'];
	$q = mysqli_query($connect,"SELECT * FROM usuarios WHERE login = '$user'");
	
	if( mysqli_num_rows($q) == 1 ){
		// o utilizador existe, vamos gerar um link �nico e envi�-lo para o e-mail
		
		// gerar a chave
		// exemplo adaptado de http://snipplr.com/view/20236/
		$chave = sha1(uniqid( mt_rand(), true));
		
		// guardar este par de valores na tabela para confirmar mais tarde
		$conf = mysqli_query($connect,"INSERT INTO recuperacao VALUES ('$user', '$chave')");
		echo "INSERT INTO recuperacao VALUES ('$user', '$chave')";
		
		if( mysqli_affected_rows($connect) == 1 ){
			
			$link = "http://localhost/euklides/recuperar.php?utilizador=$user&confirmacao=$chave";
			
			if( mail($user, 'Recupera��o de password', 'Ol� '.$user.', visite este link '.$link) ){
				echo '<p>Foi enviado um e-mail para o seu endere�o, onde poder� encontrar um link �nico para alterar a sua password</p>';
				
			} else {
				echo '<p>Houve um erro ao enviar o email (o servidor suporta a fun��o mail?)</p>';
				
			}
			
			// Apenas para testar o link, no caso do e-mail falhar
			echo '<p>Link: '.$link.' (apresentado apenas para testes; nunca expor a p�blico!)</p>';
			
		} else {
			echo '<p>N�o foi poss�vel gerar o endere�o �nico</p>';
			
		}
	} else {
		echo '<p>Esse utilizador n�o existe</p>';
	}
} else {
	// mostrar formul�rio de recupera��o
	?>
<form method="post">
  <label for="email">E-mail:</label>
  <input type="text" name="email" id="email" />
  <input type="submit" value="Recuperar" />
</form>
<?php
  }
?>