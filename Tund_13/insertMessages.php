<?php
require("usesession.php");
require("../../../config.php");
require("fnc_common.php");
require("fnc_message.php");

$countnot = "";
$inputerror = "";
$savemessage = "";
$messageinput = "";
$notice = "";
$count = "";

$selectedemail = "";
$selecteduser = "";
$updatehtml = "";
$result = null;

if(isset($_POST["messagesubmit"])){
	if(!empty($_POST["userinput"])){
	  $selecteduser = test_input($_POST["userinput"]);
	} else {
	  $inputerror .= "vali kasutaja";
	}
	if(empty($_POST["messageinput"])){
	  $inputerror .= "Sisesta sõnum";
	} else {
	  $messageinput = test_input($_POST["messageinput"]);
	}
	if(empty($inputerror)){
		$savemessage = sendmessage($messageinput, $selecteduser);
	  if($result == 1){
		  $notice .= "Salvestatud!";
	  } else {
		$inputerror .= "Salvestamisel tekkis tõrge. " .$updatehtml;
	  }
	}
  }



$userhtml = selectuser($selectedemail);
$countnot = notifications($count);

require("header.php");
?>
<html>
 <head>
  <title>Test leht</title>
  
 </head>
 <body>
 <p>Sisesta sõnumeid ja loe laekunud sõnumeid</p>
 </p>
 <ul>
	<li><a href="?logout=1">Logi välja</a>!</li>
	<br>
	<li><a href="home.php">Tagasi avalehele</a></li>
	<li><a href="viewmessages.php">Loe lugemata sõnumeid</a></li>
	</ul>
	<br>
	<h1>Saada sõnum kasutajale</h1>
	<hr>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<br>
		<label>Vali kasutaja</label>
		<?php
			echo $userhtml;
		?>
		<label>Kirjuta sõnum</label>
		<input type="text" name="messageinput" placeholder="Sisu" required>
		<input type="submit" name="messagesubmit" value="Saada">
		<?php
			echo $updatehtml;
		?>
	</form>
	<hr>
	<?php
		echo "Nii palju on sulle sõnumeid saadetud: " .$countnot;
	?>

 </body>
</html>