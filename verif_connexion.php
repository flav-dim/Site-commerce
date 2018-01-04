<?php
session_start();
const ERROR_LOG_FILE = "error_log";

$email   = $_POST['email'];
$_SESSION['email'] = $email;
$password  = $_POST['password'];
$_SESSION['password'] = $password;
var_dump($email);
var_dump($password);

try {
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "root";
  $dbname = "pool_php_rush";

  $conn = new PDO("mysql:host=$dbhost;port=3306;dbname=$dbname", $dbuser, $dbpass);
} catch (PDOException $e)
{
  echo "Error connection to DB\n";
  error_log($e, 3 , "ERROR_LOG_FILE") . "\n";
  die();
}
$query_pass = "SELECT username, password, admin FROM users WHERE email like '$email'";
$result_pass = $conn->query($query_pass);
$a = $result_pass->fetch();
if(password_verify($password,$a["password"])){
  if($a["admin"]== 1) {
    $_SESSION['name'] = $a['username'];
    header("Location: admin.php");
    exit();
  }
  $_SESSION['name'] = $a['username'];
  header("Location: index.php");
  exit();
}
else{
  header("Location: login.php?valid=1");
  exit();
}
