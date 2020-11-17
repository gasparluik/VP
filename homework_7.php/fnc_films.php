<?php
require("../../../config.php");
$database = "if20_gaspar_lu_1";
//var_dump($GLOBALS); php sisse ehitatud väärtus.
//funktsioon mis loeb kõikide filmide info

$quotehtml = "";
$quotesavehtml = null;
$quote = null;

function readfilms(){
		$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	  //loetleme kõik väljad FROM film
	  $stmt = $conn->prepare("SELECT * FROM film");
	  echo $conn->error;
	  //seome tulemuse muutujaga
	  $stmt->bind_result($titlefromdb, $yearfromdb, $durationfromdb, $genrefromdb, $studiofromdb, $directorfromdb);
	  $stmt->execute();
	  
	  $filmhtml = "\t <ol> \n";
	  while($stmt->fetch()){
		  $filmhtml .= "\t \t <li>" .$titlefromdb ."\n";
		  $filmhtml .= "\t \t \t <ul> \n";
		  $filmhtml .= "\t \t \t \t <li>Valmimisaasta: " .$yearfromdb ."</li> \n";
		  $filmhtml .= "\t \t \t \t <li>Kestus minutites: " .$durationfromdb ."minutit</li> \n";
		  $filmhtml .= "\t \t \t \t <li>Zanr: " .$genrefromdb ."</li> \n";
		  $filmhtml .= "\t \t \t \t <li>Tootja/Stuudio: " .$studiofromdb ."</li> \n";
		  $filmhtml .= "\t \t \t \t <li>Lavastaja: " .$directorfromdb ."</li> \n";
		  $filmhtml .= "\t \t \t </ul> \n";
		  $filmhtml .= "\t \t </li> \n";
	  }
	  $filmhtml .= "\t </ol> \n";
	  
	  $stmt->close();
	  $conn->close();
	  return $filmhtml;
}//readfilms lõppeb

function savefilm($titleinput, $yearinput, $durationinput, $genreinput, $studioinput, $directorinput){
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("INSERT INTO film (pealkiri, aasta, kestus, zanr, tootja, lavastaja) VALUES(?,?,?,?,?,?)");
	echo $conn->error;
	$stmt->bind_param("siisss", $titleinput, $yearinput, $durationinput, $genreinput, $studioinput, $directorinput);
	$stmt->execute();
	$stmt->close();
	 $conn->close();

}//savefilmlõppeb

function readquote(){
		$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	  //loetleme kõik väljad FROM quotes
	  $stmt = $conn->prepare("SELECT quote_text FROM quote");
	  echo $conn->error;
	  //seome tulemuse muutujaga
	  $stmt->bind_result($quotefromdb);
	  $stmt->execute();
	  
	  $quotehtml = "\t <ol> \n";
	  while($stmt->fetch()){
		  $quotehtml .= "\t \t <li>" .$quotefromdb ."\n";
		  $quotehtml .= "\t \t \t </ul> \n";
		  $quotehtml .= "\t \t </li> \n";
	  }
	  $quotehtml .= "\t </ol> \n";
	  
	  $stmt->close();
	  $conn->close();
	  return $quotehtml;
}

function savequote($quote){
	echo"olen funktsioonis ";
	$quote = $_POST["quoteinput"];
	
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("INSERT INTO quote(quote_text) VALUES(?)");
	echo"Töötab ?";
	echo $conn->error;
	$stmt->bind_param("s", $quote);
	$stmt->execute();
	$stmt->close();
	 $conn->close();
	 echo"Olen jõudnud savequote lõppu";

}

function readperson(){
		$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
		echo"working";
	  //loetleme kõik väljad FROM person
	  $stmt = $conn->prepare("SELECT first_name, last_name, birth_date FROM person");
	  echo $conn->error;
	  //seome tulemuse muutujaga
	  $stmt->bind_result($firstnamefromdb, $lastnamefromdb, $birthdatefromdb);
	  $stmt->execute();
	  
	  $personhtml = "\t <ol> \n";
	  while($stmt->fetch()){
		  //$personhtml .= "\t \t <li>" .$idfromdb ."\n";
		  $personhtml .= "\t \t <li>" .$firstnamefromdb ."\n";
		  $personhtml .= "\t \t <li>" .$lastnamefromdb ."\n";
		  $personhtml .= "\t \t <li>" .$birthdatefromdb ."\n";
		  $personhtml.= "\t \t \t </ul> \n";
		  $personhtml .= "\t \t </li> \n";
	  }
	  $personhtml .= "\t </ol> \n";
	  
	  $stmt->close();
	  $conn->close();
	  return $personhtml;
}

function saveperson($firstnameinput, $lastnameinput, $birthdayinput, $birthmonthinput = 0){
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("INSERT INTO person (person_id, first_name, last_name, birth_date) VALUES(?,?,?,?)");
	echo $conn->error;
	$stmt->bind_param("issii", $firstnameinput, $lastnameinput, $birthdayinput, $birthmonthinput);
	$stmt->execute();
	$stmt->close();
	 $conn->close();
}