<?php
error_reporting(0);
  $servername = "localhost";
  $username = "abd";
  $password = "1234";
  
  try {
      $conn = new PDO("mysql:host=$servername;dbname=rma", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $id = $_POST['id'];
      $delete = $conn->prepare("DELETE FROM `client` WHERE `client`.`ID_C` = $id");
      $delete->execute();
      header('location:http://localhost/projet/gestion%20des%20clients/gestion_client.php');
  } catch(PDOException $e) {
        echo $e->getMessage();
  }
?>