<?php
require("../../../config.php");
require("fnc_data.php");
require("fnc_common.php");

  $senddata = "";
  $sendupdate = "";   
  $inputerror = "";


  $notice = "";
  $carnrinputfromdb = "";
  $weightfromdb = null;
  $afterweightfromdb = null;
  $haultypefromdb = "";
  $idfromdb = null;
  $sendupdate = "";
  $carselecthtml = "";
  
  $selectedcar = "";


  //kui klikiti submit, siis...
  if(isset($_POST["haulsubmit"])){
    if(empty($_POST["carnrinput"])){
      $inputerror .= "Sisestage auto registrinumber";
  } else {
      $carnrinputfromdb = test_input($_POST["carnrinput"]);
  }
  if(empty($_POST["weightinput"])){
      $inputerror .= "Sisestage auto sisenemismass";
  } else {
      $weightfromdb = test_input($_POST["weightinput"]);
  }
  if(!empty($_POST["afterweightinput"])){
      $afterweightfromdb = test_input($_POST["afterweightinput"]);
  }
  if(!empty($_POST["typeinput"])){
      $haultypefromdb = test_input($_POST["typeinput"]);
  }
  if(empty($inputerror)){
      $senddata = savehaul($weightfromdb, $afterweightfromdb, $carnrinputfromdb, $haultypefromdb);
      if($sendupdate == 1){
          $notice .= "Salvestatud!";
      } else {
          $inputerror .= "Salvestamisel tekkis torge. " .$sendupdate;
      }
  }
}

if(isset($_POST["carsubmit"])){
  if(!empty($_POST["carnrinput"])){
    $selectedcar = test_input($_POST["carnrinput"]);
  } else {
    $inputerror .= "Vali andmebaasist kaalumata auto!";
  }
  if(empty($_POST["afterweightinput2"])){
    $inputerror .= "Sisestage auto tühimass";
  } else {
    $afterweightfromdb = test_input($_POST["afterweightinput2"]);
  }
  if(empty($_POST["haultype2"])){
      $inputerror .= "Sisestage kauba nimetus";
  } else {
      $haultypefromdb = test_input($_POST["haultype2"]);
  }
  if(empty($inputerror)){
    $sendupdate = updatedata($selectedcar, $afterweightfromdb, $haultypefromdb);
    if($sendupdate == 1){
        $notice .= "Salvestatud!";
    } else {
        $inputerror .= "Salvestamisel tekkis torge. " .$sendupdate;
    }
  }
}

$carselecthtml = readhaulstoselect($selectedhaul);

  require("header.php");
?>
  <p></p>
  
  <ul>
	<li><a href="listhauls.php">Kokkuvõte</a></li>
  </ul>
  
  <hr>
  <label>Sisesta veose andmed</label>
  <hr>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="carnrinput">Auto registrinumber</label>
    <input type="text" name="carnrinput" id="carnrinput" placeholder="Number" required>
    <br>
    <label for="weightinput">Sisenemismass(kg)</label>
    <input type="number" step="any" name="weightinput" id="weightinput" placeholder="Kaal kilogrammides" required>
    <br>
    <label for="afterweightinput">Lõppkaal laost väljumisel</label>
    <input type="number" step="any" name="afterweightinput" id="afterweightinput" placeholder="Kaal kilogrammides">
    <br>
    <label for="haultype">Koorma nimetus</label>
    <input type="text" name="haultype" id="haultype" placeholder="Kaup">
    <br>
    <input type="submit" name="haulsubmit" value="Salvesta viljaveo andmed">
  </form>
  <br>
    <?php
      echo $inputerror;
      echo $notice;
    ?>
  <br>
  <hr>


  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label>Vali veos</label>
    <?php
      echo $carselecthtml;
    ?>
  <br>
  <label for="afterweightinput2">Lõppkaal laost väljumisel</label>
	  <input type="number" step="any" name="afterweightinput2" id="afterweightinput2" placeholder="Kaal kilogrammides" required>
  <br>
  <label for="haultype2">Koorma nimetus</label>
    <input type="text" name="haultype2" id="haultype2" placeholder="Kaup">
    <br>
  <input type="submit" name="carsubmit" value="Salvesta">
  <br>
    <?php
      echo $inputerror;
      echo $notice;
      echo $sendupdate;
    ?>
  <br>
  </form>
</body>
</html>