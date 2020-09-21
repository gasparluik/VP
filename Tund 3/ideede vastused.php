<?php
require("../../../config.php");
//loen lehele kõik olemasolevad mõtted
	$conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
	$stmt = $conn->prepare("SELECT idea FROM myideas");
	echo $conn->error;
	//Seome tulemuse muutujaga
	$stmt->bind_result($ideafromdb);
	$stmt->execute();
	$ideahtml = "";
	while($stmt->fetch()){
		$ideahtml .="<p>" .$ideafromdb ."</p>";
	}
	$stmt->close();
	$conn->close();
<?
<!DOCTYPE>
<html>
 <head>
  <title>Test leht</title>
 </head>
 <body>
 <p>Tere tere!. Siia tuleb küsimustiku vastused!</p>
 <p> Aadress tagasi kodulehele <a href="http://greeny.cs.tlu.ee/~gasplui/VP/Tund%203/home.php" > </p> 
 </body>
</html>