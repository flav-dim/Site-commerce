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
    <title>Login</title>
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

$form = new form($_POST);

if(!empty($_GET['valid'])){
  echo "Invalid email/password <br>";
}
?>
<form action ="verif_connexion.php" method ="POST" />
<?php
echo $form->input_text('email');
echo $form->input_password('password');
echo $form->submit();
?>
<?php
// session_start();
// if(isset($_POST['name_checkbox'])){
//   setcookie("stay", $_SESSION['name']);
// }
?>

<p>Not yet member ? <a href="inscription.php">Click here</a> !</p>

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
