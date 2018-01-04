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
  <title>Admin user</title>
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
    <a href ='admin_category.php'><i class="medium material-icons">create_new_folder</i>Add category</a><br>
    <a href ='index.php'><i class="medium material-icons">home</i>return home</a><br>
    <a href="logout.php"><i class="medium material-icons">exit_to_app</i>Click to logout</a>
    <?php
    require 'class.php';
    require 'class_admin.php';
    $form = new form();?>

    <h1>Create user</h1>
    <?php
    if(isset($_POST["create"]))
    {
      $admin = $_POST["admin"];
      $name = $_POST["name"];
      $email =  $_POST["email"];
      $password = $_POST["password"];
      $password_confirm = $_POST["password_confirm"];
      $user = new UserManager("localhost","root", "root", "pool_php_rush");
      $user->create_user($name, $email, $password, $password_confirm, $admin);

      if($verif[0] == "TRUE" && $verif[1] == "TRUE" && $verif[2] =="TRUE"){
       echo "User created.";
     }
       else{
         echo "something wrong here.... name and password between 3 and 20 caracters, email valid ";
       }
      }
    ?>

    <form action="admin_user.php" method="post">
      <?php
      echo $form->input_text('name');
      echo $form->input_text('email');
      echo $form->input_password('password');
      echo $form->input_password('password_confirm');
      echo "ADMIN ? write '1' for yes or '2' for no :";
      echo $form->input_text('admin');
      echo $form->hidden('create');
      ?>
    </form>

    <h1>Edit user</h1>
    <?php if(isset($_POST["edit"]))
    {
      $id = $_POST["id"];
      $name = $_POST["new_name"];
      $email =  $_POST["new_email"];
      $password = $_POST["new_password"];
      $password_confirm = $_POST["password_confirm"];
      $user = new UserManager("localhost","root", "root", "pool_php_rush");
      $user->edit_user($id, $name, $email, $password, $password_confirm);
      if($verif[0] == "TRUE" && $verif[1] == "TRUE" && $verif[2] =="TRUE"){
       echo "User created.";
     }
       else{
         echo "something wrong here.... name and password between 3 and 20 caracters, email valid ";
       }
      }
    ?>
    <form action="admin_user.php" method="post">
      <?php echo "Id and name reminder" ?>
      <select name="name" class="browser-default">
        <?php
        $user = new UserManager("localhost","root", "root", "pool_php_rush");
        $result = $user->display_name();
        while($data = $result->fetch()): ?>
        <option value =" <?php echo $data['id'] . "-" . $data['username']; ?>"><?php echo $data['id'] . "-" . $data['username']?></option>
      <?php endwhile ?>
    </select>
    <?php
    echo "Write the id name that you want to edit in the 'id' field :-)";
    echo $form->input_text('id');
    echo $form->input_text('new_name');
    echo $form->input_text('new_email');
    echo $form->input_password('new_password');
    echo $form->input_password('password_confirm');
    echo $form->hidden('edit');
    ?>
  </form>

  <h1>Delete user</h1>
  <?php if(isset($_POST["delete"]))
  {
    $id = $_POST["id"];
    $user = new UserManager("localhost","root", "root", "pool_php_rush");
    $user->delete_user($id);
    echo "User delete or not... check drop down id-name ;-)";
  }
  ?>
  <form action="admin_user.php" method="post">
    <select name="name" class="browser-default">
      <?php
      $user = new UserManager("localhost","root", "root", "pool_php_rush");
      $result = $user->display_name();
      while($data = $result->fetch()): ?>
      <option value =" <?php echo $data['id'] . "-" . $data['username']; ?>"><?php echo $data['id'] . "-" . $data['username']?></option>
    <?php endwhile ?>
  </select>
  <?php
  echo "Write the id name in the 'id' field to delete the user :-(";
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
