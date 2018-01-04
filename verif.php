<?php
const ERROR_LOG_FILE = "error_log";
session_start();

function verif()
{
  $name    = $_POST['name'];
  $email   = $_POST['email'];
  $password= $_POST['password'];
  $verif_password= $_POST['password_confirm'];

  if(strlen($name) <= 10 && strlen($name) >= 3)
  {
    $name = "TRUE";
  }
  else {
    $name= "Invalid Name.";
  }
  if(strpos($email, "@") && strpos($email, "."))
  {
    $email = "TRUE";
  }
  else {
    $email = "Invalid Email.";
  }
  if((strlen($password) <= 10 && strlen($password) >= 3) && $password == $verif_password)
  {
    $password = "TRUE";
  }
  else {
    $password= "Invalid password or password confirmation.";
  }

  $verif= array($name, $email, $password);

  if($verif[0] == "TRUE" && $verif[1] == "TRUE" && $verif[2] == "TRUE")
  {
    writeUser();
  }
  return ($verif);
}

function Connect()
{
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
  return $conn;
}

function writeUser()
{
  $conn    = Connect();
  $name    = $_POST['name'];
  $_SESSION['name'] = $name;
  $email   = $_POST['email'];
  $password= password_hash($_POST['password'], PASSWORD_BCRYPT);

  $query   = "INSERT into users (username, email, password) VALUES ('" . $name . "','" . $email . "','" . $password . "')";
  $success = $conn->exec($query);
}
?>
