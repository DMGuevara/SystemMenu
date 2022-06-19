<?php
	include('db.php');
	if(isset($_POST['susername'])){
		$username=$_POST['susername'];
		$password=$_POST['spassword'];

		$query=$con->query("select * from user where username='$username'");

		if ($query->num_rows>0){
			?>
  				<span>El nombre de usuario ya existe.</span>
  			<?php 
		}

		elseif (!preg_match("/^[a-zA-Z0-9_]*$/",$username)){
			?>
  				<span style="font-size:11px;">Nombre de usuario no válido. No se permiten espacios ni caracteres especiales.</span>
  			<?php 
		}
		elseif (!preg_match("/^[a-zA-Z0-9_]*$/",$password)){
			?>
  				<span style="font-size:11px;">Contraseña invalida. Espacio y caracteres especiales no permitidos.</span>
  			<?php 
		}
		else{
			$mpassword=md5($password);
			$con->query("insert into user (username, password) values ('$username', '$mpassword')");
			?>
  				<span>Registro exitoso.</span>
  			<?php 
		}
	}
?>