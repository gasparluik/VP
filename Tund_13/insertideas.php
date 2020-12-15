<?php
require("usesession.php");

//var_dump($_POST);
	require("../../../config.php");
	$database = "if20_gaspar_lu_1";
	//kui on idee sisestatud ja nuppu vajutatud, salvestame selle andmebaasi
	if(isset($_POST["ideasubmit"]) and !empty($_POST["ideainput"])){
		
	$conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
	//valmistan ette sql käsu stmt= statement
	$stmt = $conn->prepare("INSERT INTO myideas(idea) VALUES(?)");
	echo $conn->error;
	//seome käsuga päris andmed
	//i - integer, d - decimal, s - string
	$stmt ->bind_param("s", $_POST["ideainput"]);
	$stmt->execute();
	$stmt->close();
	$conn->close();

	}
?>
<!DOCTYPE>
<html>
 <head>
  <title>Test leht</title>
 </head>
 <body>
 <p>Tere tere!. Siia tuleb küsimustik!</p>
 <p> Aadress tagasi kodulehele <a href="http://greeny.cs.tlu.ee/~gasplui/VP/Tund%203/home.php" > </p>
 <ul>
	<li><a href="?logout=1">Logi välja</a>!</li>
	<br>
	<li><a href="home.php">Tagasi avalehele</a></li>
	<li><a href="listideas.php">Loe oma mõtteid</a></li>
	</ul>
	
	<hr>


	<form method="POST">
		<label>Sisesta oma pähe tulnud mõte!</label>
		<input type="text" name="ideainput" placeholder="Kirjuta siia mõte!">
		<input type="submit" name="ideasubmit" value="Saada mõte ära!">
	</form>
	<hr>

 </body>
</html>