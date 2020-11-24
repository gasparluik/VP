<?php
	$database = "if20_gaspar_lu_1";
	
	function storenews($newstitle, $news){
		$notice = null;
		$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
		$stmt = $conn->prepare("INSERT INTO vpnews (userid, title, content) VALUES (?, ?, ?)");
		echo $conn->error;
		$stmt->bind_param("iss", $_SESSION["userid"], $newstitle, $news);
		if($stmt->execute()){
			$notice = 1;
			echo "töötab";
		} else {
			$notice = 0;
			echo "ei tööta";
	}
		$stmt->close();
		$conn->close();
		return $notice;
}