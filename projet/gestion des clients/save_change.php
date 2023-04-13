<?php
// error_reporting(0);
  $servername = "localhost";
  $username = "abd";
  $password = "1234";
  
  try {
      $conn = new PDO("mysql:host=$servername;dbname=rma", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $nom = $_POST['nom'];$prenom = $_POST['prenom'];$date = $_POST['date'];$cin = $_POST['cin'];$email = $_POST['email'];$tele=$_POST['tele'];$id = $_POST['id'];
      $save = $conn->prepare("UPDATE `client` SET `NOM_C` ='$nom', `PRENOM_C` = '$prenom', `DATE_N` = '$date', `CIN_C` = '$cin', `EMAIL_C` = '$email', `NUM_TELE` = '$tele' WHERE `client`.`ID_C` = $id;");
      $save->execute();
      header('location:http://localhost/projet/gestion%20des%20clients/gestion_client.php');
  } catch(PDOException $e) {
        echo $e->getMessage();
  }
?>