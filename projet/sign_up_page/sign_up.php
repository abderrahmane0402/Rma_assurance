<?php 
error_reporting(0);
    $servername = "localhost";
    $username = "abd";
    $password = "1234";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=rma", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $name = $_POST['name'];
        $lname = $_POST['lname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $cin = $_POST['CIN'];
        $birth = $_POST['Birth_Day'];
        $password = md5($_POST['password']);
        $cpassword = md5($_POST['c_password']);
        if($password != md5("")){
            if($password == $cpassword){
                $sql = "INSERT into employer (NOM_EMP , PRENOM_EMP ,DATE_NAISSANCE, CIN_EMP , NUM_TELE  , EMAIL_emp , PASSWORD)
                VALUES ('$lname' , '$name' , '$birth' , '$cin' , '$phone' , '$email' , '$password');";
                $conn->exec($sql);
                $name = "";
                $lname = "";
                $phone = "";
                $email = "";
                $cin = "";
                $birth = "";
                $password = "";
                $cpassword = "";
                header("location: http://localhost/projet/index.php");
            }else{
                echo '<script>alert("confirme mot de pas error");</script>';
            }
        }
            
    } catch(PDOException $e) {
        //echo '<script>alert("something wrong was happen")</script>';
        echo $e->getMessage();
    }
        $conn = NULL;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign up</title>
    <link rel="stylesheet" href="sign_ups.css">
    <link rel="stylesheet" href="sign_upss.css">
</head>
<body>
    <div class="sign_up" id="fild">
        <div class="pr">
            <h1>Sign Up</h1>
            <img src="" alt="">
            <form action="" class="form" method="post">
                <div class="s1">
                    <label for="name">Name</label>
                    <label for="lname">Last Name</label>
                    <input type="text" name="name" value='<?php echo $name?>' required>
                    <input type="text" name="lname" value='<?php echo $lname?>' required>
                    <label for="phone">Phone</label>
                    <label for="email">E-mail</label>
                    <input type="tel" name="phone" value='<?php echo $phone?>' required>
                    <input type="email" name="email" value='<?php echo $email?>' required>
                    <label for="CIN">CIN</label>
                    <label for="Birth_Day">Birth Day</label>
                    <input type="text" name="CIN" value='<?php echo $cin?>' required>
                    <input type="date" name="Birth_Day" placeholder="date" value='<?php echo $birth?>' required>
                    <label for="password">Password</label>
                    <label for="c_password">Confirme Password</label>
                    <input type="password" name="password" required>
                    <input type="password" name="c_password" required>
                </div>
                <div class="last">  
                    <input type="checkbox" name="check" required>
                    <label for="check">i agree to <span>Terms and Condition</span></label>
                    <input type="submit" value="SIGN UP" class="submit" name="submit">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
