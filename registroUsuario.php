<?php  
session_start();


if (empty($_SESSION['active'])) {
    header('location: iniciar.php');

}

include "conexion.php";

if (!empty($_POST)) {
  $alertas = '';
  if (empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['telefono']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['rol'])) {
    $alertas = '<p class = "msg_error"> Todos los campos son obligatorios.</p>';
  }else{

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $user = $_POST['email'];
    $password = md5($_POST['password']);
    $rol = $_POST['rol'];

    $query = mysqli_query($conexion, "select * from usuarios where USU_MAIL = '$user' ");
    //mysqli_close($conexion);
    $resultado = mysqli_fetch_array($query);

    if ($resultado >0) {
      $alertas = '<p class = "msg_error">El correo Ingresado ya esta registrado.</p>';
    }else{
      $query_insert = mysqli_query($conexion, "insert into usuarios (USU_NOMBRE, USU_APELLIDO , USU_TEL, USU_MAIL, USU_CLAVE, ROL_ID)
        values('$nombre', '$apellido', '$telefono', '$user', '$password', '$rol')");
      if ($query_insert) {
        $alertas = '<p class = "msg_save"> Usuario creado exitosamente.</p>';   
      }else{
        $alertas = '<p class = "msg_error"> Error al crear el usuario.</p>'; 
      }

    }
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro Usuario</title>
  <?php require_once 'scripts.php'; ?>
</head>
<body>
  <div class="head2 container-fluid">
    <?php require_once 'headerAdmin.php' ?>
      <section>
        <div class="row">
        <div class="formu col-xs-4 col-sm-7 col-md-5 col-lg-4 col-xl-3 ">
          <form  action="" method="POST">
            <h1 class="delForm1">Registrar Usuario</h1>
              <div class="form-group" id="user-group">
                <input class="form-control" name="nombre" type="text" id="nombre" placeholder="Ingrese Nombre:">
                
              </div>
              <div class="form-group" id="ape-group">
                  <input class="form-control" name="apellido" type="text" id="apellido" placeholder="Ingrese Apellido:">
                  
              </div>
              <div class="form-group" id="cel-group">
                  <input class="form-control" name="telefono" type="number" id="telefono" placeholder="Ingrese Celular:">
                  
              </div>
              <div class="form-group" id="mail-group">
                  <input class="form-control" name="email" type="email" id="email" placeholder="Ingrese email:">
                  
              </div>
              <div class="form-group" id="pass-group">
                  <input class="form-control" type="password" name="password" id="password" placeholder="Ingrese contraseña:">
                  
              </div>
              <div class="form-group" id="rol-group">
                  <?php 
                    $query_rol = mysqli_query($conexion, "select * from roles");
                    //mysqli_close($conexion);
                    $resultado_rol = mysqli_num_rows($query_rol);
                  ?>

                <select name="rol" id="rol" name="rol" class="form-control">
                <?php  
                  if (condition) {
                      while($rol = mysqli_fetch_array($query_rol)){
                  ?>
                    <option value="<?php echo $rol['ROL_ID'] ?>"><?php echo $rol['ROL_DESC'] ?></option>  
                  <?php       
                      } 
                    }     
                ?>    
                
                </select>
               </div>
              <button type="submit" class="bb btn btn-primary" value="Ingresar" id="guardar">Crear Usuario</button>
              </form>
              <div class="alertas"><?php echo isset($alertas) ? $alertas : ''; ?></div>
      </section>
      
  </div>
  <?php require_once 'scriptsBody.php'; ?>
</body>
</html>