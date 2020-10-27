<?php

//loen andmebaasist tsitaate
function readquotetoselect($selectedquote){
	$notice = "<p>Kahjuks tsitaate ei leitud!</p> \n";
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT quote_id, quote_text FROM quote");
	echo $conn->error;
	$stmt->bind_result($idfromdb, $quotefromdb);
	$stmt->execute();
	$quotes = "";
	while($stmt->fetch()){
		$quotes .= '<option value="' .$idfromdb .'"';
		if($idfromdb == $selectedquote){
			$quotes .= " selected";
		}
		$quotes .= ">" .$quotefromdb ."</option> \n";
	}
	if(!empty($quotes)){
		$notice = '<select name="quoteinput">' ."\n";
		$notice .= '<option value="" selected disabled>Vali tsitaat</option>' ."\n";
		$notice .= $quotes;
		$notice .= "</select> \n";
	}
	
	/* if($sortby == 0 and $sortorder == 0){
		$stmt = $conn->prepare($SQLsentence);
	}
	if($sortby == 4){
		if($sortorder == 2){
			$stmt = $conn->prepare($SQLsentence ." ORDER BY title DESC");
		} else {
			$stmt = $conn->prepare($SQLsentence ." ORDER BY title");
		}
	}
	
	
	echo $conn->error;
	$stmt->bind_result($firstnamefromdb, $lastnamefromdb, $rolefromdb, $titlefromdb, $quotefromdb);
	$stmt->execute();
	$lines = "";
	while($stmt->fetch()){
		$lines .= "<tr> \n";
		$lines .= "\t <td>" .$firstnamefromdb ." " .$lastnamefromdb ."</td>";
		$lines .= "<td>" .$rolefromdb ."</td>";
		$lines .= "<td>" .$titlefromdb ."</td> \n";
		$lines .= "<td>" .$quotefromdb ."</td> \n";
		$lines .= "</tr> \n";
	}
	if(!empty($lines)){
		$notice = "<table> \n";
		$notice .= "<tr> \n";
		$notice .= '<th>Isiku nimi &nbsp;<a href="?sortby=4&sortorder=1">&uarr;</a> &nbsp;<a href="?sortby=4&sortorder=2">&darr;</a></th>' ."\n";
		
		$notice .= '<th>Roll filmis</th>';
		
		$notice .= '<th>Film &nbsp;<a href="?sortby=4&sortorder=1">&uarr;</a> &nbsp;<a href="?sortby=4&sortorder=2">&darr;</a></th>' ."\n";
		
		$notice .= '<th>Tsitaat filmis</th>';
		
		$notice .= "</tr> \n";
		$notice .= $lines;
		$notice .= "</table> \n";
	}
	 */
	$stmt->close();
	$conn->close();
	return $notice;
}
//tsitaadi ja inimese seos
function storenewquoterelation($selectedperson, $selectedquote){
	$notice = "";
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT quote_id FROM quote WHERE quote_text = ? AND personin_movie_id = ?");
	echo $conn->error;
	$stmt->bind_param("ii", $selectedperson, $selectedquote);
	$stmt->bind_result($idfromdb);
	$stmt->execute();
	if($stmt->fetch()){
		$notice = "Selline seos on juba olemas!";
	} else {
		$stmt->close();
		$stmt = $conn->prepare("INSERT INTO quote (quote_text, person_in_movie_id) VALUES(?,?)");
		echo $conn->error;
		$stmt->bind_param("ii", $selectedperson, $selectedquote);
		if($stmt->execute()){
			$notice = "Uus seos edukalt salvestatud!";
		} else {
			$notice = "Seose salvestamisel tekkis tehniline tõrge: " .$stmt->error;
		}
	}
	
	$stmt->close();
	$conn->close();
	return $notice;
}
