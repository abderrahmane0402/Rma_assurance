<?php
        
    $servername = "localhost";
    $username = "abd";
    $password = "1234";
    try{
        $conn = new PDO("mysql:host=$servername;dbname=rma", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        session_start();
        
        $email = $_SESSION['email'];
        $password_user = $_SESSION['password'];
        $user_info = $conn->prepare("select * from employer where EMAIL_emp = '$email' and PASSWORD = '$password_user'");
        $user_info->execute();
        $user_info = $user_info->fetch(PDO::FETCH_ASSOC);
        $bool = false;


        //user info changing
        $prenom = $_POST['prenom'];$nom = $_POST['nom'];
        $tele = $_POST['phone'];$emailu = $_POST['email'];
        $d_n = $_POST['d_n'];$upassword =md5($_POST['password']);
        if($prenom != $user_info['PRENOM_EMP'] && $prenom != ''){
            $change = $conn->prepare("UPDATE `employer` SET PRENOM_EMP = '$prenom' WHERE EMAIL_emp = '$email' and PASSWORD = '$password_user';");
            $change->execute();
        }
        if($nom != $user_info['NOM_EMP'] && $nom != ''){
            $change = $conn->prepare("UPDATE `employer` SET NOM_EMP = '$nom' WHERE EMAIL_emp = '$email' and PASSWORD = '$password_user';");
            $change->execute();
        }
        if($tele != '0'.$user_info['NUM_TELE'] && $tele != ''){
            $change = $conn->prepare("UPDATE `employer` SET NUM_TELE = '$tele' WHERE EMAIL_emp = '$email' and PASSWORD = '$password_user';");
            $change->execute();
        }
        if($emailu != $user_info['EMAIL_emp'] && $emailu != ''){
            $change = $conn->prepare("UPDATE `employer` SET EMAIL_emp = '$emailu' WHERE EMAIL_emp = '$email' and PASSWORD = '$password_user';");
            $change->execute();
            $email = $emailu;
            $bool = true;
        }
        if($d_n != $user_info['DATE_NAISSANCE'] && $d_n != ''){
            $change = $conn->prepare("UPDATE `employer` SET DATE_NAISSANCE = '$d_n' WHERE EMAIL_emp = '$email' and PASSWORD = '$password_user';");
            $change->execute();
        }
        if($upassword != $user_info['PASSWORD'] && $_POST['password'] != ''){
            $change = $conn->prepare("UPDATE `employer` SET PASSWORD = '$upassword' WHERE EMAIL_emp = '$email' and PASSWORD = '$password_user';");
            $change->execute();
            $password_user = $upassword;
            $bool = true;
        }
        if($bool == true){
            header("location: http://localhost/projet/login/login.php");
        }else{
            header("location:http://localhost/projet/p_page/main_p.php");
        }
    }catch(PDOException $e) {
        echo $e->getMessage();
    } 
        
?>