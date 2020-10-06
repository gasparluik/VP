<?php
$database = "if20_gaspar_lu_1";

function signup($firstname, $lastname, $email, $gender, $birthdate, $password) {
	$notice = "";
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("INSERT INTO vpusers (firstname, lastname, birthdate, gender, email, password) VALUES(?,?,?,?,?,?)");
	echo $conn->error;
	
	//krüpteerime salasõna ([] tähendab et tegu on massiiviga)
	$options = ["cost" => 12, "salt" => substr(sha1(rand()), 0, 22)]; // subst ehk 0->22 esimesed arvud; sha1->annab kõik tähem'rgid võimalikeks arvudeks
	$pwdhash = password_hash(@password, PASSWORD_BCRYPT, $options); //password_bcrypt on algorütm
	
	//järgneva koodi järjekord väga tähtis
	$stmt->bind_param("sssiss", $firstname, $lastname, $birthdate, $gender, $email , $pwdhash );
	
	if($stmt->execute()){
		$notice = "ok";
	} else {
		$notice = $stmt->error;
	}
	$stmt->close();
	$conn->close();
	return $notice;
}

function signin($email, $password){
	$notice = null;
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT password FROM vpusers WHERE email = ?");
	echo $conn->error;
	$stmt->bind_param("s", $email);
	$stmt->bind_result($passwordfromdb);
	
	if($stmt->execute()){
		//kui tehniliselt korras
		if($stmt->fetch()){
			//kasutaja leiti
			if(password_verify($password, $passwordfromdb)) {
				//parool õige
				$stmt->close();
				//loen sisseloginud kasutaja infot
				$stmt = $conn->prepare("SELECT vpusers_id, firstname, lastname FROM vpusers WHERE email = ?");
				echo $conn->error;
				$stmt->bind_param("s", $email);
				$stmt->bind_result($idfromdb, $firstnamefromdb, $lastnamefromdb);
				$stmt->execute();
				$stmt->fetch();
				//salvestame sessiooni muutujad
				$_SESSION["userid"] = $idfromdb;
				$_SESSION["userfirstname"] = $firstnamefromdb;
				$_SESSION["userlastname"] = $lastnamefromdb;
				
				$stmt->close();
				$conn->close();
				header("Location: home.php");
				exit();
			} else {
				$notice = "Vale salasõna!";
			}
		} else {
			$notice = "Sellist kasutajat (" .$email .") ei leitud ";
		 }
	} else {
		//tehniline viga
		$notice = $stmt->error;
	}
	$stmt->close();
	$conn->close();
	return $notice;
	}
//valideerime emaili
function validate($email){
	//eemalda keelatud tähede emailist
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	//valideeri
	if (!filter_var($email, FILTER_SANITIZE_EMAIL) ===false){
		echo("$email on reaalne emailiaadress");
	}else {
		echo("$email ei ole reaalne emailiaadress");

	}
}