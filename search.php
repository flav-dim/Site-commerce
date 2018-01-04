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
  <title>Accueil</title>
</head>

<body>
  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>


  <nav>
    <div class="nav-wrapper center">
      <a  class="brand-logo center"><img class="responsive-img center" src="logo-bonne-binouze.png" href="index.php"></a>
    </div>
  </nav>

  <header>
  </header>
  <main>
    <?php
    include 'class_admin.php';
    include 'class.php';
    if(isset($_GET['name']))
    {
      $request = $_SESSION['name'];
      $search = new ProductManager("localhost","root", "root", "pool_php_rush");
      $result = $search->search_product_name($request);
      ?>
      <table>
        <tr>
          <th>Name</th>
          <th>Price</th>
          <th>Category id</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php while($row = $result->fetch()) :  ?>
            <td><?php echo $row['name']  ?> </td>
            <td><?php echo $row['price']  ?> </td>
            <td><?php echo $row['category_id']  ?> </td>
            <td><img src="<?php echo $row['img']?>"></td>
          </tr>
        <?php endwhile ?>
      </tbody>
    </table>
  </main>
  </body>

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
