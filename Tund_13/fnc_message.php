<?php
require("fnc_user.php");
$database = "if20_gaspar_lu_1";

//sõnumi sisestamine
function sendmessage($messageinput, $selecteduser){
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("INSERT INTO messages(content, useremail) VALUES(?,?)");
    echo $conn->error;
    $stmt ->bind_param("ss", $messageinput, $selecteduser);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    echo "Sendmessage lõpp";
}

//Vali kasutaja andmebaasist
$selectedemail = "";
function selectuser($selectedemail){
	$notice = "<p>Kahjuks veoseid ei leitud!</p> \n";
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT vpusers_id, email FROM vpusers");
	echo $conn->error;
	$stmt->bind_result($idfromdb, $selecteduser);
	$stmt->execute();
	$users = "";
	while($stmt->fetch()){
		$users .= '<option value="' .$idfromdb .'"';
		if($idfromdb == $selectedemail){
			$users .= " selected";
		}
		$users .= ">" .$selecteduser ."</option> \n";
	}
	if(!empty($users)){
		$notice = '<select name="userinput">' ."\n";
		$notice .= '<option value=""selected disabled>Vali kasutaja</option>' ."\n";
		$notice .= $users;
		$notice .= "</select> \n";
	}
	
	$stmt->close();
	$conn->close();
	return $notice;
}

//loetle sõnumeid
function readmessages($sortby, $sortorder){
	$notice = "<p>Kahjuks ei leidnud sõnumeid.</p>";
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$sql = "SELECT useremail, content FROM messages";
	if($sortby == 0){
		$stmt = $conn->prepare($sql);
	}
	if($sortby == 4){
		if($sortorder == 1){
			$stmt = $conn->prepare($sql ." ORDER BY useremail");
		} else {
			$stmt = $conn->prepare($sql ." ORDER BY useremail DESC");
		}
	}
	
	echo $conn->error;
	$stmt->bind_result($messageinput, $selecteduser);
	$stmt->execute();
	$lines = "";

	while($stmt->fetch()){
		$lines .= "<tr> \n";
        $lines .= "\t <td>" .$messageinput ."</td>";
        $lines .= "\t <td>" .$selecteduser ."</td>";
		$lines .= "</tr> \n";
	}
	if(!empty($lines)){
		$notice = "<table> \n";
		$notice .= "<tr> \n";
        //$notice .= "<th>Isik</th>";
        $notice .= "<th>Email</th>";
		$notice .= '<th>Sõnum &nbsp; <a href="?sortby=4&sortorder=1">&uarr;</a> &nbsp; <a href="?sortby=4&sortorder=2">&darr;</a></th>' ."\n";
		$notice .= "</tr> \n";
		$notice .= $lines;
		$notice .= "</table> \n";
	}
	$stmt->close();
	$conn->close();
	return $notice;
}

// Mitu sõnumit on

function notifications($count){
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT COUNT(useremail) FROM messages WHERE useremail = 14 ");
    echo $conn->error;
    $stmt ->bind_result($count);
    $stmt->execute();
    $stmt->close();
    $conn->close();


}
?>
