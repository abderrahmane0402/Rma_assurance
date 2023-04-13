<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="loginss.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+SC&display=swap" rel="stylesheet">
</head>
<body>
    <div class="s1" id="d1">
        <div class="content">
            <div class="content1 font">
                <h1>welcome</h1>
                <a href="http://localhost/projet/sign_up_page/sign_up.php"><button>sign up</button></a>
            </div>
            <div class="content2 font">
                <h1>log in</h1>
                <div id="error"></div>
                <form action="" method="post" class="form">
                    <input class="tarea" type="email" name="email" placeholder="exemple@gmail.com" required>
                    <input class="tarea" type="password" name="pass" id="p" placeholder="password" required>
                    <div class="add_f">
                        <div class="check">
                            <input type="checkbox" name="remembre">
                            <label for="remembre">remembre me</label>   
                        </div>
                        <a href="#">forget password</a>
                    </div>
                    <input class="submit" type="submit" value="login">
                </form>
            </div>
        </div>
    </div>
        <script src="loginb.js"></script> 
    
</body>
</html>
<?php
    error_reporting(0);
    $servername = "localhost";
    $username = "abd";
    $password = "1234";
    session_start();
    unset($_SESSION['password']);
    unset($_SESSION['email']);
    try {
        $conn = new PDO("mysql:host=$servername;dbname=rma", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $email = $_POST['email'];
        $password = md5($_POST['pass']);
        if($email != "" && $password != md5("")){
            echo "<script>body[0].style.display = 'none';</script>";
            $sql = $conn->prepare("select PASSWORD from employer where EMAIL_emp = \"$email\";");
            $sql->execute();
            if($sql->rowCount() > 0){
                $result = $sql->fetch(PDO::FETCH_ASSOC);
                if($result["PASSWORD"] == $password){
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    header("location:http://localhost/projet/p_page/main_p.php");
                }else{
                    echo "<script>
                    document.getElementById('error').innerText = 'wrong password';
                    </script>"; 
                }
            }else{
                echo "<script>
                document.getElementById('error').innerText = 'email n existe pas'; 
                </script>";
            }
        }
    } catch(PDOException $e) {
        echo '<script>alert("something wrong was happen")</script>';
    }
        $conn = NULL;
?>