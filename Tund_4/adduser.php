<?php
  //var_dump($_POST);
  require("../../../config.php");
  //$database = "if20_gaspar_lu_1";
  
  //$filmhtml = readfilms(); filmhtml väärtus on funktsiooni vastus
  $inputerror = "";
  $nameerror = "";
  $firstnameerror = "";
  $lastnameerror = "";
  $emailerror ="";
  $passworderror = "";
  $gender = "";
  //kui klikiti submit, siis...
  if(isset($_POST["usersubmit"])){
  if(empty($_POST["firstnameinput"]) or empty($_POST["lastnameinput"]) or (empty($_POST["genderinput"]) or empty($_POST["emailinput"]) or empty($_POST["passwordinput"]) or empty($_POST["passwordsecondaryinput"]))){
	  $inputerror .= "Osa infot sisestamata! ";
	}
	if(empty($_POST["firstnameinput"])){
		$firstnameerror .="Eesnimi sisestamata!";
	}
	if(empty($_POST["lastnameinput"])){
		$lastnameerror .="Perekonnanimi sisestamata!";
	}
	if(empty($_POST["emailinput"])){
		$emailerror .="Email on sisestamata!";
	}
	if(empty($inputerror)){
		saveuser($_POST["firstnameinput"], $_POST["lastnameinput"], $_POST["genderinput"], $_POST["emailinput"], $_POST["passwordinput"], $_POST["passwordsecondaryinput"]);
	}
	if(strlen($_POST["passwordinput"]) < 8){
		$passworderror .= "Password peab olema pikem kui 8 tähte!";
	}
  }
 
  $username = "Gaspar Luik";
  
  require("header.php");
?>
  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1><?php echo $username; ?></h1>
  <p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  
  <ul>
    <li><a href="home.php">Avaleht</a></li>
	<li><a href="ideedeleht.php">Sisesta idee</a></li>
  </ul>
  
  <hr>
  
  <form method="POST">
	<label for="firstnameinput">Eesnimi</label>
	<input type="text" name="firstnameinput" id="firstnameinput" placeholder="Eesnimi"><span><?php echo $firstnameerror ?></span>
	<br>
	<label for="lastnameinput">Perekonnanimi</label>
	<input type="text" name="lastnameinput" id="lastnameinput" placeholder="Perekonnanimi"><span><?php echo $lastnameerror ?></span>
	<br>
	<label for="genderinput">Sugu</label>
	<input type="radio" name="genderinput" id="genderfemale" value="1" ><?php if($gender == "1"){echo "checked";} ?><label for="genderfemale">Naine</label>
	<input type="radio" name"genderinput" id="gendermale" value="2"> <?php if($gender == "2"){echo "checked";} ?><label for="gendermale">Mees</label>
	<br>
	<label for="emailinput">Email</label>
	<input type="email" name="emailinput" id="emailinput" placeholder="Email"><?php echo $emailerror ?>
	<br>
	<label for="passwordinput">Password</label>
	<input type="password" name="passwordinput" id="passwordinput" placeholder="Password"><span><?php echo $passworderror ?></span>
	<br>
	<label for="passwordsecondaryinput">Korda passwordi</label>
	<input type="password" name="passwordsecondaryinput" id="passwordsecondaryinput" placeholder="Korda passwordi"><span><?php echo $inputerror ?></span>
	<br>
	<input type="submit" name="usersubmit" value="Salvesta uus kasutaja">
  </form>
</body>
</html>
