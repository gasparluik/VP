<?php
require("usesession.php");
  //var_dump($_POST);
  require("../../../config.php");
  require("fnc_films.php");
  require("fnc_filmrelations.php");
  
  $database = "if20_gaspar_lu_1";
  
  $inputerror = "";
  //$quotehtml = readquote();
  $quotesavehtml = savequote();
  $notice = "";
  
if(isset($_POST["quotesubmit"])){
	  if (!empty($_POST["quoteinput"])){
		$quote = $_POST["quoteinput"];
		$notice = savequote($quote);
	  } else {
		  $inputerror .= "Palun sisesta tsitaat!";
	  }
}

/* if(isset($_POST["quotesubmit"]) and !empty($_POST["quoteinput"]));{
	$quoteinput = $_POST["quoteinput"];
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	//valmistan ette sql käsu stmt= statement
	$stmt = $conn->prepare("INSERT INTO quote(quote_text) VALUES(?)");
	echo $conn->error;
	//seome käsuga päris andmed
	//i - integer, d - decimal, s - string
	$stmt ->bind_param("s", $_POST["quoteinput"]);
	$stmt->execute();
	$stmt->close();
	$conn->close();
	echo"Olen sisestanud andmebaasi info! ";
} 
if(empty($_POST["quoteinput"])){
	$inputerror.= "Tsitaati pole sisestatud";
}
if(empty($inputerror)){
	echo"Kõik on korras! ";
} */
  require("header.php");
?>
  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  
  <ul>
	<li><a href="?logout=1">Logi välja</a>!</li>
    <li><a href="home.php">Avaleht</a></li>
	<li><a href="listfilms.php">Vaata sisestatud filme</a></li>
  </ul>
  
  <hr>
  
  <form method="POST" action:"<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<label for="quoteinput">tsitaat</label>
	<input type="text" name="quoteinput" id="quoteinput" placeholder="Tsitaat">
	<br>
	<?php
	echo $quotesavehtml = savequote();
	?>
	<input type="submit" name="quotesubmit" value="Salvesta tsitaat">
  </form>
</body>
</html>
