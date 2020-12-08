<?php
require("../../../config.php");
require("fnc_data.php");
require("fnc_common.php");

  $senddata = "";   
  $inputerror = "";


  $notice = "";
  $carnrinputfromdb = "";
  $weightfromdb = null;
  $afterweightfromdb = null;
  $haultypefromdb = "";
  $idfromdb = null;
  $result = "";
  $carselecthtml = "";
  
  $selectedcar = "";


  //kui klikiti submit, siis...
  if(isset($_POST["haulsubmit"])){
    if(empty($_POST["carnrinput"])){
      $inputerror .= "Sisestage auto registrinumber";
  } else {
      $carnnrinputfromdb = test_input($_POST["carnrinput"]);
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
      if($result == 1){
          $notice .= "Salvestatud!";
      } else {
          $inputerror .= "Salvestamisel tekkis torge. " .$result;
      }
  }
}

if(isset($_POST["carsubmit"])){
  if(!empty($_POST["carnrinput"])){
    $selectedcar = intval($_POST["carnrinput"]);
} else {
    $ninputerror .= " Vali masin!";
}
  if(empty($_POST["afterweightinput"])){
    $inputerror .= "Sisestage auto tühimass";
} else {
    $carnnrinputfromdb = test_input($_POST["afterweightinput"]);
}
if(empty($_POST["typeinput"])){
    $inputerror .= "Sisestage kauba nimetus";
} else {
    $weightfromdb = test_input($_POST["typeinput"]);
}
}
if(empty($inputerror)){
  //$senddata = updatedata($selectedcar, $weightfromdb, $haultypefromdb);
  if($result == 1){
      $notice .= "Salvestatud!";
  } else {
      $inputerror .= "Salvestamisel tekkis torge. " .$result;
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
    <input type="text" name="carnrinput" id="carnrinput" placeholder="Number" required echo $inputerror;>
    <br>
    <label for="weightinput">Sisenemismass(kg)</label>
    <input type="number" step="any" name="weightinput" id="weightinput" placeholder="Kaal kilogrammides"required>
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
  <label for="afterweightinput">Lõppkaal laost väljumisel</label>
	  <input type="number" step="any" name="afterweightinput" id="afterweightinput" placeholder="Kaal kilogrammides" required>
  <br>
  <label for="haultype">Koorma nimetus</label>
    <input type="text" name="haultype" id="haultype" placeholder="Kaup">
    <br>
  <input type="submit" name="carsubmit" value="Salvesta">

  </form>
</body>
</html>