<?php
require_once('functions.php');

$nombre   = "";
$apellido = "";
$mail     = "";
$username = "";
$errores  = [];

if ($_POST) {

  $errores = validarInformacion($_POST);

  if (count($errores) == 0) {
    $errores = guardarImagen("imgPerfil", $errores);
  if (count($errores) == 0) {
      $usuario = crearUsuario($_POST);
      guardarUsuario($usuario);
      header("Location:exito.php");exit;
    }
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
 <meta http-equiv="content-type" content="text/html;charset=utf-8" />
 <meta name="viewport" content="width=device-width,initial-scale=1">

  <title>Asociate</title>

  <head>
  <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
  <link rel="stylesheet" href="../styles/style.css" data-minify="1" />

  <script src="../js/query.js"></script>
  <script src="../js/utils.js"></script>

  </head>
  <body>

<nav class="navbar navbar-default navbar-fixed-top">
<div class="container">
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar-collapse" aria-expanded="false"> <span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
<a class="navbar-brand" href="index.php"> <img src="../images/logo-foodtruckers.png" alt="Foodtruckers" class="logo" /></a>
  </div>
  <div id="bs-navbar-collapse" class="collapse navbar-collapse">
  <ul class="nav navbar-nav navbar-right">
  <li><a href="index.php">Inicio</a></li>
  <li><a href="index.php">Nosotros</a></li>
  <li><a href="index.php">Eventos</a></li>
  <li><a href="index.php">Foodtruckers</a></li>
  <li><a href="index.php">Proovedores</a></li>
  <li><a href="contacto.php">Contacto</a></li>
  <li><a href="login/login.php">&vert; Login &vert;</a></li>
  <li class="hidden-sm hidden-xs btn button_primary button_contact menu-item menu-item-type-post_type menu-item-object-page menu-item-125"><a href="registracion/registracion.php">Asociate</a></li>
              </ul>
          </div>
      </div>
  </nav>


  <header class="header-small" data-parallax="scroll" data-image-src="../images/foodtruckers-contacto.jpg">
      <div id="slogan">
          <p class="soustitre">Foodtruckers</p>
        <h1>Unete a nosotros</h1></div>
      <div id="gradient2">&nbsp;</div>
  </header>
     <div class="main-container">

       <!-- <div class="log-errors">
         <ul>
           <?php foreach($errores as $error): ?>
             <li><?=$error?></li>
           <?php endforeach; ?>
         </ul>
       </div> -->
       <br><br>
       <form class="form-reg" action="registracion.php" method="post" enctype="multipart/form-data">
         <section>
           <article class="art.reg">
              <label for="nombre">Nombre</label><br>
              <input type="text" name="nombre" value="<?=$nombre?>">
              <?php if (isset($errores["nombre"])) { ?>
              <br>
              <span style="color:red"><?=$errores["nombre"];?></span>
              <?php } ?><br><br>
           </article>
              <label for="apellido">Apellido</label><br>
              <input type="text" name="apellido" value="<?=$apellido?>">
              <?php if (isset($errores["apellido"])) { ?>
              <br>
              <span style="color:red"><?=$errores["apellido"];?></span>
              <?php } ?><br><br>

          <!-- PONER UNO CON FECHA DE NACIMIENTO -->

           <article class="art.reg">
              <label for="mail">E-mail</label><br>
              <input type="mail" name="mail" value="<?=$mail?>">
              <?php if (isset($errores["mail"])) { ?>
              <br>
              <span style="color:red"><?=$errores["mail"];?></span>
              <?php } ?><br><br>
           </article>
           <article class="art.reg">
              <label for="username">Nombre de Usuario</label><br>
              <input type="text" name="username" value="<?=$username?>">
              <?php if (isset($errores["username"])) { ?>
              <br>
              <span style="color:red"><?=$errores["username"];?></span>
              <?php } ?><br><br>
           </article>
           <article class="art.reg">
              <label for="password">Contraseña</label><br>
              <input type="password" name="password" value="">
              <?php if (isset($errores["password"])) { ?>
              <br>
              <span style="color:red"><?=$errores["password"];?></span>
              <?php } ?><br><br>
           </article>
           <article class="art.reg">
              <label for="pass-repeat">Confirmar contraseña</label><br>
              <input type="password" name="passRepeat" value="">
              <?php if (isset($errores["passRepeat"])) { ?>
              <br>
              <span style="color:red"><?=$errores["passRepeat"];?></span>
              <?php } ?><br><br>
           </article>
           <article class="art.reg">
              <label for="">Imagen de perfil</label><br>
              <input type="file" name="imgPerfil" value=""><br><br>
           </article>
           <article class="art.reg">
              <input type="submit" name="submit" value="Enviar">
           </article>
         </section>
         <br>
         <br>
         <br>
         <br>
         <br>
       </form>

     </div>
     <footer class="negativeMargin">
         <div class="container">
             <div class="row">
                 <div class="col-md-6"> <img src="../images/logo-foodtruckers-footer.png" alt="Foodtruckers" class="logo" />
                     <div class="textwidget">
                         <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse at finibus dui, ut luctus mi. Aenean bibendum odio semper turpis malesuada, sed laoreet urna rhoncus.</p>
                     </div>
                     <div class="row" id="sitemap">
                         <div class="col-md-4">
     <h4>Nosotros</h4>
     <div class="menu-activites-container">
     <ul class="list-unstyled">
     <li class="menu-item"><a href="#">Empresa</a></li>
     <li><a href="preguntas-frecuentes.php">Preguntas frecuentes</a></li>
     <li><a href="contacto.php">Contacto</a></li>
                                 </ul>
                             </div>
                         </div>
                         <div class="col-md-4">
     <h4>Legal</h4>
     <div class="menu-emersion-container">
     <ul class="list-unstyled">
     <li><a href="#">Informacion legal</a></li>
     <li><a href="#">Términos y condiciones </a></li>


                                 </ul>
                             </div>
                         </div>
       <div class="col-md-4">
       <h4>Redes Sociales</h4>
       <div class="menu-contact-container">
       <ul id="menu-contact" class="list-unstyled">
       <li><a href="https://www.facebook.com/Foodtruckers/">Facebook</a></li>
       <li><a href="https://www.twitter.com/Foodtruckers/">Twitter</a></li>
       <li><a href="https://www.instagram.com/Foodtruckers">Instagram</a></li>
                                 </ul>
                             </div>
                         </div>
                     </div>
                 </div>
               </div>
         </div>
     </footer>

   </body>
 </html>
