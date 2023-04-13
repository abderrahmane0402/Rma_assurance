<?php
$servername = "localhost";
$username = "abd";
$password = "1234";

try {
    session_start();
    $conn = new PDO("mysql:host=$servername;dbname=rma", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $etat = $_SESSION['etat'];
    
    // client info
    $nom = $_POST['nom'];$prenom = $_POST['prenom'];$date = $_POST['date_n'];$cin = $_POST['cin'];$email = $_POST['email'];$tele=$_POST['tele'];
    
    // vehicule info
    $type = $_POST['type'];$marque = $_POST['marque'];$model = $_POST['model'];
    $carburant = $_POST['carburant'];$nbrp = $_POST['nbrp'];$mat = $_POST['mat'];
    
    // assur info
    if($_POST['duree'] == 1){
        $duree = "3mois";
    }elseif($_POST['duree'] == 2){
        $duree = "6mois";
    }elseif($_POST['duree'] == 4){
        $duree = "12mois";
    }
    $montant = $_POST['montant'];$date_fin = $_POST['date-fin'];$date_effet = $_POST['d-effet'];$date = date("Y-m-d");
    $client = $conn->prepare("INSERT INTO `client` (`ID_C`, `NOM_C`, `PRENOM_C`, `DATE_N`, `CIN_C`, `EMAIL_C`, `NUM_TELE`) VALUES (NULL, '$nom', '$prenom', '$date', '$cin', '$email', '$tele');");
    if($etat == 0){
        $client->execute();
        $id = $conn->prepare("select ID_C from client where CIN_C = '$cin'");
        $id->execute();
        $id = $id->fetch(PDO::FETCH_ASSOC);
        $id = $id['ID_C'];
        $vehicule = $conn->prepare("INSERT INTO `vehicule` (`ID_VEHICULE`, `ID_C`, `TYPE_V`, `MARQUE`, `MODEL`, `CARBURANT`, `NBR_PLACE`, `MATRICULE`) VALUES (NULL, '$id', '$type', '$marque', '$model', '$carburant', '$nbrp', '$mat');");
        $vehicule->execute();
        $idv = $conn->prepare("select ID_VEHICULE from vehicule where MATRICULE = '$mat'");
        $idv->execute();
        $idv = $idv->fetch(PDO::FETCH_ASSOC);
        $idv = $idv['ID_VEHICULE'];
        $assur = $conn->prepare("INSERT INTO `affaires` (`N_ATTESTATION`, `ID_VEHICULE`, `DATE_EFFET`, `DATE_ECHEANCE`, `DUREE`, `MONTANT`, `DATE_FAIT`) VALUES (NULL, '$idv', '$date_effet', '$date_fin', '$duree', '$montant', '$date');");
        $assur->execute();
    }elseif($etat == 1){
        $id = $conn->prepare("select ID_VEHICULE from vehicule where MATRICULE = '$mat'");
        $id->execute();
        $id = $id->fetch(PDO::FETCH_ASSOC);
        $id = $id['ID_VEHICULE'];
        $assur = $conn->prepare("INSERT INTO `affaires` (`N_ATTESTATION`, `ID_VEHICULE`, `DATE_EFFET`, `DATE_ECHEANCE`, `DUREE`, `MONTANT`, `DATE_FAIT`) VALUES (NULL, '$id', '$date_effet', '$date_fin', '$duree', '$montant', '$date');");
        $assur->execute();
    }elseif($etat == 2){
        $id = $conn->prepare("select ID_C from client where CIN_C = '$cin'");
        $id->execute();
        $id = $id->fetch(PDO::FETCH_ASSOC);
        $id = $id['ID_C'];
        $vehicule = $conn->prepare("INSERT INTO `vehicule` (`ID_VEHICULE`, `ID_C`, `TYPE_V`, `MARQUE`, `MODEL`, `CARBURANT`, `NBR_PLACE`, `MATRICULE`) VALUES (NULL, '$id', '$type', '$marque', '$model', '$carburant', '$nbrp', '$mat');");
        $vehicule->execute();
        $id = $conn->prepare("select ID_VEHICULE from vehicule where MATRICULE = '$mat'");
        $id->execute();
        $id = $id->fetch(PDO::FETCH_ASSOC);
        $id = $id['ID_VEHICULE'];
        $assur = $conn->prepare("INSERT INTO `affaires` (`N_ATTESTATION`, `ID_VEHICULE`, `DATE_EFFET`, `DATE_ECHEANCE`, `DUREE`, `MONTANT`, `DATE_FAIT`) VALUES (NULL, '$id', '$date_effet', '$date_fin', '$duree', '$montant', '$date');");
        $assur->execute();
    }
    header("location:http://localhost/projet/payment/payment.php");
} catch(PDOException $e) {
    echo $e->getMessage();
}
?>