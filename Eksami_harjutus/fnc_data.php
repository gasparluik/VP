<?php
$database = "if20_gaspar_lu_1";

//Kuvan sisestatud veosed ja sorteerin
function readhauls($sortby, $sortorder){
	$notice = "<p>Kahjuks ei leidnud vedusi.</p>";
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$sql = "SELECT carnumber, weight - afterweight, haultype FROM haul_data";
	if($sortby == 0){
		$stmt = $conn->prepare($sql);
	}
	if($sortby == 4){
		if($sortorder == 1){
			$stmt = $conn->prepare($sql ." ORDER BY carnumber");
		} else {
			$stmt = $conn->prepare($sql ." ORDER BY carnumber DESC");
		}
	}
	
	echo $conn->error;
	$stmt->bind_result($carnrinputfromdb, $weightfromdb, $haultypefromdb);
	$stmt->execute();
	$lines = "";

	while($stmt->fetch()){
		$lines .= "<tr> \n";
		$lines .= "\t <td>" .$carnrinputfromdb ."</td>";
		$lines .= "\t <td>" .round($weightfromdb, 3) ."kg"."</td>";
		$lines .= "\t <td>" .$haultypefromdb ."</td>";
		$lines .= "</tr> \n";
	}
	if(!empty($lines)){
		$notice = "<table> \n";
		$notice .= "<tr> \n";
		//$notice .= "<th>Isik</th>";
		$notice .= "<th>Registrinumber</th>" ."\n";
		$notice .= "<th>Veo kogus </th>" ."\n";
		$notice .= '<th>Kauba nimetus &nbsp; <a href="?sortby=4&sortorder=1">&uarr;</a> &nbsp; <a href="?sortby=4&sortorder=2">&darr;</a></th>' ."\n";
		$notice .= "</tr> \n";
		$notice .= $lines;
		$notice .= "</table> \n";
	}
	$stmt->close();
	$conn->close();
	return $notice;
}

//Salvestan saabunud veosed
function savehaul($weightfromdb, $afterweightfromdb, $carnrinputfromdb, $haulhaultypefromdb){
	//$count= ("SELECT haul_id, (weight - afterweight) as count FROM haul_data");
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("INSERT INTO haul_data (weight, afterweight, carnumber, haultype) VALUES(?,?,?,?)");
	echo $conn->error;
	$stmt->bind_param("ddss", $_POST["weightinput"],$_POST["afterweightinput"], $_POST["carnrinput"], $_POST["haulhaultype"]);
	$stmt->execute();
	$stmt->close();
	$conn->close();
	echo "Savehaul lõpetatud";

}//savehaullõppeb

//Valin juba saabunud veosed
$selectedhaul = "";

function readhaulstoselect($selectedhaul){
	$notice = "<p>Kahjuks veoseid ei leitud!</p> \n";
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT haul_id, carnumber  FROM haul_data WHERE haultype IS NULL");
	//ei saa teha WHERE afterweight AND typehaul IS NULL, sest andmebaasis jääb alati tühja afterweighti väärtuseks 0.000
	echo $conn->error;
	$stmt->bind_result($idfromdb, $carnrinputfromdb);
	$stmt->execute();
	$hauls = "";
	while($stmt->fetch()){
		$hauls .= '<option value="' .$idfromdb .'"';
		if($idfromdb == $selectedhaul){
			$hauls .= " selected";
		}
		$hauls .= ">" .$carnrinputfromdb ."</option> \n";
	}
	if(!empty($hauls)){
		$notice = '<select name="carnrinput">' ."\n";
		$notice .= '<option value=""selected disabled>Vali autonumber</option>' ."\n";
		$notice .= $hauls;
		$notice .= "</select> \n";
	}
	
	$stmt->close();
	$conn->close();
	return $notice;
}

function updatedata($selectedcar, $afterweightfromdb, $haulhaultypefromdb){
	$notice = null;
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("UPDATE haul_data SET afterweight = ?, haultype = ? WHERE haul_id = ?");
	echo $conn->error;
	$stmt->bind_result($afterweightfromdb, $haulhaultypefromdb, $selectedcar);
	if($stmt->execute()){
		$notice ="Kõik on korras!";
	} else{
		$notice = $conn->error;
	}
	$stmt->close();
	$conn->close();
	return $notice;

}
?>