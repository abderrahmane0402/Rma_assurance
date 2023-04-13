<?php   
    error_reporting(0);
    $servername = "localhost";
    $username = "abd";
    $password = "1234";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=rma", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $date = date("Y-m-d");

        //affaires in day
        $total_a = $conn->prepare("SELECT COUNT(N_ATTESTATION) as total_a from affaires WHERE DATE_FAIT = '$date' ;");
        $total_a->execute();
        $total_a = $total_a->fetch(PDO::FETCH_ASSOC);

        //affaires in monts
        $date = date('m');
        $w = '_____'.$date.'___';
        $total_a_m = $conn->prepare("SELECT COUNT(N_ATTESTATION) as total_a_m from affaires WHERE DATE_FAIT LIKE '$w';");
        $total_a_m->execute();
        $total_a_m= $total_a_m->fetch(PDO::FETCH_ASSOC);

        // // goal
        // $goal_d = $conn->prepare("SELECT goal from extra WHERE type = 'a_day_goal';");
        // $goal_d->execute();
        // $goal_d = $goal_d->fetch(PDO::FETCH_ASSOC);
        
        // $goal_d_m = $conn->prepare("SELECT goal from extra WHERE type = 'a_month_goal';");
        // $goal_d_m->execute();
        // $goal_d_m = $goal_d_m->fetch(PDO::FETCH_ASSOC);

        session_start();
        $emailuser = $_SESSION['email'];
        $password_ofuser =  $_SESSION['password'];
        $user_info = $conn->prepare("select * from employer where EMAIL_emp = '$emailuser' and PASSWORD = '$password_ofuser'");
        $user_info->execute();
        $user_info = $user_info->fetch(PDO::FETCH_ASSOC);

        
        if(isset($_POST['submitp'])){
          if(!empty($_FILES['img']['name'])){
            $image = $_FILES['img']['tmp_name'];
            $imgcontent = addslashes(file_get_contents($image));
            $change = $conn->prepare("UPDATE `employer` SET `photo` = '$imgcontent' WHERE EMAIL_emp = '$emailuser' and PASSWORD = '$password_ofuser'");
            $change->execute();
            header("location:http://localhost/projet/p_page/main_p.php");
          }
        }
        


    }catch(PDOException $e) {
            echo $e->getMessage();
    } 
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="main_p_css.css" />
    <link rel="stylesheet" href="../icons/css/all.css" />
    <title>rma</title>
  </head>
  <body>
    <nav id="pnav">
      <div class="element element1" id="pnav_e">
        <div class="nav active">
          <i class="fa-solid fa-house"></i><a href="http://localhost/projet/p_page/main_p.php">Dashbord</a>
        </div>
        <div class="nav" id="open_p">
          <i class="fa-solid fa-circle-user"></i><a href="#">Employer</a>
        </div>
        <div class="nav">
          <i class="fa-solid fa-user-group"></i><a href="http://localhost/projet/gestion%20des%20clients/gestion_client.php">Client</a>
        </div>
        <div class="nav">
          <i class="fa-solid fa-clock-rotate-left"></i><a href="http://localhost/projet/delay/delay.php">delay</a>
        </div>
        <div class="nav">
          <i class="fa-solid fa-box-open"></i><a href="http://localhost/projet/archif/archif.php">archif</a>
        </div>
        <div class="nav">
          <i class="fa-solid fa-coins"></i><a href="http://localhost/projet/payment/payment.php">payment</a>
        </div>
        <hr />
        <div class="nav">
          <i class="fa-solid fa-ear-listen"></i><a href="#">assistense</a>
        </div>
        <div class="nav">
          <i class="fa-solid fa-gear"></i><a href="#">parametre</a>
        </div>
        <div class="nav">
          <i class="fa-solid fa-right-from-bracket"></i><a href="http://localhost/projet/">log out</a>
        </div>
      </div>
    </nav>
    <div class="e1" id="el"></div>
    <header>
      <div class="element elementh" id="elementh">
        <div class="search h">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" class="text" placeholder="tape here to search" />
        </div>
        <div class="h_b h"><i class="fa-solid fa-magnifying-glass"></i></div>
        <div class="h_b h"><i class="fa-solid fa-envelope"></i></div>
        <div class="logo"></div>
      </div>
    </header>
    <div class="e2" id="e2">
      <div class="element element2" id="e2_w">
        <div class="e2_t">
          <p>affaires these day</p>
          <p class="number"><?php echo $total_a['total_a'];?></p>
        </div>
      </div>
    </div>
    <div class="e3" id="e3">
      <div class="element element3" id="e3_w">
        <div class="e3_t">
          <p>affaires these month</p>
          <p class="number"><?php echo $total_a_m['total_a_m'];?></p>
        </div>
      </div>
    </div>
    <div class="e4" id="e4">
      <div class="element element4" id="e4_w">
        <canvas id="myChart"></canvas>
      </div>
    </div>
    <div class="e5" id="e5">
      <div class="element element5" id="e5_w">
        <canvas id="myChart1"></canvas>
      </div>
    </div>
    <div class="e6" id="e6">
      <div class="element element6" id="e6_w">
        <div class="titre">
          <p>Expire bientot</p>
          <div class="v_p">
            <a href="#">voir plus</a>
          </div>
        </div>
        <div class="table">
          <table>
            <tr>
              <th>nom</th>
              <th>prenom</th>
              <th>phone</th>
              <th>email</th>
              <th>date expiration</th>
            </tr>
            <tr>
              <td>sabkari</td>
              <td>abderrahmane</td>
              <td>0777524479</td>
              <td>abderrahmanerr@gmail.com</td>
              <td>25/02/2023</td>
            </tr>
            <tr>
              <td>hnioua</td>
              <td>abdessamad</td>
              <td>0632437872</td>
              <td>oubourazsalma@gmail.com</td>
              <td>01/09/2022</td>
            </tr>
          </table>
        </div>
      </div>
    </div>

    <div class="profile" id="profile">
      <div class="p_img">
        <form method="post" enctype="multipart/form-data">
          <input type="file" name="img" id="file" />
          <input
            type="submit"
            name="submitp"
            value="submit"
            id="submitp"
            title="save image"
          />
        </form>
        <div class="edit">
          <label for="file" class="editer">
            <i class="fa-solid fa-pen" style="font-size: 17px"></i>
          </label>
        </div>
        <div class="submit">
          <label for="submitp" class="submit1">
            <i class="fa-solid fa-floppy-disk" style="font-size: 17px"></i>
          </label>
        </div>
        <?php if(!empty($user_info['photo'])){ ?>
          <img
          id="img"
          src="data:<?php echo $_FILES['img']['type'];?>;charset=utf8;base64,<?php echo base64_encode($user_info['photo']);?>" 
          alt="employer_img"
          width="100%"
          height="100%"
          />
        <?php
        }else{
        ?>
        <img
        id="img"
        src="R.png"
        alt="employer_img"
        width="100%"
        height="100%"
        />
        <?php } ?>
      </div>
      <form
        action="save_profile.php"
        method="post"
        class="p_form"
        enctype="multipart/form-data"
      >
        <b class="t1">Prenom:</b>
        <input
          type="text"
          name="prenom"
          value="<?php echo $user_info['PRENOM_EMP'];?>"
          class="info info1"
        />
        <div class="underline underline1"></div>
        <b class="t2">Nom:</b>
        <input
          type="text"
          name="nom"
          value="<?php echo $user_info['NOM_EMP'];?>"
          class="info info2"
        />
        <div class="underline underline2"></div>
        <b class="t3">Tele:</b>
        <input
          type="text"
          name="phone"
          value="<?php echo $user_info['NUM_TELE'];?>"
          class="info info3"
        />
        <div class="underline underline3"></div>
        <b class="t4">Email:</b>
        <input
          type="text"
          name="email"
          value="<?php echo $user_info['EMAIL_emp'];?>"
          class="info info4"
        />
        <div class="underline underline4"></div>
        <b class="t5">Date de naissance:</b>
        <input
          type="text"
          name="d_n"
          value="<?php echo $user_info['DATE_NAISSANCE'];?>"
          class="info info5"
        />
        <div class="underline underline5"></div>
        <b class="t6">Mot de passe:</b>
        <input type="password" name="password" value="" class="info info6" />
        <div class="underline underline6"></div>
        <div class="log">
          <input type="submit" value="save" class="lgb" />
          <input type="reset" value="reset" class="lgb reset" />
        </div>
      </form>
      <button class="exit" id="exit"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <script src="main_p_scr.js"></script>
    <script
      type="text/javascript"
      src="https://cdn.jsdelivr.net/npm/chart.js"
    ></script>
    <script>
        

// progres cirle


// let circle1 = document.getElementById("circle1");
// let circle2 = document.getElementById("circle2");
// let num1 = document.getElementById("num1");
// let num2 = document.getElementById("num2");
//     var count1 = <?php echo $total_a['total_a'];?> , count2 =<?php echo $total_a_m['total_a_m'];?>, a, a2 ,  c=0 , c2=0;
//     let p , p2;
//     let total1 = <?php echo $goal_d['goal'];?>;
//     let total2 = <?php echo $goal_d_m['goal'];?>;
//     function circled1(tag){
//       p = count1 * 100 / total1;
//       p = p.toFixed(0);
//       if(p == 0){
//           tag.innerText = 0 + "%";
//       }
//       if(total1 > 200){
//         if(c != p){
//           c--;
//           tag.innerText = `${c}` + "%";
//         }
//       }else if(total1 < 200){
//         if(c != p){
//           c++;
//           tag.innerText = `${c}` + "%";
//         }
//       }else if(total1 == 200){
//         if(c != p){
//           c++;
//           tag.innerText = `${c}` + "%";
//         }
//       }
//       if(c == p){
//         clearInterval(sit1);
//       }
//     }
//     function circleo1(element){
//       p = count1 * 100 / total1;
//       p = p.toFixed(0);
//       a = 280-(p * 280 / 100);
//       element.style.strokeDashoffset = `${a}`;
//     }
//     sit1 =  setInterval(circled1 , 30 , num1);
//     setInterval(circleo1 , 30 , circle1);
//     function circled2(tag){
//       p2 =count2 * 100 / total2;
//       p2 = p2.toFixed(0);
//       if(p2 == 0){
//           tag.innerText = 0 + "%";
//       }
//       if(total2 > 200){
//         if(c2 != p2){
//           c2--;
//           tag.innerText = `${c2}` + "%";
//         }
//       }else if(total2 < 200){
//         if(c2 != p2){
//           c2++;
//           tag.innerText = `${c2}` + "%";
//         }
//       }else if(total2 == 200){
//         if(c2 != p2){
//           c2++;
//           tag.innerText = `${c2}` + "%";
//         }
//       }
//       if(c2 == p2){
//         clearInterval(sit2);
//       }
//     }
//     function circleo2(element){
//       p2 = count2 * 100 / total2;
//       p2 = p2.toFixed(0);
//       a2 = 280-(p2 * 280 / 100);
//       element.style.strokeDashoffset = `${a2}`;
//     }
//     sit2 = setInterval(circled2 , 30  ,num2);
//     setInterval(circleo2 , 30 , circle2);




    // chart.js


    const data = {
      labels: ['jan', 'fev', 'mars', 'avrile', 'may', 'join', 'joill','aout','sep','oct','nov','dec'],
      datasets: [{
        label: 'Profits per month',
        data: [18, 12, 6, 9, 12, 3, 9 , 3 , 2 , 8 , 9 , 7],
        backgroundColor: [
          'white'
        ],
        borderColor: [
          'blue'
        ],
        borderWidth: 2
      }]
    };

    // config 
    const config = {
      type: 'line',
      data,
      options: {
        scales: {
          y: {
            beginAtZero: true,
            ticks:{
              color:"white"
            },
            min:0,
            max:25
          },
          x:{
            ticks:{
              color:'white'
            }
          }
        }
      }
    };
    // render init block
    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );

    const ctx = document.getElementById('myChart1').getContext('2d');
    const myChart1 = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['cyclo' , 'automobile' , 'commerce' , 'camion'],
            datasets: [{
                label: 'number of cars',
                data: [100 , 200 , 350 , 400],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });



    </script>
    
    <?php
    /*$s = $_GET['text'];
    while($s == 'false'){
      if($s == 'true'){
        $s2 = $_GET['text1'];
        $conn->prepare("UPDATE extra SET goal = '$s2' WHERE extra.type = 'a_day_goal';");
        $conn->execute();
        echo "<script>php_js1.value = 'false'</script>";
      }
      $s = $_GET['text'];
    }*/
    ?>
</body>
</html>
