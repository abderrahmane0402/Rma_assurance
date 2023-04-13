<?php
error_reporting(0);
  $servername = "localhost";
  $username = "abd";
  $password = "1234";
  
  try {
      $conn = new PDO("mysql:host=$servername;dbname=rma", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sss = $_POST['select'];

      if(isset($_POST['ssubmit'])){
        if(isset($_POST['search'])){
          $search = $_POST['search'];
          $search = '%'.$search.'%';
          $client_info = $conn->prepare("SELECT * FROM affaires natural join vehicule natural join client WHERE affaires.DATE_FAIT LIKE '$search' OR vehicule.MATRICULE LIKE '$search' OR client.CIN_C LIKE '$search';");
          $client_info->execute();
        }
      }elseif($sss == NULL || $sss == "plus-ancien") {
        $client_info = $conn->prepare("SELECT * FROM affaires natural join vehicule natural join client");
        $client_info->execute();
      }elseif($sss == "dernier") {
        $client_info = $conn->prepare("SELECT * FROM affaires natural join vehicule natural join client ORDER BY DATE_FAIT DESC");
        $client_info->execute();
      }
      $num_client = $conn->prepare("select count(N_ATTESTATION) as id from affaires");
      $num_client->execute();
      $num_client = $num_client->fetch(PDO::FETCH_ASSOC);



  } catch(PDOException $e) {
        echo $e->getMessage();
  } 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>client</title>
    <link rel="stylesheet" href="archif.css" />
    <link rel="stylesheet" href="../icons/css/all.css" />
  </head>
  <body>
    <nav class="sss">
      <div class="nav">
        <i class="fa-solid fa-house"></i
        ><a href="http://localhost/projet/p_page/main_p.php">Dashboard</a>
      </div>
      <div class="nav" id="open_p">
        <i class="fa-solid fa-circle-user"></i><a href="#">Employer</a>
      </div>
      <div class="nav">
        <i class="fa-solid fa-user-group"></i
        ><a
          href="http://localhost/projet/gestion%20des%20clients/gestion_client.php"
          >Client</a
        >
      </div>
      <div class="nav">
        <i class="fa-solid fa-clock-rotate-left"></i><a href="http://localhost/projet/delay/delay.php">delay</a>
      </div>
      <div class="nav active">
        <i class="fa-solid fa-box-open"></i><a href="http://localhost/projet/archif/archif.php">archif</a>
      </div>
      <div class="nav">
        <i class="fa-solid fa-coins"></i
        ><a href="http://localhost/projet/payment/payment.php">payment</a>
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
    </nav>
    <aside class="sss"></aside>
    <div class="main">
      <header><h1>liste des affaires</h1></header>
      <div class="mod">
        <div class="search">
          <i class="fa-solid fa-magnifying-glass picon"></i>
          <form action="" method="post" class="text">
            <input
              type="search"
              placeholder="chercher une client"
              class="text"
              name="search"
            />
            <input type="submit" value="" id="s" name="ssubmit" />
          </form>
          <label for="s" class="s_icon"
            ><i class="fa-solid fa-magnifying-glass ss"></i
          ></label>
        </div>
        <div class="selected">
          <div class="s-area">
            <?php if($sss == NULL){ ?>
            Tier par : <span id="choix">choisir le type</span>
            <?php }else{ ?>
            Tier par : <span id="choix"><?php echo $sss?></span>
            <?php } ?>
            <i class="fa-solid fa-chevron-down icon"></i>
          </div>
          <form action="" method="post" class="form">
            <div class="options">
              <input
                type="radio"
                class="input"
                name="select"
                id="plus-ancien"
                value="plus-ancien"
              />
              <label class="option" for="plus-ancien">Plus Ancien</label>
              <input
                type="radio"
                class="input"
                name="select"
                id="dernier"
                value="dernier"
              />
              <label class="option" for="dernier">Dernier Ajouter</label>
            </div>
          </form>
        </div>
        <div class="nb-client">
              <?php echo $num_client['id'];?>
        </div>
      </div>
      <div class="info_assurance">
        <table>
          <tr>
            <th>id</th>
            <th>cin</th>
            <th>matricule</th>
            <th>duree</th>
            <th>date effet</th>
            <th>date echeance</th>
            <th>montant</th>
            <th>date fait</th>
          </tr>
          <?php while ($resultat = $client_info->fetch(PDO::FETCH_ASSOC)) {?>
            <tr>
              <td><?php echo $resultat['N_ATTESTATION']; ?></td>
              <td><?php echo $resultat['CIN_C']; ?></td>
              <td><?php echo $resultat['MATRICULE']; ?></td>
              <td><?php echo $resultat['DUREE']; ?></td>
              <td><?php echo $resultat['DATE_EFFET']; ?></td>
              <td><?php echo $resultat['DATE_ECHEANCE']; ?></td>
              <td><?php echo $resultat['MONTANT']; ?></td>
              <td><?php echo $resultat['DATE_FAIT']; ?></td>
            </tr>
          <?php } ?>
        </table>
      </div>
    </div>
  </body>
  <script>
    let options = document.querySelector(".options");
    let selected = document.querySelector(".selected");
    let icon = document.querySelector(".icon");
    let option = document.querySelectorAll(".input");
    let area = document.querySelector("#choix");
    let form = document.querySelector(".form");
    let op = false;
    selected.addEventListener("click", () => {
      if (op == false) {
        options.style.height = "100px";
        icon.style.transform = "rotateX(180deg)";
        op = true;
      } else {
        options.style.height = "0px";
        icon.style.transform = "";
        op = false;
      }
    });
    option.forEach((o) => {
      o.addEventListener("click", () => {
        area.innerText = o.innerText;
        icon.style.transform = "";
        options.style.height = "100px";
        form.submit();
      });
    });
  </script>
</html>
