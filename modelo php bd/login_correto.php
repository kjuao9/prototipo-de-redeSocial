<!DOCTYPE html>
	<?php
		session_start();
		if ( !isset($_SESSION["codigo"]) ){
			header("location:index.php?erro=2");
		}
		$id_usuario = $_SESSION["codigo"];
	?>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<meta name="author" content="Professor"/>
	<meta name="description" content="Descrição"/>
	<meta name="keywords" content="Palavras, chaves"/>
	<title>PHP com BD</title>
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>

	<?php include "includes/menu-login.php" ?>

	<div id="div-area-principal">
		<div id="div-pessoal" class="borda-arredondada">
			<span class="negrito-maior"><?php print$_SESSION["nome"]?></span>
			<br/>
			<span class="italico"><?php print$_SESSION["email"]?></span> <br/><br/>
			<hr/><br/>
				<table>
					<tr>
						<td width="100px" >TWEETS <br/><?php
						include_once "conexao.php";
						 $conexao = conecta_mysql();
						 $sql = "SELECT * From postagem where id_usuario=$id_usuario";
						 $resultado = mysqli_query($conexao,$sql);
						 if($resultado){
							 $mensagens = array();
							 while($linha = mysqli_fetch_assoc($resultado)){
								 $mensagens[] =$linha;
							 }
						 }
						 print count($mensagens);
						 ?>
						 </td>
						<td width="100px">SEGUIDORES <br/> 0</td>
					</tr>
				</table>
		</div>
		<div id="div-postagem" class="borda-arredondada">
			<form method="post" action="">
				<p class="centralizar">
					<textarea id="mensagem" name="mensagem" required maxlength="140" cols="50" rows="4"
					placeholder="<?php print "O que você vai postar hoje?"?>"></textarea>
				</p>
				<input type="submit" value="Postar"/>
				<input type="reset" value="Cancelar"/>
			</form>
			<?php
	if(isset($_POST["mensagem"])){
		$mensagem = $_POST["mensagem"];
			if(strlen($mensagem) > 1){
				include_once "conexao.php";
				$con = conecta_mysql();
					if($con){
	                                                                        
					$sql = "INSERT INTO postagem (texto_postagem, id_usuario)
					values('$mensagem', '$id_usuario')";
					if(mysqli_query($con, $sql)){
						print "<script> alert('Postagem Realizada!') </script>";
					}
					else{
						print "<script> alert('Erro ao postar a mensagem')</script>";
					}
				}
			}
		}


			?>
		</div>
		<div id="div-procurar-pessoa" class="borda-arredondada">
			<br/>
			<a href="procurar_pessoas.php">Procurar pessoas</a>
			<br/><br/>
		</div>
		<div id="postagem" class="clear">
			<?php print"Hoje é ".date("d/M/Y").", horário atual: ".date("H:i");?>
		</div>
	</div> <!-- Div Área principal -->
</body>
</html>
