<?php
	
	include('cabecalho.php');
	$row=null;
	$result=null;
	if (($_GET["id"]!=null)){
		$sql    = "SELECT * FROM usuarios where (id=".$_GET["id"].")";
		$result=mysql_query($sql, $link);
		$row = mysql_fetch_assoc($result);	
	}
?>
<form method="post" >
	<table border="1">
		<tr>
			<td>id:<input type="text" name="id" value="<?php if ($result!=null) echo $row["id"]?>"></td>
		</tr>
		<tr>
			<td>nome:<input type="text" name="nome" value="<?php if ($result!=null)  echo $row["nome"]?>"></td>
		</tr>
		<tr>
			<td>email:<input type="text" name="email" value="<?php if ($result!=null)   echo $row["email"]?>"></td>  
		</tr>
		<tr>	
			<td>login:<input type="text" name="login" value="<?php if ($result!=null)  echo $row["login"]?>"></td>
		</tr>
		<tr>	
			<td>senha:<input type="text" name="senha" value="<?php if ($result!=null)  echo $row["senha"]?>"></td>
		</tr>
		<tr>
			<td >
				<input type="submit" name="acao" value="inserir">
				<input type="submit" name="acao" value="alterar">
				<input type="submit" name="acao" value="excluir">	
				<input type="button"  value="limpar" onclick="self.location.href='?id='">
			</td>		
		</tr>		
		<?php
			
			if( $_POST['acao']=='excluir'){				
				$sql    = 'delete  FROM usuarios where id='.$_POST["id"];
				//echo $sql;
				mysql_query($sql, $link);				
			}
			else if( $_POST['acao']=='alterar'){
				$sql    = "update usuarios set nome='".$_POST["nome"]."',login='".$_POST["login"]."',email='".$_POST["email"]."',senha='".$_POST["senha"]."' where (id=".$_POST["id"].");";
				//echo $sql;
				mysql_query($sql, $link);							
			}
			else if( $_POST['acao']=='inserir'){
				$sql    = "insert into usuarios (nome,login,email,senha) values ('".$_POST["nome"]."','".$_POST["login"]."','".$_POST["email"]."','".$_POST["senha"]."');";
				//echo $sql;
				mysql_query($sql, $link);
			}			
		?>
		<table border="1">
		<tr>
			<td>id</td>
			<td>nome</td>
			<td>email</td>    
			<td>login</td>
			<td>senha</td>
		</tr>
		<?php			
			/*if( $_POST['acao']=='buscar')*/
			if ($result!=null){
				mysql_free_result($result);
			}		
			$sql    = 'SELECT * FROM usuarios order by nome asc;';
			$result = mysql_query($sql, $link);
			if (!$result) {
				echo "Erro do banco de dados, n�o foi poss�vel consultar o banco de dados\n";
				echo 'Erro MySQL: ' . mysql_error();
				exit;
			}
			while ($row = mysql_fetch_assoc($result)) {
		?> 
				<tr>
					<td><a href="?id=<?php echo $row['id'];?>"><?php echo $row['id'];?></a></td>
					<td><?php echo $row['nome'];?>&nbsp </td>
					<td><?php echo $row['email'];?>&nbsp </td>
					<td><?php echo $row['login'];?>&nbsp </td>                
					<td><?php echo $row['senha'];?>&nbsp </td>
				</tr>
		<?php 				
			}
			mysql_free_result($result);
		?>
		</table>
	
	</table>
</form>
<?php	
	include('rodape.php');
?>

					