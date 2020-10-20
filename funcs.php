<?php

function limpiarDatos($dato)
{
	$dato = trim($dato);
	$dato = htmlspecialchars($dato);
	$dato = stripcslashes($dato);
	$dato = filter_var($dato, FILTER_SANITIZE_STRING);
	$dato = filter_var($dato, FILTER_SANITIZE_EMAIL);
	return $dato;
}

function isNull($nombre, $telefono, $pass, $pass_con, $email)
{
	if (strlen(trim($nombre)) < 1 || strlen(trim($telefono)) < 1 || strlen(trim($pass)) < 1 || strlen(trim($pass_con)) < 1 || strlen(trim($email)) < 1) {
		return true;
	} else {
		return false;
	}
}

function isNumero($telefono)
{
	if (is_numeric($telefono)) {
		return true;
	} else {
		return false;
	}
}

function isLetra($entrada)
{
	if (ctype_alpha($entrada)) {
		return true;
	} else {
		return false;
	}
}

function isEmail($email)
{
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		return true;
	} else {
		return false;
	}
}

function validaPassword($var1, $var2)
{
	if (strcmp($var1, $var2) !== 0) {
		return false;
	} else {
		return true;
	}
}

function hashPassword($password) 
{
	$hash = password_hash($password, PASSWORD_DEFAULT);
	return $hash;
}

function minMax($min, $max, $valor)
{
	if (strlen(trim($valor)) < $min) {
		return true;
	} else if (strlen(trim($valor)) > $max) {
		return true;
	} else {
		return false;
	}
}


function emailExiste($email)
{
	global $conexion;

	$stmt = $conexion->prepare("SELECT USU_ID FROM usuarios WHERE USU_MAIL = ? LIMIT 1");
	$stmt->bind_param("s", $email);
	$stmt->execute();
	$stmt->store_result();
	$num = $stmt->num_rows;
	$stmt->close();

	if ($num > 0) {
		return true;
	} else {
		return false;
	}
}


function resultBlock($errors)
{
	if (count($errors) > 0) {
		echo "<div class='errors'>
			<a href='#'>ERRORES</a>
			<ul>";
		foreach ($errors as $error) {
			echo "<li>" . $error . "</li>";
		}
		echo "</ul>";
		echo "</div>";
	}
}

function registraUsuario($nombre, $apellido, $email, $pass_hash, $telefono, $estado, $tipo_rol)
{
	global $conexion;

	$sql = "INSERT INTO usuarios (usu_nombre, usu_apellido, usu_mail, usu_clave, usu_tel, usu_estado, rol_id) VALUES ('$nombre','$apellido','$email','$pass_hash', '$telefono', '$estado', '$tipo_rol')";
	$resultado = mysqli_query($conexion, $sql);

	if ($resultado > 0) {
		return $conexion->insert_id;
	} else {
		echo 'ERROR de registro ' . $conexion->error;
		return 0;
	}
}

function enviarEmail2($email, $nombre, $asunto, $cuerpo)
{

	if (mail($email, $asunto, $cuerpo))
		return true;
	else
		return false;
}


function validaId($id)
{
	global $conexion;

	$stmt = $conexion->prepare("SELECT USU_ESTADO FROM usuarios WHERE USU_ID = ? LIMIT 1");
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$stmt->store_result();
	$rows = $stmt->num_rows;

	if ($rows > 0) {
		$stmt->bind_result($estado);
		$stmt->fetch();

		if ($estado == 1) {
			$msg = "La cuenta ya se activo anteriormente.";
		} else {
			if (activarUsuario($id)) {
				$msg = 'Cuenta activada.';
			} else {
				$msg = 'Error al Activar Cuenta';
			}
		}
	} else {
		$msg = 'No existe el registro para activar.';
	}
	return $msg;
}
function activarUsuario($id)
{
	global $conexion;

	$stmt = $conexion->prepare("UPDATE usuarios SET USU_ESTADO=1 WHERE USU_ID = ?");
	$stmt->bind_param('s', $id);
	$result = $stmt->execute();
	$stmt->close();
	return $result;
}

function isNullLogin($usuario, $password)
{
	if (strlen(trim($usuario)) < 1 || strlen(trim($password)) < 1) {
		return true;
	} else {
		return false;
	}
}

function login($usuario, $password)
{
	global $conexion;

	$stmt = $conexion->prepare("SELECT id, id_tipo, password FROM usuarios WHERE usuario = ? || correo = ? LIMIT 1");
	$stmt->bind_param("ss", $usuario, $usuario);
	$stmt->execute();
	$stmt->store_result();
	$rows = $stmt->num_rows;

	if ($rows > 0) {

		if (isActivo($usuario)) {

			$stmt->bind_result($id, $id_tipo, $passwd);
			$stmt->fetch();

			$validaPassw = password_verify($password, $passwd);

			if ($validaPassw) {

				lastSession($id);
				$_SESSION['id_usuario'] = $id;
				$_SESSION['tipo_usuario'] = $id_tipo;

				header("location: welcome.php");
			} else {

				$errors = "La contrase&ntilde;a es incorrecta";
			}
		} else {
			$errors = 'El usuario no esta activo';
		}
	} else {
		$errors = "El nombre de usuario o correo electr&oacute;nico no existe";
	}
	return $errors;
}

function isActivo($user)
{
	global $conexion;

	$stmt = $conexion->prepare("SELECT USU_ESTADO FROM usuarios WHERE USU_MAIL = ? LIMIT 1");
	$stmt->bind_param('s', $user);
	$stmt->execute();
	$stmt->bind_result($activacion);
	$stmt->fetch();

	if ($activacion == 1) {
		return true;
	} else {
		return false;
	}
}

function getValor($campo, $campoWhere, $valor)
{
	global $conexion;

	$stmt = $conexion->prepare("SELECT $campo FROM usuarios WHERE $campoWhere = ? LIMIT 1");
	$stmt->bind_param('s', $valor);
	$stmt->execute();
	$stmt->store_result();
	$num = $stmt->num_rows;

	if ($num > 0) {
		$stmt->bind_result($_campo);
		$stmt->fetch();
		return $_campo;
	} else {
		return null;
	}
}

function getPasswordRequest($id)
{
	global $conexion;

	$stmt = $conexion->prepare("SELECT password_request FROM usuarios WHERE id = ?");
	$stmt->bind_param('i', $id);
	$stmt->execute();
	$stmt->bind_result($_id);
	$stmt->fetch();

	if ($_id == 1) {
		return true;
	} else {
		return null;
	}
}

function cambiaPassword($password, $user_id, $token)
{

	global $conexion;

	$stmt = $conexion->prepare("UPDATE usuarios SET password = ?, token_password='', password_request=0 WHERE id = ? AND token_password = ?");
	$stmt->bind_param('sis', $password, $user_id, $token);

	if ($stmt->execute()) {
		return true;
	} else {
		return false;
	}
}






