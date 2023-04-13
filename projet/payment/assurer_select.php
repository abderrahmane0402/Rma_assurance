<?php
    error_reporting(0);
    $servername = "localhost";
    $username = "abd";
    $password = "1234";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=rma", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $id = $conn->prepare("select ID_C from client where CIN_C = '$cin'");
    $id->execute();
    $id = $id->fetch(PDO::FETCH_ASSOC);
    $id = $id['ID_C'];
    $vehicule = $conn->prepare("INSERT INTO `vehicule` (`ID_VEHICULE`, `ID_C`, `TYPE_V`, `MARQUE`, `MODEL`, `CARBURANT`, `NBR_PLACE`, `MATRICULE`) VALUES (NULL, '$id', '$type', '$marque', '$model', '$carburant', '$nbrp', '$mat');");
    $vehicule->execute();
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
?>