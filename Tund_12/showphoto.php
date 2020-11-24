<?php
//require("usersession.php");
require("../../../config.php");
header("Content-type: image/jpeg");
readfile("../photoupload_normal/" .$_REQUEST["photo"]);

$database = "if20_gaspar_lu_1";
$photoid = intval($_REQUEST["photo"]);
	$type = "image/png";
	$output = "../img/wrong.png";
	$conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
	$stmt = $conn->prepare("SELECT filename, userid, privacy FROM vpphotos WHERE vpphotos_id = ? AND deleted IS NULL");
	$stmt->bind_param("i",$photoid);
	$stmt->bind_result($filenamefromdb, $useridfromdb, $privacyfromdb);
	if($stmt->execute()){
		if($stmt->fetch()){
			if($useridfromdb == $_SESSION["userid"] or $privacyfromdb >= 2){
				$output = $photouploaddir_normal .$filenamefromdb;
				$check = getimagesize($output);
				$type = $check["mime"];
			} else {
				$type = "image/png";
				$output = "../img/no_rights.png";
			}
		}
	}
	$stmt->close();
	$conn->close();
	header("Content-type: " .$type);
	readfile($output);
	



