<?php
require("usesession.php");

/* session_start();
  //$username = "Gaspar Luik";
  
  //kas on sisse loginud
  if(!isset($_SESSION["userid"])){
	  //jõuga suunatakse sisselogimise lehele
	header("Location: page.php");
	exit();
  }
  //logime välja
  if(isset($_GET["logout"])){
	  //Lõpetame sessiooni
	  session_destroy();
	  header("Location: page.php");
	  exit();
  } */
  $fulltimenow = date("d.M.Y H:i:s");
  $hournow = date("H");
  $partofday = "lihtsalt aeg";
  $weekdaynameset = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
  $monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
  //echo $weekdaynameset;
  //var_dump($weekdaynameset);
  $weekdaynow = date("N");
  //echo $weekdaynow;
  
  if($hournow < 6){
	  $partofday = "uneaeg";
  }//enne 6
  if($hournow >= 6 and $hournow < 8){
	  $partofday = "Ärkamine";
  }
  if($hournow >= 8 and $hournow < 18){
	  $partofday = "Ultimus maximus produktiivsuse aeg";
  }
  if($hournow >= 16 and $hournow < 18){
	  $partofday = "Trenniaeg";
  }
  if($hournow >= 18 and $hournow < 22){
	  $partofday = "Õppimine, hobid jne";
  }
  if($hournow >= 22){
	  $partofday = "Tuttu ära";
  }
  
  //jälgime semestri kulgu
  $semesterstart = new DateTime("2020-8-31");
  $semesterend = new DateTime("2020-12-13");
  $semesterduration = $semesterstart->diff($semesterend);
  $semesterdurationdays = $semesterduration->format("%r%a");
  $today = new DateTime("now");
  $fromsemesterstart = $semesterstart->diff($today);
  //saime aja erinevuse objektina, seda niisama näidata ei saa
  $fromsemesterstartdays = $fromsemesterstart->format("%r%a");
  $semesterpercentage = 0;
    
  $semesterinfo = "Semester kulgeb vastavalt akadeemilisele kalendrile.";
  if($semesterstart > $today){
	  $semesterinfo = "Semester pole veel peale hakanud!";
  }
  if($fromsemesterstartdays === 0){
	  $semesterinfo = "Semester algab täna!";
  }
  if($fromsemesterstartdays > 0 and $fromsemesterstartdays < $semesterdurationdays){
	  $semesterpercentage = ($fromsemesterstartdays / $semesterdurationdays) * 100;
	  $semesterinfo = "Semester on täies hoos, kestab juba " .$fromsemesterstartdays ." päeva, läbitud on " .$semesterpercentage ."%.";
  }
  if($fromsemesterstartdays == $semesterdurationdays){
	  $semesterinfo = "Semester lõppeb täna!";
  }
  if($fromsemesterstartdays > $semesterdurationdays){
	  $semesterinfo = "Semester on läbi saanud!";
  }

  //annan ette lubatud pildivormingute loendi
  $picfiletypes = ["image/jpeg", "image/png"];
  //loeme piltide kataloogi sisu ja näitame pilte
  //$allfiles = scandir("../vp_pics/");
  $allfiles = array_slice(scandir("../vp_pics/"), 2);
  //var_dump($allfiles);
  //$picfiles = array_slice($allfiles, 2);
  $picfiles = [];
  //var_dump($picfiles);
  foreach($allfiles as $thing){
	$fileinfo = getImagesize("../vp_pics/" .$thing);
    //var_dump($fileinfo);
	if(in_array($fileinfo["mime"], $picfiletypes) == true){
		array_push($picfiles, $thing);
	}
  }
  
  
  //paneme kõik pildid ekraanile
  $piccount = count($picfiles);
  //$i = $i + 1;
  //$i ++;
  //$i += 2;
  $imghtml = "";
  //<img src="../vp_pics/failinimi.png" alt="tekst">
  /*for($i = 0; $i < $piccount; $i ++){
	  $imghtml .= '<img src="../vp_pics/' .$picfiles[$i] .'" ';
	  $imghtml .= 'alt="Tallinna Ülikool">';
  }*/
  $imghtml .= '<img src="../vp_pics/' .$picfiles[mt_rand(0, ($piccount - 1))] .'" ';
  $imghtml .= 'alt="Tallinna Ülikool">';
  require("header.php");
?>
  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  
	<li><a href="?logout=1">Logi välja</a>!</li>
	<br>
	<li><a href="insertideas.php">Sisesta idee</a></li>
	<li><a href="listideas.php">Vaata sisestatud ideesid</a></li>
    <li><a href="addfilms.php">Lisa film</a></li>
	<li><a href="listfilms">Vaata sisestatud filme</a></li>
	<li><a href="addfilmrelations.php">Filmide ja žanride seosed</a></li>
	<li><a href="adduser.php">Lisa kasutaja</a></li>
	<li><a href="userprofile.php">Kasutaja profiil</a></li>
  	<li><a href="listfilmpersons.php">Filmides mängivad inimesed</a></li>
	
  <p>Lehe avamise hetk: <?php echo $weekdaynameset[$weekdaynow - 1] .", " .$fulltimenow; ?>.</p>
  <p><?php echo "Praegu on " .$partofday ."."; ?></p>
  <p><?php echo $semesterinfo; ?></p>
  <hr>
  <?php echo $imghtml; ?>
  <hr>

</body>
</html>