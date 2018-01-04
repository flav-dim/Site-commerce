<?php
class UserManager{
  private $dbhost;
  private $dbuser;
  private $dbpass;
  private $dbname;
  private $conn;

  public function __construct($dbhost, $dbuser, $dbpass, $dbname){
    $this->dbhost = "localhost";
    $this->dbuser = "root";
    $this->dbpass = "root";
    $this->dbname = "pool_php_rush";
    $this->conn = new PDO("mysql:host=$dbhost;port=3306;dbname=$dbname", $dbuser, $dbpass);
  }

  public function create_user($name, $email, $pass, $verif_password, $admin){
    // $name    = $_POST['name'];
    // $email   = $_POST['email'];
    // $password= password_hash($_POST['password'], PASSWORD_BCRYPT);
    // $verif_password= $_POST['password_confirmation'];
    $password = password_hash($pass, PASSWORD_BCRYPT);

    if(strlen($name) <= 20 && strlen($name) >= 3)
    {
      $name_verif = "TRUE";
    }
    else
    {
      $name_verif= "Invalid Name.";
    }
    if(strpos($email, "@") && strpos($email, "."))
    {
      $email_verif = "TRUE";
    }
    else
    {
      $email_verif = "Invalid Email.";
    }
    if((strlen($pass) <= 10 && strlen($pass) >= 3) && $pass == $verif_password)
    {
      $password_verif = "TRUE";
    }
    else
    {
      $password_verif = "Invalid password or password confirmation.";
    }
    if($admin == 1){
      $admin_verif = 1;
    }
    $verif= array($name_verif, $email_verif, $password_verif,$admin_verif);
    if($verif[0] == "TRUE" && $verif[1] == "TRUE" && $verif[2] == "TRUE"&& $verif[3]==1)
    {
      $query   = "INSERT into users (username, email, password, admin) VALUES ('" . $name . "','" . $email . "','" . $password . "', '" . $admin . "')";
      $success = $this->conn->exec($query);
    }
    elseif($verif[0] == "TRUE" && $verif[1] == "TRUE" && $verif[2] == "TRUE"&& $verif[3]==2) {
      $query   = "INSERT into users (username, email, password) VALUES ('" . $name . "','" . $email . "','" . $password . "')";
      $success = $this->conn->exec($query);
    }
  }
  public function edit_user($id, $name, $email, $pass, $verif_password){
    // $old_name = $_SESSION['name'];
    // $name    = $_POST['name'];
    // $email   = $_POST['email'];
    $password= password_hash($pass, PASSWORD_BCRYPT);
    //$verif_password= $_POST['password_confirmation'];

    if(strlen($name) <= 10 && strlen($name) >= 3)
    {
      $name_verif = "TRUE";
    }
    else
    {
      $name_verif= "Invalid Name.";
    }
    if(strpos($email, "@") && strpos($email, "."))
    {
      $email_verif = "TRUE";
    }
    else
    {
      $email_verif = "Invalid Email.";
    }
    if((strlen($pass) <= 10 && strlen($pass) >= 3) && $pass == $verif_password)
    {
      $password_verif = "TRUE";
    }
    else
    {
      $password_verif = "Invalid password or password confirmation.";
    }
    $verif= array($name_verif, $email_verif, $password_verif);
    if($verif[0] == "TRUE" && $verif[1] == "TRUE" && $verif[2] == "TRUE")
    {
      $query   = "UPDATE users SET username = '$name', password = '$password', email = '$email' WHERE id = '$id'";
      $success = $this->conn->exec($query);
    }
  }
  public function delete_user($id){
    //$name = $_POST['name'];
    $query = "DELETE FROM users WHERE id = '$id'";
    $success = $this->conn->query($query);
  }
  public function display_user($name){
    //$name = $_POST['name'];
    $query = "SELECT id,username, email FROM users WHERE username = '$name'";
    /*"SELECT name FROM user WHERE name = '$name'";*/
    $success = $this->conn->exec($query);
  }
  public function display_name(){
    $query = "SELECT username, id FROM users";
    $success = $this->conn->query($query);
    return $success;
  }
  public function display_admin($name){
    $query = "SELECT admin FROM users WHERE username = '$name'";
    $success = $this->conn->query($query);
    return $success;
  }
}

class ProductManager {
  private $dbhost;
  private $dbuser;
  private $dbpass;
  private $dbname;
  private $conn;

  public function __construct($dbhost, $dbuser, $dbpass, $dbname){
    $this->dbhost = "localhost";
    $this->dbuser = "root";
    $this->dbpass = "root";
    $this->dbname = "pool_php_rush";
    $this->conn = new PDO("mysql:host=$dbhost;port=3306;dbname=$dbname", $dbuser, $dbpass);
  }

  public function create_product($name, $price, $category_id, $img){

    if(strlen($name) <= 20 && strlen($name) >= 3)
    {
      $name_verif = "TRUE";
    }
    else
    {
      $name_verif= "Invalid Name.";
    }
    if($price > 0 && $price < 1000000000 && $price !=NULL)
    {
      $price_verif = "TRUE";
    }
    else
    {
      $price_verif= "Invalid price.";
    }
    if($category_id >= 0 && $category_id < 1000000000)
    {
      $category_verif = "TRUE";
    }
    else
    {
      $category_verif= "Invalid category.";
    }
    $verif= array($name_verif, $price_verif, $category_verif);
    if($verif[0] =="TRUE" && $verif[1] == "TRUE" && $verif[2] == "TRUE")
    {
      $query   = "INSERT into products (name, price, category_id, img ) VALUES ('" . $name . "','" . $price . "','" . $category_id . "', '" . $img . "')";
      $success = $this->conn->exec($query);
    }
  }
  public function edit_product($id, $name, $price, $category_id, $img){

    if(strlen($name) <= 10 && strlen($name) >= 1)
    {
      $name_verif = "TRUE";
    }
    else
    {
      $name_verif= "Invalid Name.";
    }
    if($price > 0 && $price < 1000000000 && $price !=NULL)
    {
      $price_verif = "TRUE";
    }
    else
    {
      $price_verif= "Invalid price.";
    }
    if($category_id >= 0 && $category_id < 1000000000)
    {
      $category_verif = "TRUE";
    }
    else
    {
      $category_verif= "Invalid category.";
    }
    $verif= array($name_verif, $price_verif, $category_verif);
    if($verif[0] =="TRUE" && $verif[1] == "TRUE" && $verif[2] == "TRUE")
    {
      $query   = "UPDATE products SET name = '$name', price = '$price', category_id = '$category_id', img = '$img' WHERE id = '$id'";
      $success = $this->conn->exec($query);
    }
  }
  public function delete_product($id){
    //$name = $_POST['name'];
    $query = "DELETE FROM products WHERE id = '$id'";
    $success = $this->conn->query($query);
  }
  public function display_product(){
    //$name = $_POST['name'];
    $query = "SELECT * FROM products";
    $success = $this->conn->query($query);
    return $success;
  }

  public function search_product_name($request){
    //$name = $_POST['name'];
    $query = "SELECT * FROM products WHERE name LIKE '%$request%'";
    $success = $this->conn->query($query);
    return $success;
  }
  public function search_product_category($request){
    //$name = $_POST['name'];
    $query = "SELECT * FROM products WHERE category_id = '$request'";
    $success = $this->conn->query($query);
    return $success;
  }
  public function search_product_price($request){
    //$name = $_POST['name'];
    $query = "SELECT * FROM products WHERE price = '$request'";
    $success = $this->conn->query($query);
    return $success;
  }
  public function display_name(){
    $query = "SELECT name, id FROM products";
    $success = $this->conn->query($query);
    return $success;
  }
}
class CategoryManager {
  private $dbhost;
  private $dbuser;
  private $dbpass;
  private $dbname;
  private $conn;

  public function __construct($dbhost, $dbuser, $dbpass, $dbname){
    $this->dbhost = "localhost";
    $this->dbuser = "root";
    $this->dbpass = "root";
    $this->dbname = "pool_php_rush";
    $this->conn = new PDO("mysql:host=$dbhost;port=3306;dbname=$dbname", $dbuser, $dbpass);
  }

  public function create_category($name, $parent_id){
    //$name    = $_POST['name'];
    //$price    = "TRUE";

    if(strlen($name) <= 20 && strlen($name) >= 3)
    {
      $name_verif = "TRUE";
    }
    else
    {
      $name_verif= "Invalid Name.";
    }
    if($parent_id >=0 && $$parent_id<10000000)
    {
      $parent_verif = "TRUE";
    }
    else
    {
      $parent_verif= "Invalid price.";
    }
    $verif= array($name_verif, $parent_verif);
    if($verif[0] =="TRUE" && $verif[1] == "TRUE")
    {
      $query   = "INSERT into categories (name, parent_id) VALUES ('" . $name . "','" . $parent_id . "')";
      $success = $this->conn->exec($query);
    }
  }
  public function edit_category($id, $name, $parent_id){

    if(strlen($name) <= 10 && strlen($name) >= 3)
    {
      $name_verif = "TRUE";
    }
    else
    {
      $name_verif= "Invalid Name.";
    }
    if($parent_id>=0 && $$parent_id<10000000)
    {
      $parent_verif = "TRUE";
    }
    else
    {
      $parent_verif= "Invalid price.";
    }

    $verif= array($name_verif, $parent_verif);
    if($verif[0] =="TRUE" && $verif[1] == "TRUE")
    {
      $query   = "UPDATE categories SET name = '$name', parent_id = '$parent_id' WHERE id = '$id'";
      $success = $this->conn->exec($query);
    }
  }
  public function delete_category($id){
    //$name = $_POST['name'];
    $query = "DELETE FROM categories WHERE id = '$id'";
    $success = $this->conn->query($query);
  }
  public function display_name(){
    $query = "SELECT name, id, parent_id FROM categories";
    $success = $this->conn->query($query);
    return $success;
  }
}
?>
