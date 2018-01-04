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
  <title>Admin category</title>
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
    <?php   session_start(); ?>
    <p class = "center" ><?php echo "Hello " . $_SESSION['name']."<br />";?></p>
    <a href ='admin_product.php'><i class="medium material-icons">add_shopping_cart</i>Add product</a><br>
    <a href="admin_user.php"><i class="medium material-icons">person_add</i>Add user</a> <br />
    <a href ='index.php'><i class="medium material-icons">home</i>return home</a><br>
    <a href="logout.php"><i class="medium material-icons">exit_to_app</i>Click to logout</a>
    <?php
    require 'class.php';
    require 'class_admin.php';
    $form = new form();?>
    <h1>Create Category</h1>
    <?php
    if(isset($_POST["create"]))
    {
      $name = $_POST["name"];
      $parent_id =  $_POST["parent_id"];
      $product = new CategoryManager("localhost","root", "root", "pool_php_rush");
      $product->create_category($name, $parent_id);
      if($verif[0] == "TRUE" && $verif[1] == "TRUE"){
        echo "Category created.";
      }
      else{
        echo "something wrong here.... name between 3 and 20 caracters, parent_id must be a number";
      }
    }
    ?>

    <form action="admin_category.php" method="post">
      <?php
      echo $form->input_text('name');
      echo $form->input_text('parent_id');
      echo $form->hidden('create');
      ?>
    </form>

    <h1>Edit Category</h1>
    <?php if(isset($_POST["edit"]))
    {
      $id = $_POST["id"];
      $name = $_POST["new_name"];
      $parent_id =  $_POST["new_parent_id"];
      $category = new CategoryManager("localhost","root", "root", "pool_php_rush");
      $category->edit_category($id, $name, $parent_id);
      if($verif[0] == "TRUE" && $verif[1] == "TRUE"){
        echo "Category modified.";
      }
      else{
        echo "something wrong here.... name between 3 and 20 caracters, parent_id must be a number, and the id in the drop down menu of course ! ";
      }
    }
    ?>
    <form action="admin_category.php" method="post">
      <select name="name" class="browser-default">
        <?php
        $product = new CategoryManager("localhost","root", "root", "pool_php_rush");
        $result = $product->display_name();
        while($data = $result->fetch()): ?>
        <option value =" <?php echo $data['id'] . "-" . $data['name']; ?>"><?php echo $data['id'] . "-" . $data['name']?></option>
      <?php endwhile ?>
    </select>
    <?php
    echo "Write the id category that you want to edit in the 'id' field :-)";
    echo $form->input_text('id');
    echo $form->input_text('new_name');
    echo $form->input_text('new_parent_id');
    echo $form->hidden('edit');
    ?>
  </form>

  <h1>Delete Category</h1>
  <?php if(isset($_POST["delete"]))
  {
    $name = $_POST["id"];
    $user = new CategoryManager("localhost","root", "root", "pool_php_rush");
    $user->delete_category($name);
    echo "Category delete or not... check drop down id-category ;-)";
  }
  ?>

  <form action="admin_category.php" method="post">
    <form action="admin_product.php" method="post">
      <select name="name" class="browser-default">
        <?php
        $product = new CategoryManager("localhost","root", "root", "pool_php_rush");
        $result = $product->display_name();
        while($data = $result->fetch()): ?>
        <option value =" <?php echo $data['id'] . "-" . $data['name']; ?>"><?php echo $data['id'] . "-" . $data['name']?></option>
      <?php endwhile ?>
    </select>
    <?php
    echo "Write the id category to delete the product :-(";
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
