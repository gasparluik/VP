<?php
 require ("usesession.php");
  //loeme andmebaasi login ifo muutujad
  require("../../../config.php");
  require("fnc_filmrelations.php");
  
  $notice = "";
  $selectedfilm = "";
  $selectedgenre = "";
  $studionotice = "";
  $selectedstudio = "";
  
  if(isset($_POST["filmstudiorelationsubmit"])){
	  if(!empty($_POST["filmstudioinput"])){
		$selectedfilm = intval($_POST["studioinput"]);
	} else {
		$notice = " Vali film!";
	}
	if(!empty($_POST["filmstudioinput"])){
		$selectedstudio = intval($_POST["filmstudioinput"]);
	} else {
		$notice .= " Vali stuudio!";
	}
	if(!empty($selectedfilm) and !empty($selectedgenre)){
		$studionotice = storenewstudiorelation($selectedfilm, $selectedstudio);
  }
  
  
  if(isset($_POST["filmrelationsubmit"])){
	//$selectedfilm = $_POST["filminput"];
	if(!empty($_POST["filminput"])){
		$selectedfilm = intval($_POST["filminput"]);
	} else {
		$notice = " Vali film!";
	}
	if(!empty($_POST["filmgenreinput"])){
		$selectedgenre = intval($_POST["filmgenreinput"]);
	} else {
		$notice .= " Vali žanr!";
	}
	if(!empty($selectedfilm) and !empty($selectedgenre)){
		$notice = storenewrelation($selectedfilm, $selectedgenre);
	}
  }
  
  $filmselecthtml = readmovietoselect($selectedfilm);
  $filmgenreselecthtml = readgenretoselect($selectedgenre);
  $filmstudioselecthtml = readstudiotoselect($selectedstudio);

  require("header.php");
?>

  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?> programmeerib veebi</h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursusel <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
    
  <ul>
    <li><a href="home.php">Avalehele</a></li>
	<li><a href="?logout=1">Logi välja</a>!</li>
  </ul>
  
  <h2>Määrame filmi stuudio/tootja</h2>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <?php
	echo $filmselecthtml;
	echo $filmstudioselecthtml;
  ?>
  <input type="submit" name="filmrelationsubmit" value="Salvesta seos stuudioga"><span><?php echo $studionotice; ?></span>
   </form>
  <h2>Määrame filmile žanri</h2>
  <hr>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <?php
		echo $filmselecthtml;
		echo $filmgenreselecthtml;
	?>
	
	<input type="submit" name="filmrelationsubmit" value="Salvesta seos žanriga"><span><?php echo $notice; ?></span>
  </form>
  
</body>
</html>
