<?php
require("usesession.php");
require("../../../config.php");
require("fnc_films.php");
require("fnc_filmrelations.php");
//require("fnc_quotefilmrelations.php");

$notice = "";
  $selectedfilm = "";
  
  $selectedgenre = "";
  $genrenotice = "";
  
  $studionotice = "";
  $selectedstudio = "";
  
  $selectedperson = "";
  $storenewrelation = "";
  
  //$selectedquote = "";
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
  
  /* $filmselecthtml = readmovietoselect($selectedfilm);
  $filmgenreselecthtml = readgenretoselect($selectedgenre);
  $filmstudioselecthtml = readstudiotoselect($selectedstudio);
  $filmpersonselecthtml = readpersoninmovietoselect($selectedperson);
  $filmquoteselecthtml = readquotetoselect($selectedperson,$selectedquote); */

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
<form method="POST">
	<label for="titleinput">Filmi pealkiri</label>
	<input type="text" name="titleinput" id="titleinput" placeholder="Pealkiri">
	<br>
	<label for="yearinput">Filmi valmimisaasta</label>
	<input type="number" name="yearinput" id="yearinput" value="<?php echo date("Y"); ?>">
	<br>
	<label for="durationinput">Kestus minutites</label>
	<input type="number" name="durationinput" id="durationinput" value="80">
	<br>
	<label for="genreinput">Zanr</label>
	<input type="text" name="genreinput" id="genreinput" placeholder="Zanr">
	<br>
	<label for="studioinput">Filmi tootja/stuudio</label>
	<input type="text" name="studioinput" id="stuidoinput" placeholder="Stuudio">
	<br>
	<label for="directorinput">Filmi lavastaja</label>
	<input type="text" name="directorinput" id="directorinput" placeholder="Lavastaja nimi">
	<br>
	<input type="submit" name="filmsubmit" value="Salvesta filmi info">
  </form>
  <hr>
</body>
</html>