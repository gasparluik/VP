<?php
	//var_dump($_POST);
	require("../../../config.php");
	$database = "if20_gaspar_lu_1";
	//kui on idee sisestatud ja nuppu vajutatud, salvestame selle andmebaasi
	if(isset($_POST["ideasubmit"]) and !empty($_POST["ideainput"]));{
		
	$conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
	//valmistan ette sql käsu stmt= statement
	$stmt = $conn->prepare("INSERT INTO myideas
	(idea) VALUES(?)");
	echo $conn->error;
	//seome käsuga päris andmed
	//i - integer, d - decimal, s - string
	$stmt ->bind_param("s", $_POST["ideainput"]);
	$stmt->execute();
	$stmt->close();
	$conn->close();
	}
	
	//loen lehele kõik olemasolevad mõtted
	$conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
	$stmt = $conn->prepare("SELECT idea FROM myideas");
	echo $conn->error;
	//Seome tulemuse muutujaga
	$stmt->bind_result($ideafromdb);
	$stmt->execute();
	$ideahtml = "";
	while($stmt->fetch()){
		$ideahtml .="<p>" .$ideafromdb ."</p>";
	}
	$stmt->close();
	$conn->close();
	
	
	$username = "Gaspar Luik";
	$fulltimenow = date("d.m.Y H:i:s");
	$hournow = date("H");
	$partofday = "lihtsalt aeg";
	$weekdaynameset = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
	$monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
	//echo $weekdaynameset;
	//var_dump($weekdaynameset);
	$weekdaynow = date("N");
	echo $weekdaynow;
	if($hournow < 6) {
		$partofday = "uneaeg";
	}//enne 6
	if($hournow >= 8 and $hournow <= 16) {
		$partofday = "õppimise aeg";
	}
	if($hournow >= 17 and $hournow <= 18) {
		$partofday = "trenn";
	}
	if($hournow >= 18 and $hournow <= 19) {
		$partofday = "Transport koju";
	}
	if($hournow >= 19 and $hournow <= 20) {
		$partofday = "teen süüa";
	}
	
	//vaatame semestri kulgemist
	$semesterstart = new DateTime("2020-8-31");
	$semesterend = new DateTime("2020-12-13");
	$semesterduration = $semesterstart->diff ($semesterend);
	$semesterdurationdays = $semesterduration->format ("%r%a");
	$today = new DateTime ("now");
	$semesterpassed = $semesterstart->diff($today)->format("%r%a");
	$semesterpercent = $semesterpassed * 100 / $semesterdurationdays;
	if($semesterstart < $today){
		$semesterstatus = " on alanud";
	}
	if($semesterstart > $today){
		$semesterstatus = "semester pole alanud";	
	}
	//annan ette lubatud pildivormingute loendi
	$picfiletypes = ["image/jpeg", "image/png"];
	//loeme piltide kataloogi sisu ja näitame pilte
	$allfiles = array_slice(scandir("../vp_pics/"), 2);
	//var_dump($allfiles)
	//$picfiles = array_slice($allfiles, 2);
	$picfiles = [];
	//var_dump($picfiles);
	foreach($allfiles as $thing){
		$fileinfo =  getImagesize("../vp_pics/" .$thing);
		if(in_array($fileinfo["mime"], $picfiletypes) == true){	
			array_push($picfiles, $thing);
		}
	}
	//paneme kõik pildid ekraanile
	$piccount = count($picfiles);
	$imghtml = "";
	//<img src="../vp_pics/failinimi.png" alt="tekst">
	for($i = 0; $i < $piccount; $i ++){
		$imghtml .= '<img src ="../vp_pics/' .$picfiles[$i] .'" ';
		$imghtml .= 'alt="Tallinna Ülikool">';
	}
	//$i= $i + 1;
	//$i ++;
	//$i += 2; ehk kasvata nii palju ehk 2
	//<img src="../vp
	require("header.php");
?>

	<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursese bänner">
	<h1><?php echo $username; ?></h1>
	<p>See  veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
	<p>See konkreetne leht on loodud veebiprogrammeerimise kursusel lehel <a href="https://www.tlu.ee"> Tallinna Ülikooli </a> Digitehnoloogiate instituudis.</p>
	<p>Lehe avamise hetk: <?php echo $weekdaynameset [$weekdaynow - 1].", " .$fulltimenow; ?>.</p>
	<p><?php echo "Praegu on " .$partofday ."."; ?></p>

	<p><?php echo "Semester" .$semesterstatus .".";?></p>
	<p><?php echo "Semester on käinud " .$semesterpassed ." päeva"; ?></p>
	<p><?php echo "Semestrist on läbitud " .$semesterpercent ."%"; ?></p>
	<hr>
	<?php echo $imghtml; ?>
	<hr>
	<form method="POST">
		<label>Sisesta oma pähe tulnud mõte!</label>
		<input type="text" name="ideainput" placeholder="Kirjuta siia mõte!">
		<input type="submit" name="ideasubmit" value="Saada mõte ära!">
	</form>
	<hr>
	<?php echo $ideahtml; ?>
</body>
</html>