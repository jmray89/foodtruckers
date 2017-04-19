<?php
session_start();

 function validarInformacion($datosUsuario){

   $errores = [];

   if (strlen($_POST["nombre"]) == 0) {
     $errores["nombre"] = "No llenaste tu nombre.";
   }elseif (strlen($_POST["nombre"]) == 1){
     $errores["nombre"] = "Tu nombre no puede estar compuesto por solo una letra.";
   }
   if (strlen($_POST["mail"]) == 0) {
     $errores["mail"] = "No llenaste tu mail.";
   }elseif (!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)) {
     $errores["mail"] = "El mail que llenaste no es válido.";
   }
   if (strlen($_POST["username"]) < 8) {
     $errores["username"] = "Tu nombre de usuario debe tener como mínimo 8 caracteres.";
   }
   if (strlen($_POST["password"]) < 8) {
     $errores["password"] = "Tu contraseña debe tener como mínimo 8 caracteres.";
   }
   if ($_POST["password"] != $_POST["passRepeat"]) {
     $errores["passRepeat"] = "Tus contraseñas no coinciden.";
   }

   return $errores;
 }




 ?>
