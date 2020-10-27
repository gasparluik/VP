<?php
function readmovietoselect($selectedfilm){
	$notice = "<p>Kahjuks filme ei leitud!</p> \n";
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT movie_id, title FROM movie");
	echo $conn->error;
	$stmt->bind_result($idfromdb, $titlefromdb);
	$stmt->execute();
	$films = "";
	while($stmt->fetch()){
		$films .= '<option value="' .$idfromdb .'"';
		if(intval($idfromdb) == $selectedfilm){
			$films .=" selected";
		}
		$films .= ">" .$titlefromdb ."</option> \n";
	}
	if(!empty($films)){
		$notice = '<select name="filminput">' ."\n";
		$notice .= '<option value="" selected disabled>Vali film</option>' ."\n";
		$notice .= $films;
		$notice .= "</select> \n";
	}
	$stmt->close();
	$conn->close();
	return $notice;
}

function readpersoninmovietoselect($selectedperson){
	$notice = "<p>Kahjuks nime ei leitud!</p> \n";
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT person_id, first_name, '' last_name FROM person");
	echo $conn->error;
	$stmt->bind_result($idfromdb, $firstnamefromdb, $lastnamefromdb);
	$stmt->execute();
	$persons = "";
	while($stmt->fetch()){
		$persons .= '<option value="' .$idfromdb .'"';
		if($idfromdb == $selectedperson){
			$persons .= " selected";
		}
		$persons .= ">" .$lastnamefromdb  .$firstnamefromdb ."</option> \n";
	}
	if(!empty($persons)){
		$notice = '<select name="personinput">' ."\n";
		$notice .= '<option value="" selected disabled>Vali inimene</option>' ."\n";
		$notice .= $persons;
		$notice .= "</select> \n";
	}
	
	$stmt->close();
	$conn->close();
	return $notice;
}

function readpersonsinfilm($sortby, $sortorder){
	$notice = "<p>Kahjuks filmitegelasi seoses filmidega ei leitud!</p> \n";
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$SQLsentence = "SELECT first_name, last_name, role, title FROM person JOIN person_in_movie ON person.person_id = person_in_movie.person_id JOIN movie ON movie.movie_id = person_in_movie.movie_id";
	
	if($sortby == 0 and $sortorder == 0){
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
	$stmt->bind_result($firstnamefromdb, $lastnamefromdb, $rolefromdb, $titlefromdb);
	$stmt->execute();
	$lines = "";
	while($stmt->fetch()){
		$lines .= "<tr> \n";
		$lines .= "\t <td>" .$firstnamefromdb ." " .$lastnamefromdb ."</td>";
		$lines .= "<td>" .$rolefromdb ."</td>";
		$lines .= "<td>" .$titlefromdb ."</td> \n";
		$lines .= "</tr> \n";
	}
	if(!empty($lines)){
		$notice = "<table> \n";
		$notice .= "<tr> \n";
		$notice .= "<th>Isiku nimi</th><th>Roll filmis</th>";
		$notice .= '<th>Film &nbsp;<a href="?sortby=4&sortorder=1">&uarr;</a> &nbsp;<a href="?sortby=4&sortorder=2">&darr;</a></th>' ."\n";
		$notice .= "</tr> \n";
		$notice .= $lines;
		$notice .= "</table> \n";
	}
	
	$stmt->close();
	$conn->close();
	return $notice;
}


function storenewpersoninfilmrelation($selectedfilm, $selectedperson){
	
}