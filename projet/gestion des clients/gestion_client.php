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
          $client_info = $conn->prepare("SELECT * FROM client WHERE NOM_C LIKE '$search' OR PRENOM_C LIKE '$search' OR DATE_N LIKE '$search' OR CIN_C LIKE '$search' OR EMAIL_C LIKE '$search' OR NUM_TELE LIKE '$search';");
          $client_info->execute();
        }
      }elseif($sss == NULL || $sss == "plus-ancien") {
        $client_info = $conn->prepare("SELECT * FROM client");
        $client_info->execute();
      }elseif($sss == "dernier") {
        $client_info = $conn->prepare("SELECT * FROM `client` ORDER BY ID_C DESC");
        $client_info->execute();
      }elseif($sss == "A-Z") {
        $client_info = $conn->prepare("SELECT * FROM `client` ORDER BY NOM_C");
        $client_info->execute();
      }elseif ($sss == "Z-A") {
        $client_info = $conn->prepare("SELECT * FROM `client` ORDER BY NOM_C DESC");
        $client_info->execute();
      }
      $num_client = $conn->prepare("select count(ID_C) as id from client");
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
    <link rel="stylesheet" href="gestion_clienta.css" />
    <link rel="stylesheet" href="../icons/css/all.css" />
  </head>
  <body>
    <nav class="sss">
      <div class="nav">
        <i class="fa-solid fa-house"></i><a href="http://localhost/projet/p_page/main_p.php">Dashboard</a>
      </div>
      <div class="nav" id="open_p">
        <i class="fa-solid fa-circle-user"></i><a href="#">Employer</a>
      </div>
      <div class="nav active">
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
    </nav>
    <aside class="sss"></aside>
    <div class="main">
      <header><h1>liste des clients</h1></header>
      <div class="mod">
        <div class="search">
          <i class="fa-solid fa-magnifying-glass picon"></i>
          <form action="" method="post" class="text">
            <input type="search" placeholder="chercher une client" class="text" name="search"/>
            <input type="submit" value="" id="s" name="ssubmit">
          </form>
          <label for="s" class="s_icon"><i class="fa-solid fa-magnifying-glass ss"></i></label>
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
                <input
                  type="radio"
                  class="input"
                  name="select"
                  id="A-Z"
                  value="A-Z"
                />
                <label class="option" for="A-Z">Alpha asc</label>
                <input
                  type="radio"
                  name="select"
                  id="Z-A"
                  class="input"
                  value="Z-A"
                />
                <label class="option" for="Z-A">Alpha desc</label>
            </div>
          </form>
        </div>
        <div class="nb-client">
          <?php echo $num_client['id'];?>
        </div>
      </div>
      <form action="drop_line.php" method="post" class="drop_line">
        <input type="text" name="id" class="ssss" id="id">
        <input type="text" name="nom" class="ssss" id="nom">
        <input type="text" name="prenom" class="ssss" id="prenom">
        <input type="text" name="cin" class="ssss" id="cin">
        <input type="tel" name="tele" class="ssss" id="tele">
        <input type="email" name="email"  class="ssss">
        <input type="date" name="date"  class="ssss"/>
      </form>
      <div class="client-info">
          <div class="row title">
            <div class="column id">id</div>
            <div class="column little">nom</div>
            <div class="column little">prenom</div>
            <div class="column little">cin</div>
            <div class="column little">phone</div>
            <div class="column email">email</div>
            <div class="column date">date naissance</div>
            <div><i class="fa-solid fa-pen modify" title="modify"></i></div>
            <div><i class="fa-solid fa-trash-can modify" title="supprimer"></i></div>
          </div>
          <?php while ($resultat = $client_info->fetch(PDO::FETCH_ASSOC)) {?>
          <form action="save_change.php" method="post" class="save_change">
          <div class="row">
              <div class="column id"><input class="change_uinfo" type="text" name="id" value="<?php echo $resultat['ID_C']; ?>" readonly></div>
              <div class="column little"><input class="change_uinfo" type="text" name="nom" value="<?php echo $resultat['NOM_C']; ?>" readonly></div>
              <div class="column little"><input class="change_uinfo" type="text" name="prenom" value="<?php echo $resultat['PRENOM_C']; ?>" readonly></div>
              <div class="column little"><input class="change_uinfo" type="text" name="cin" value="<?php echo $resultat['CIN_C']; ?>" readonly></div>
              <div class="column little"><input class="change_uinfo" type="tel" name="tele" value="<?php echo $resultat['NUM_TELE']; ?>" readonly></div>
              <div class="column email"><input class="change_uinfo" type="email" name="email" value="<?php echo $resultat['EMAIL_C']; ?>" readonly></div>
              <div class="column date"><input class="change_uinfo" type="text" name="date" value="<?php echo $resultat['DATE_N']; ?>" readonly></div>
              <div class="modifier"><i class="fa-solid fa-pen" title="modify"></i></div>
              <div class="sup"><i class="fa-solid fa-trash-can" title="supprimer"></i></div>
          </div>
          </form>
          <?php } ?>
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
        options.style.height = "188px";
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
        options.style.height = "188px";
        form.submit();
      });
    });





    let save_change = document.querySelectorAll(".save_change");
    let delete_input = document.querySelectorAll(".ssss");
    let dropline = document.querySelector(".drop_line");
    save_change.forEach((f)=>{
      f.querySelectorAll(".change_uinfo").forEach((i)=>{
        i.addEventListener("dblclick" , ()=>{
          i.removeAttribute("readonly");
        });
        i.addEventListener("focusout" , ()=>{
          i.setAttribute("readonly" , "");
        });
      });
      f.querySelectorAll(".modifier").forEach((m) => {
        m.addEventListener("click", () => {
          x = confirm("confimer la modification");
          if(x){
            f.submit();
          }
        });
      });
      f.querySelectorAll(".sup").forEach((s) => {
        s.addEventListener("click", () => {
          y = confirm("confimer la suprission");
          if(y){
            let input = f.querySelectorAll(".change_uinfo");
            for(let j=0;j<7;j++){
              delete_input[j].value = input[j].value;
            }
            dropline.submit();
          }
        });
      });
    });

    // let dropline = document.querySelector(".drop_line");
    // let save_change = document.querySelector(".save_change");
    // let modify = document.querySelectorAll(".modifier");
    // let suprimer = document.querySelectorAll(".sup");
    // let inputs = document.querySelectorAll(".change_uinfo");
    // let save_input = document.querySelectorAll(".dddd");
    // let delete_input = document.querySelectorAll(".ssss");
    // let x , y;
    /*modify.forEach((m) => {
      m.addEventListener("click", () => {
        x = confirm("confimer la modification");
        if(x){
          for(i=0;i<7;i++){
            save_input[i].value = inputs[i].value;
          }
          save_change.submit();
        }
      });
    });
    suprimer.forEach((s) => {
      s.addEventListener("click", () => {
        y = confirm("confimer la suprission");
        if(y){
          for(let j=0;j<7;j++){
            delete_input[j].value = inputs[j].value;
          }
          dropline.submit();
        }
      });
    });
    inputs.forEach((i)=>{
      i.addEventListener("dblclick" , ()=>{
        i.removeAttribute("readonly");
      });
      i.addEventListener("focusout" , ()=>{
        i.setAttribute("readonly" , "");
      });
    });*/
  </script>
</html>
