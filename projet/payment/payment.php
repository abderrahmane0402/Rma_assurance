<?php
error_reporting(0);
$servername = "localhost";
$username = "abd";
$password = "1234";

try {
    session_start();
    $conn = new PDO("mysql:host=$servername;dbname=rma", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $choice = $_POST['select'];
    $_SESSION['etat'] = 0;
     if($choice == "renouvellement" ||$choice == "remplasement"){
       $cin = $_POST['h-cin'];
       $mat_v = $_POST['mat_v'];
       $result2 = $conn->prepare("SELECT * FROM `vehicule` WHERE MATRICULE = '$mat_v' ");
       $result2->execute();
       $result2 = $result2->fetch(PDO::FETCH_ASSOC);
       $result = $conn->prepare("select * from client where CIN_C = '$cin' ");
       $result->execute();
       $result = $result->fetch(PDO::FETCH_ASSOC);
       $_SESSION['etat'] = 1;
     }else if($choice == "nouvelle voiture"){
       $cin = $_POST['h-cin'];
       $result = $conn->prepare("select * from client where CIN_C = '$cin' ");
       $result->execute();
       $result = $result->fetch(PDO::FETCH_ASSOC);
       $_SESSION['etat'] = 2;
     }else{
       $result = NULL;
       $_SESSION['etat'] = 0;
     }
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
    <link rel="stylesheet" href="payment.css" />
    <link rel="stylesheet" href="../icons/css/all.css" />
    <title>payment</title>
  </head>
  <body>
    <nav class="sss">
      <div class="nav">
        <i class="fa-solid fa-house"></i><a href="http://localhost/projet/p_page/main_p.php">Dashboard</a>
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
      <div class="nav active">
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
    </nav>
    <aside class="sss"></aside>
    <div class="main">
      <header><h1>payer une assurance</h1></header>
      <div class="info">
        <form action="" method="post" id="s-form">
          <div class="info1">
            <input type="text" name="h-cin" id="h-cin" />
            <input type="text" name="mat_v" id="mat_v" />
            <label for="select">type d'assusance</label>
            <select name="select" id="select">
              <option value="vide" id="choisir">
                <?php echo $_POST['select']; ?>
              </option>
              <option value="nouvelle">nouvelle</option>
              <option value="remplasement">remplasement</option>
              <option value="renouvellement">renouvellement</option>
              <option value="nouvelle voiture">nouvelle voiture</option>
            </select>
          </div>
        </form>
      </div>
      <form action="assurer.php" method="post" class="info2">
        <div class="info2_input">
          <div class="boite">
            <span>information du Client</span>
            <div>
              <div>
                <label for="nom">nom:</label>
                <input
                  type="text"
                  name="nom"
                  class="input"
                  value="<?php echo $result['NOM_C'] ?>"
                  required
                />
              </div>
              <div>
                <label for="prenom">prenom:</label>
                <input
                  type="text"
                  name="prenom"
                  class="input"
                  value="<?php echo $result['PRENOM_C'] ?>"
                  required
                />
              </div>
              <div>
                <label for="cin">cin:</label>
                <input
                  type="text"
                  name="cin"
                  class="input"
                  value="<?php echo $result['CIN_C'] ?>"
                  required
                />
              </div>
            </div>
            <div>
              <div>
                <label for="tele">tele:</label>
                <input
                  type="tel"
                  name="tele"
                  class="input"
                  value="<?php echo $result['NUM_TELE']; ?>"
                  required
                />
              </div>
              <div>
                <label for="email">email:</label>
                <input
                  type="email"
                  name="email"
                  class="input"
                  id="email"
                  value="<?php echo $result['EMAIL_C'] ?>"
                  required
                />
              </div>
            </div>
            <div>
              <label for="date_n">date de naissance:</label>
              <input
                type="date"
                name="date_n"
                id="date"
                class="input"
                value="<?php echo $result['DATE_N'] ?>"
                required
              />
            </div>
          </div>
          <div class="boite">
            <span>information du vehicule</span>
            <div>
              <div>
                <label for="type">type de vehicule:</label>
                <input
                  type="text"
                  name="type"
                  class="input"
                  id="type_V"
                  value="<?php echo $result2['TYPE_V'] ?>"
                  required
                />
              </div>
              <div>
                <label for="marque">marque:</label>
                <input
                  type="text"
                  name="marque"
                  class="input"
                  value="<?php echo $result2['MARQUE'] ?>"
                  required
                />
              </div>
            </div>
            <div>
              <div>
                <label for="model">model:</label>
                <input
                  type="number"
                  name="model"
                  class="input"
                  value="<?php echo $result2['MODEL'] ?>"
                  required
                />
              </div>
              <div>
                <label for="carburant">carburant:</label>
                <input type="text" name="carburant" class="input" value="<?php echo $result2['CARBURANT'] ?>" required/>
              </div>
            </div>
            <div>
              <div>
                <label for="mat">matricule:</label>
                <input
                  type="text"
                  name="mat"
                  class="input"
                  value="<?php echo $result2['MATRICULE'] ?>"
                  required
                />
              </div>
              <div>
                <label for="nbrp">nombre de place:</label>
                <input
                  type="number"
                  name="nbrp"
                  class="input"
                  value="<?php echo $result2['NBR_PLACE'] ?>"
                  required
                />
              </div>
            </div>
          </div>
        </div>
        <div class="line"></div>
        <div class="info2_input2">
          <div class="boite">
            <span>information sur l'assurance</span>
            <div>
              <div>
                <label for="duree">duree</label>
                <select name="duree" id="duree" class="input" id="duree">
                  <option value="1">3 mois</option>
                  <option value="2">6 mois</option>
                  <option value="4">12 mois</option>
                </select>
              </div>
            </div>
            <div>
              <div>
                <label for="d-effet">date d'effet</label>
                <input type="datetime-local" name="d-effet" required/>
              </div>
              <div>
                <label for="date-fin">date d'echeance</label>
                <input type="datetime-local" name="date-fin" required/>
              </div>
            </div>
            <div>
              <div>
                <label for="montant">montant</label>
                <input type="text" name="montant" class="input" id="montant" required/>
              </div>
            </div>
          </div>
        </div>
        <input type="submit" value="SAVE" class="submit" name="submit" />
      </form>
    </div>
  </body>
  <script>
    let s_form = document.querySelector("#s-form");
    let selected = document.querySelector("#select");
    let h_cin = document.querySelector("#h-cin");
    let mat_v = document.querySelector("#mat_v");
    selected.addEventListener("change", () => {
      if (
        selected.value == "remplasement" ||
        selected.value == "renouvellement"
      ) {
        h_cin.value = prompt("entrer le cin du client");
        mat_v.value = prompt("entrer le matricule du voiture");
      } else if (selected.value == "nouvelle voiture") {
        h_cin.value = prompt("entrer le cin");
      } else if (selected.value == "nouvelle") {
        h_cin.value = "";
      }
      s_form.submit();
    });

    let montant = document.querySelector("#montant");
    let type_V = document.querySelector("#type_V");
    let duree = document.querySelector("#duree");
    let cyclo_prix = 244,
      auto_prix = 510,
      camion_prix = 1000;
    let calcule_prix = (type, dure) => {
        if (type == "cyclo") {
          return dure * cyclo_prix+"Dh";
        } else if (type == "automobile") {
          return dure * auto_prix+"Dh";
        } else if(type == "camion"){
          return dure * camion_prix +"Dh";
        }else{
        return null;
        }
    };

    montant.value = calcule_prix(type_V.value, 1);
    // if (type_V.value != "") {
    //   if (type_V.value == "cyclo") {
    //     montant.value = cyclo_prix;
    //   } else if (type_V.value == "automobile") {
    //     montant.value = auto_prix;
    //   } else {
    //     montant.value = camion_prix;
    //   }
    // }
    duree.addEventListener("change", () => {
      montant.value = calcule_prix(type_V.value, duree.value);
    });
    type_V.addEventListener("change", () => {
      montant.value = calcule_prix(type_V.value, duree.value);
    });
  </script>
</html>
