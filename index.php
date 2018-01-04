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
  <title>Home</title>
</head>

<body>
  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>


  <nav>
    <div class="nav-wrapper center">
      <a class="brand-logo center"><img class="responsive-img center" src="logo-bonne-binouze.png" href="index.php"></a>
    </div>
  </nav>

  <header>
  </header>
  <main>

    <?php
    // requet select si adm = 1 -> lien admin
    session_start();
    include 'class_admin.php';
    include 'class.php';
    $form = new form();?>
    <p class = "center" ><?php echo "Hello " . $_SESSION['name']."<br />";?></p>
    <a href="logout.php"><i class="medium material-icons">exit_to_app</i>Click to logout</a>

    <?php
    $name = $_SESSION['name'];
    $user = new UserManager("localhost","root", "root", "pool_php_rush");
    $re = $user->display_admin($name);
    $a = $re->fetch();
    if($a['admin'] == 1){?>
      <br /><a href="admin.php"><i class="medium material-icons">link</i>Click here to go to admin pages</a>
    <?php } ?>

    <h1>Search Product by name</h1>
    <?php
    if(isset($_POST["search"]))
    {
      $request = $_POST['name'];
      $search = new ProductManager("localhost","root", "root", "pool_php_rush");
      $result_name = $search->search_product_name($request);
      while($row = $result_name->fetch()){ ?>
        <div class="row">
          <div class="col s12 m6 l3">
            <div class="card">
              <div class="card-image">
                <img class="responsive-img" src="<?php echo $row['img']?>">
              </div>
              <div class="card-content">
                <p><?php echo $row['name']?></p>
                <p>I drink the pressure !</p>
                <p><?php  echo $row['price'] ?></p>
              </div>
              <div class="card-action">
                <a href="#">ORDER (not for real....)</a>
              </div>
            </div>
          </div>
        </div>
      <?php }
    }
    ?>
    <form action="index.php".php method="post">
      <?php
      echo $form->input_text('name');
      echo $form->hidden('search');
      ?>

      <h1>Search Product by price</h1>
      <?php
      if(isset($_POST["search_price"]))
      {
        $request_price = $_POST['price'];
        $search_price = new ProductManager("localhost","root", "root", "pool_php_rush");
        $result_price = $search_price->search_product_price($request_price);
        ?>
        <?php while($row = $result_price->fetch()){ ?>
          <div class="row">
            <div class="col s12 m6 l3">
              <div class="card">
                <div class="card-image">
                  <img class="responsive-img" src="<?php echo $row['img']?>">
                </div>
                <div class="card-content">
                  <p><?php echo $row['name']?></p>
                  <p>I drink the pressure !</p>
                  <p><?php  echo $row['price'] ?></p>
                </div>
                <div class="card-action">
                  <a href="#">ORDER (not for real....)</a>
                </div>
              </div>
            </div>
          </div>
        <?php }
      }
      ?>
      <form action="index.php" method="post">
        <?php
        echo $form->input_text('price');
        echo $form->hidden('search_price');
        ?>
      </form>

      <h1>Search Product by category</h1>
      <?php
      if(isset($_POST["search_category"]))
      {
        $request_category = $_POST['category_id'];
        $search_category = new ProductManager("localhost","root", "root", "pool_php_rush");
        $result_category = $search_category->search_product_category($request_category);
        ?>
        <?php while($row = $result_category->fetch()){?>
          <div class="row">
            <div class="col s12 m6 l3">
              <div class="card">
                <div class="card-image">
                  <img class="responsive-img" src="<?php echo $row['img']?>">
                </div>
                <div class="card-content">
                  <p><?php echo $row['name']?></p>
                  <p>I drink the pressure !</p>
                  <p><?php  echo $row['price'] ?></p>
                </div>
                <div class="card-action">
                  <a href="#">ORDER (not for real....)</a>
                </div>
              </div>
            </div>
          </div>
        <?php }
      }
      ?>
      <form action="index.php" method="post">
        <?php echo "Category id reminder" ?>
        <select name="name" class="browser-default">
          <?php
          $category = new CategoryManager("localhost","root", "root", "pool_php_rush");
          $result = $category->display_name();
          while($data = $result->fetch()){ ?>
          <option value =" <?php echo $data['name'] . "-" . $data['parent_id']; ?>"><?php echo $data['name'] . "-" . $data['parent_id']?></option>
        <?php } ?>
      </select>
      <?php
      echo "Write the id category to display who corresponding to the products :-)";
      echo $form->input_text('category_id');
      echo $form->hidden('search_category');
      ?>
      <?php
      $product = new ProductManager("localhost","root", "root", "pool_php_rush");
      $result = $product->display_product();
      ?>
      <?php while($row = $result->fetch()){  ?>
        <div class="row">
          <div class="col s12 m6 l3">
            <div class="card">
              <div class="card-image">
                <img class="responsive-img" src="<?php echo $row['img']?>">
              </div>
              <div class="card-content">
                <p><?php echo $row['name']?></p>
                <p>I drink the pressure !</p>
                <p><?php  echo $row['price'] ?></p>
              </div>
              <div class="card-action">
                <a href="#">ORDER (not for real....)</a>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
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
        © 2017 Copyright Text / Alex and Flavien
      </div>
    </div>
  </footer>
  </html>
