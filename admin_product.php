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
  <title>Admin product</title>
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
    <a href="admin_user.php"><i class="medium material-icons">person_add</i>Add user</a> <br />
    <a href ='admin_category.php'><i class="medium material-icons">create_new_folder</i>Add category</a><br>
    <a href ='index.php'><i class="medium material-icons">home</i>return home</a><br>
    <a href="logout.php"><i class="medium material-icons">exit_to_app</i>Click to logout</a>
    <?php
    require 'class.php';
    require 'class_admin.php';
    $form = new form();?>

    <h1>Create Product</h1>
    <?php
    if(isset($_POST["create"]))
    {
      $name = $_POST["name"];
      $price =  $_POST["price"];
      $category_id = $_POST["category_id"];
      $img = $_POST["img"];
      $product = new ProductManager("localhost","root", "root", "pool_php_rush");
      $product->create_product($name, $price, $category_id, $img);
      if($verif[0] == "TRUE" && $verif[1] == "TRUE" && $verif[2] =="TRUE"){
       echo "Product created.";
     }
       else{
         echo "something wrong here.... name between 3 and 20 caracters, price not null, category must be in the drop down menu ";
       }
    }
    ?>
    <form action="admin_product.php" method="post">
      <?php
      echo $form->input_text('name');
      echo $form->input_text('price');
      echo " write like this : http://localhost/rush/step_6/img/name_of_your_img";
      echo $form->input_text('img');?>
      <form action="admin_category.php" method="post">
        <div class = "row">
          <?php echo "Category id reminder" ?>
          <select name="name" class="browser-default">
            <?php
            $category = new CategoryManager("localhost","root", "root", "pool_php_rush");
            $result = $category->display_name();
            while($data = $result->fetch()): ?>
            <option value ="<?php echo $data['name'] . "-" . $data['parent_id']; ?>"><?php echo $data['name'] . "-" . $data['parent_id']?></option>
          <?php endwhile ?>
        </select>
      </div>
      <?php
      echo $form->input_text('category_id');
      echo $form->hidden('create');
      ?>
    </form>

    <h1>Edit Product</h1>
    <?php if(isset($_POST["edit"]))
    {
      $id = $_POST["id"];
      $name = $_POST["new_name"];
      $price =  $_POST["new_price"];
      $img = $_POST["new_img"];
      $category_id = $_POST["new_category_id"];
      $product = new ProductManager("localhost","root", "root", "pool_php_rush");
      $product->edit_product($id, $name, $price, $category_id, $img);
      if($verif[0] == "TRUE" && $verif[1] == "TRUE" && $verif[2] =="TRUE"){
       echo "Product modified.";
     }
       else{
         echo "something wrong here.... name between 3 and 20 caracters, price not null, category must be in the drop down menu ";
       }

    } ?>
    <form action="admin_product.php" method="post">
      <?php echo "Id and old name reminder" ?>
      <select name="name" class="browser-default">
        <?php
        $product = new ProductManager("localhost","root", "root", "pool_php_rush");
        $result = $product->display_name();
        while($data = $result->fetch()): ?>
        <option value =" <?php echo $data['id'] . "-" . $data['name']; ?>"><?php echo $data['id'] . "-" . $data['name']?></option>
      <?php endwhile ?>
    </select>
    <?php
    echo "Write the id product that you want to edit in the 'id' field :-)";
    echo $form->input_text('id');
    echo $form->input_text('new_name');
    echo $form->input_text('new_price');
    echo " write like this : http://localhost/rush/step_6/img/name_of_your_img";
    echo $form->input_text('new_img');
    echo $form->input_text('new_category_id');
    echo $form->hidden('edit');
    ?>
  </form>

  <h1>Delete Product</h1>
  <?php if(isset($_POST["delete"]))
  {
    $name = $_POST["name"];
    $user = new ProductManager("localhost","root", "root", "pool_php_rush");
    $user->delete_product($name);
      echo "Product delete or not... check drop down id-name ;-)";
  }
  ?>
  <form action="admin_product.php" method="post">
    <select name="name" class="browser-default">
      <?php
      $product = new ProductManager("localhost","root", "root", "pool_php_rush");
      $result = $product->display_name();
      while($data = $result->fetch()): ?>
      <option value =" <?php echo $data['id'] . "-" . $data['name']; ?>"><?php echo $data['id'] . "-" . $data['name']?></option><br />
    <?php endwhile ?>
  </select>
  <?php
  echo "Write the id product to delete the product :-(";
  echo $form->input_text('id');
  echo $form->hidden('delete');
  ?>
</form>

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
