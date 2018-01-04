<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="materialize.css"  media="screen,projection"/>
  <link rel="stylesheet" type="text/css" href="biere.css">
    <link rel="icon" type="image/png" href="favicon.ico" />

  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Administration</title>
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
  </header>

  <main>
    <?php
    session_start();?>
    <p class = "center" ><?php echo "Hello " . $_SESSION['name']."<br />";?></p>
    <a href ='admin_product.php'><i class="medium material-icons">add_shopping_cart</i>Add product</a><br>
    <a href="admin_user.php"><i class="medium material-icons">person_add</i>Add user</a> <br />
    <a href ='admin_category.php'><i class="medium material-icons">create_new_folder</i>Add category</a><br>
    <a href ='index.php'><i class="medium material-icons">home</i>return home</a><br>
    <a href="logout.php"><i class="medium material-icons">exit_to_app</i>Click to logout</a>

    <footer class="page-footer">
      <div class="container">
        <div class="row">
          <h5 class="white-text">Admin bonnebinouze.com</h5>
        </div>
      </div>
      <div class="footer-copyright">
        <div class="container">
          © 2017 Copyright Text / Alex et Flavien
        </div>
      </div>
    </footer>
    </html>
