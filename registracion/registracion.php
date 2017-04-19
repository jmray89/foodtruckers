<?php
require_once('functions.php');

$nombre ="";
$apellido ="";
$mail ="";
$username ="";
$errores = [];

if ($_POST) {

  $errores = validarInformacion($_POST);


  if (count($errores) == 0) {
    header("Location:exito.php");exit;
  }

    if (!isset($errores["nombre"])) {
      $nombre = $_POST["nombre"];
    }
    if (!isset($errores["apellido"])) {
      $apellido = $_POST["apellido"];
    }
    if (!isset($errores["mail"])) {
      $mail = $_POST["mail"];
    }
    if (!isset($errores["username"])) {
      $username = $_POST["username"];
    }
}
 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>Form de registro</title>
     <link rel="stylesheet" href="styles.css">
   </head>
   <body>
     <div class="main-container">

       <div class="log-errors">
         <ul>
           <?php foreach($errores as $error): ?>
             <li><?=$error?></li>
           <?php endforeach; ?>
         </ul>

       </div>
       <form class="form-reg" action="registracion.php" method="post">

         <label for="nombre">Nombre</label><br>
         <input type="text" name="nombre" value="<?=$nombre?>"><br><br>

         <label for="apellido">Apellido</label><br>
         <input type="text" name="apellido" value="<?=$apellido?>"><br><br>

         <label for="mail">E-mail</label><br>
         <input type="mail" name="mail" value="<?=$mail?>"><br><br>

         <label for="username">Nombre de Usuario</label><br>
         <input type="text" name="username" value="<?=$username?>"><br><br>

         <label for="password">Contraseña</label><br>
         <input type="password" name="password" value=""><br><br>

         <label for="pass-repeat">Confirmar contraseña</label><br>
         <input type="password" name="passRepeat" value=""><br><br>

         <input type="submit" name="submit" value="Enviar">


       </form>

     </div>

   </body>
 </html>
