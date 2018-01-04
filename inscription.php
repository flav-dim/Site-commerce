<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="materialize.css"  media="screen,projection"/>
  <link rel="icon" type="image/png" href="favicon.ico" />
  <link rel="stylesheet" type="text/css" href="biere.css">

  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Inscription</title>
</head>

<body>
  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>


  <nav>
    <div class="nav-wrapper center">
      <a  class="brand-logo center"><img class="responsive-img center" src="logo-bonne-binouze.png"></a>
    </div>
  </nav>

  <header>
  </br>
  <div class="bouton-login">
    <a href="login.php" class="waves-effect waves-light btn">Identification</a>
    <a href="inscription.php" class="waves-effect waves-light btn">Registration</a>
  </div>

</header>

<main>
<?php
require 'class.php';
include_once "verif.php";

if(isset($_POST["Submit"]))
{
  $verif = verif();
  if($_POST["name"] != NULL && $verif[0] != "TRUE"){
    echo $verif[0]. "<br />";
  }
  if($_POST["email"] != NULL && $verif[1] != "TRUE"){
    echo $verif[1]. "<br />";
  }
  if($_POST["password"] != NULL && $verif[2] != "TRUE"){
    echo $verif[2]. "<br />";
  }
}

$form = new form($_POST);
?>
<form action="inscription.php" method="post"/>
<?php
echo $form->input_text('name');
echo $form->input_text('email');
echo $form->input_password('password');
echo $form->input_password('password_confirm');
echo $form->Submit();
if(isset($_POST["Submit"]))
{
  if($verif[0] == "TRUE" && $verif[1] == "TRUE" && $verif[2] =="TRUE"){
    echo "User created.";
    header("Location: index.php");
  }
}?>
<p>Already member ? <a href="login.php">Click here</a> !</p>

</main>
</body>
<footer class="page-footer">
  <div class="container">
    <div class="row">
      <h5 class="white-text">Paye ta bière !</h5>
    </div>
  </div>
  <div class="footer-copyright">
    <div class="container">
      © 2017 Copyright Text / Alex and Flavien
    </div>
  </div>
</footer>
</html>
