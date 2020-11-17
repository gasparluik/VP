<?php
 require ("usesession.php");
  //loeme andmebaasi login ifo muutujad
  require("../../../config.php");
  require("fnc_filmrelations.php");
  
  $notice = "";
  $selectedfilm = "";
  
  $selectedgenre = "";
  $genrenotice = "";
  
  $studionotice = "";
  $selectedstudio = "";
  
  $selectedperson = "";
  $storenewrelation = "";
  
  $selectedquote = "";
  $quotenotice = "";
  
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
  }
  
  
  if(isset($_POST["filmpersonrelationsubmit"])){
	//$selectedfilm = $_POST["filminput"];
	if(!empty($_POST["filminput"])){
		$selectedfilm = intval($_POST["filminput"]);
	} else {
		$notice = " Vali film!";
	}
	if(!empty($_POST["filmpersoninput"])){
		$selectedperson = intval($_POST["filmpersoninput"]);
	} else {
		$notice .= " Vali inimene!";
	}
	if(!empty($selectedfilm) and !empty($selectedperson)){
		$notice = storenewrelation($selectedfilm, $selectedperson);
	}
  }
  
  
  if(isset($_POST["filmgenrerelationsubmit"])){
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
		$genrenotice = storenewgenrerelation($selectedfilm, $selectedgenre);
	}
  }
  
  if(isset($_POST["filmquoterelationsubmit"])){
	  if(!empty($_POST["filminput"])){
	  $selectedfilm = intval($_POST["filminput"]);
	  } else {
		  $quotenotice = " Vali film!";
	  }
	  if(!empty($_POST["filmquoteinput"])){
		  $selectedquote = intval($_POST["filmquoteinput"]);
	  } else {
		  $quotenotice = " Vali tsitaat!";
	  }
	  if(!empty($selectedfilm) and !empty($selectedquote)){
		  $quotenotice = storenewquoterelation($selectedfilm, $selectedquote);
	  }
  }
  
  $filmselecthtml = readmovietoselect($selectedfilm);
  $filmgenreselecthtml = readgenretoselect($selectedgenre);
  $filmstudioselecthtml = readstudiotoselect($selectedstudio);
  $filmpersonselecthtml = readpersoninmovietoselect($selectedperson);
  $filmquoteselecthtml = readquotetoselect($selectedquote);

  require("header.php");
?>

  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?> programmeerib veebi</h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursusel <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
    
  <ul>
    <li><a href="home.php">Avalehele</a></li>
	<li><a href="?logout=1">Logi välja</a>!</li>
	 <li><a href="listfilmpersons.php">Kuva inimesed filmidest jne</a></li>
  </ul>
  
  <h2>Määrame filmi stuudio/tootja</h2>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<?php
		echo $filmselecthtml;
		echo $filmstudioselecthtml;
	?>
  
  <input type="submit" name="filmstudiorelationsubmit" value="Salvesta seos stuudioga"><span><?php echo $studionotice; ?></span>
   </form>
  <h2>Määrame filmile žanri</h2>
  <hr>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <?php
		echo $filmselecthtml;
		echo $filmgenreselecthtml;
	?>
	
	<input type="submit" name="filmgenrerelationsubmit" value="Salvesta seos stuudioga"><span><?php echo $studionotice; ?></span>
   </form>
  <h2>Määrame filmile näitleja/rešišööri</h2>
  <hr>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <?php
		echo $filmselecthtml;
		echo $filmpersonselecthtml;
	?>
	
	<input type="submit" name="filmpersonrelationsubmit" value="Salvesta nimi filmiga"><span><?php echo $notice; ?></span>
  </form>
  <hr>
  <h2>Määrame filmile tsitaadi</h2>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <?php
		echo $filmselecthtml;
		echo $filmquoteselecthtml;
	?>
	
	<input type="submit" name="filmquoterelationsubmit" value="Salvesta seos tsitaadiga"><span><?php echo $quotenotice; ?></span>
  </form>
</body>
</html>