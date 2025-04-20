<?php 
  $server = "localhost";
  $username = "root";
  $password = "";
  $db_name = "jazz-bar";
  $charset = "utf8mb4";

  try {
    $conn = new PDO("mysql:host=$server;dbname=$db_name;charset=$charset", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    die("connextion failed: " . $e->getMessage());
  }

?>
