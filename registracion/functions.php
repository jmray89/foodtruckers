<?php
session_start();

 function validarInformacion($datosUsuario){

  $errores = [];

  $nombre = trim($datosUsuario["nombre"]);

   if (strlen($_POST["nombre"]) == 0) {
     $errores["nombre"] = "No llenaste tu nombre.";
   }
   elseif (strlen($_POST["nombre"]) == 1){
     $errores["nombre"] = "Tu nombre no puede estar compuesto por solo una letra.";
   }

  $apellido = trim($datosUsuario["apellido"]);

   if (strlen($_POST["apellido"]) == 0) {
     $errores["apellido"] = "No llenaste tu apellido.";
   }
   elseif (strlen($_POST["apellido"]) == 1){
     $errores["apellido"] = "Tu apellido no puede estar compuesto por solo una letra.";
   }

  $email = trim($datosUsuario["mail"]);

   if (strlen($_POST["mail"]) == 0) {
     $errores["mail"] = "No llenaste tu mail.";
   }
   elseif (!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)) {
     $errores["mail"] = "El mail que llenaste no es válido.";
   }

  $usuario = trim($datosUsuario["username"]);

   if (strlen($_POST["username"]) === 0) {
     $errores["username"] = "No llenaste tu usuario.";
   }
   elseif (strlen($_POST["username"]) < 8) {
     $errores["username"] = "Tu nombre de usuario debe tener como mínimo 8 caracteres.";
   }

  //  Contraseña //

   if (strlen($_POST["password"]) === 0) {
     $errores["password"] = "No llenaste tu contraseña.";
   }
   elseif (strlen($_POST["password"]) < 8) {
     $errores["password"] = "Tu contraseña debe tener como mínimo 8 caracteres.";
   }

  //  Confirmar contraseña //

  if (strlen($_POST["passRepeat"]) === 0) {
    $errores["passRepeat"] = "No llenaste tu contraseña.";
  }
  elseif (strlen($_POST["passRepeat"]) < 8) {
    $errores["passRepeat"] = "Tu contraseña debe tener como mínimo 8 caracteres.";
  }

  // Coincidir contraseñas //

   if ($_POST["password"] != $_POST["passRepeat"]) {
     $errores["passRepeat"] = "Tus contraseñas no coinciden.";
   }

   if ($_POST["password"] != $_POST["passRepeat"] && $_POST["passRepeat"] != $_POST["password"]){
     $errores["password"] = "Las dos contraseñas deben ser iguales.";
   }

   $img = $_FILES["imgPerfil"];

       if ($img["name"] == "") {
         $errores["img"] = "No elegiste un archivo.";
       }

   return $errores;
 }

// Guardar una foto //

 function guardarImagen($unaImagen, $errores) {

   if ($_FILES[$unaImagen]["error"] == UPLOAD_ERR_OK)
   {

     $nombre = $_FILES[$unaImagen]["name"];
     $archivo = $_FILES[$unaImagen]["tmp_name"];

     $ext = pathinfo($nombre, PATHINFO_EXTENSION);

     if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {
       $miArchivo = dirname(__FILE__);
       $miArchivo = $miArchivo . "/subidos/";
       $miArchivo = $miArchivo . $_POST["username"] . "." . $ext;
       move_uploaded_file($archivo, $miArchivo);
     }
     else {
       $errores["imgPerfil"] = "Este archivo no es una foto.";
     }
   } else {
     //Acá hay error
     $errores["imgPerfil"] = "No se pudo subir la foto.";
   }
   return $errores;
 }

 // Crear un usuario //

 function crearUsuario($datosUsuario) {
   $usuario = [
     "nombre"   => $datosUsuario["nombre"],
     "apellido" => $datosUsuario["apellido"],
     "mail"     => $datosUsuario["mail"],
     "username" => $datosUsuario["username"],
     "password" => password_hash($datosUsuario["password"], PASSWORD_DEFAULT)
   ];

   $usuario["id"] = traerNuevoId();

   return $usuario;
 }

 // Guardar un usuario //

 function guardarUsuario($datosUsuario) {
   $json = json_encode($datosUsuario);

   $json = $json . PHP_EOL;

   file_put_contents("usuarios.json", $json, FILE_APPEND);
 }

 // Traigo todos (con el usuario final saco su id) //

 function traerTodos() {
   // Leo el archivo
   $archivo = file_get_contents("usuarios.json");

  //  Lo divido por enters
  $usuariosJSON = explode(PHP_EOL, $archivo);
  // Quito el enter del final
  array_pop($usuariosJSON);

  $usuariosFinal = [];

  // A cada linea la convierto de Json a Array
  foreach ($usuariosJSON as $json) {
    $usuariosFinal[] = json_decode($json, true);
  }

  return $usuariosFinal;
}
  // Traigo un nuevo Id (este se agrega al agregar un nuevo usuario)

  function traerNuevoId() {
    $usuarios = traerTodos();

    if (count($usuarios) == 0) {
      return 1;
    }
    $elUltimo = array_pop($usuarios);

    $id = $elUltimo["id"];

    return $id + 1;
  }

 ?>
