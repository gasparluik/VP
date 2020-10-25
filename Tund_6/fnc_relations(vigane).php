<?php
$database = "if20_gaspar_lu_1";
//var_dump($GLOBALS); php sisse ehitatud väärtus.
//funktsioon mis loeb kõikide filmide info
function readrelations(){
		$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	  //loetleme kõik väljad FROM film
	  $stmt = $conn->prepare("SELECT * FROM film");
	  echo $conn->error;
	  //seome tulemuse muutujaga
	  $stmt->bind_result($titlefromdb, $genrefromdb);
	  $stmt->execute();
	  
	  $filmhtml = "\t <ol> \n";
	  while($stmt->fetch()){
		  $filmhtml .= "\t \t <li>" .$titlefromdb ."\n";
		  $filmhtml .= "\t \t \t <ul> \n";
		  $filmhtml .= "\t \t \t \t <li>Zanr: " .$genrefromdb ."</li> \n";
	  }
	  $filmhtml .= "\t </ol> \n";
	  
	  $stmt->close();
	  $conn->close();
	  return $filmhtml;
}//readrelations lõppeb

function savefilm($titleinput, $genreinput){
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("INSERT INTO film (pealkiri, zanr) VALUES(?,?)");
	echo $conn->error;
	$stmt->bind_param("siisss", $titleinput, $yearinput, $durationinput, $genreinput, $studioinput, $directorinput);
	$stmt->execute();
	$stmt->close();
	 $conn->close();

}//savefilmlõppeb
?>