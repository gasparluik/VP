<?php
	$username = "Gaspar Luik";
	$fulltimenow = date("d.m.Y H:i:s");
	$hournow = date("H");
	$partofday = "lihtsalt aeg";
	if($hournow > 22 and $hournow < 6) {
		$paroftday = "uneaeg";
	}//enne 6
	if($hournow >= 8 and $hournow <=16) {
		$partofday = "õppimise aeg";
	}
	if($hournow >=17 and $hournow <= 18) {
		$partofday = "Trenniaeg";
	}
	if($hournow >=18 and $hournow <= 19) {
		$paroftday = "Transport koju";
	}
	if($hournow >=20 and $hournow <=21) {
		$paroftday = "Söögi valmistamine";
	}
	//vaatame semestri kulgemist
	$semesterstart = new DateTime("2020-8-31");
	$semesterend = new DateTime("2020-12-13");
	$semesterduration = $semesterstart->diff ($semesterend);
	$semesterdurationdays = $semesterduration->format ("%r%a");
	$today = new DateTime ("now");
	$semesterduration = $semesterstart->diff ($today);
	$semesterdurationdays = $semesterduration->format ("%r%a");
	$
	if ($semesterstart <= $fulltimenow) {
	echo ("Semester käib")}
	if ($fulltimenow >= $semesterend) {
	echo ("Semester on lõppenud") }
	// (tänane kuupäev-100)/105= kui palju on semester läbitud protsentides
	
	
?>
<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8"/>
	<title><?php echo $username; ?> programmeerib veebi</title>
	
</head>
<body>
	<h1><?php echo $username; ?></h1>
	<p>See  veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
	<p>See konkreetne leht on loodud veebiprogrammeerimise kursusel lehel <a href="https://www.tlu.ee> Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
	<p>Lehe avamise hetk: <?php echo $fulltimenow; ?>.</p>
	<p><?php echo "Praegu on " .$partofday ."."; ?></p>
	</body>
	</html>
	