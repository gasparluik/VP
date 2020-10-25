<?php
require("usesession.php");
  //var_dump($_POST);
  require("../../../config.php");
  require("fnc_films.php");
  require("fnc_common.php");
  //$database = "if20_gaspar_lu_1";
  
  $movieinput = "";
  $genreinput = "";
  
  $movieerrorinput = "";
  $genreerrorinput = "";
  
  //Tühjade tabelite kontrollimine
  if(isset($_POST["submitrelationdata"])){
	  
	  if (!empty($_POST["movieinput"])){
		$movieinput = $_POST["movieerrorinput"];
	  } else {
		  $movieerrorinput = "Palun vali film!";
	  }
	  
	  if (!empty($_POST["genreinput"])){
		$genreinput = $_POST["genreinput"];
	  } else {
		  $genreerrorinput = "Palun vali žanr!";
	  }
  }
	  require("header.php");
?>
  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  
  <ul>
	<li><a href="?logout=1">Logi välja</a>!</li>
	<br>
    <li><a href="home.php">Avaleht</a></li>
	<li><a href="listfilms.php">Vaata sisestatud filme</a></li>
  </ul>
  
  <hr>
  
  <form method="POST">
	<label for="filminput">Film: </label>
	<select name="filminput" id="filminput">
		<option value="" selected disabled>Vali film</option>
		<option value="1">Siin me oleme</option> 
		<option value="2">Don Juan Tallinnas</option>
		<option value="3">Hukkunud Alpinisti hotell</option> 
		<option value="4">Kevade</option>
		<option value="5">Viini postmark</option>
		<option value="6">Mehed ei nuta</option>
		<option value="7">Noor pensionär</option>
	</select>
	<br>
	<label for="genreinput">Žanr: </label>
	<select name="genreinput" id="genreinput">
		<option value="" selected disabled>Vali žanr</option>
		<option value="1">Komöödia</option> 
		<option value="2">Ulmefilm</option>
		<option value="3">Muusikal/tantsufilm</option> 
		<option value="4">Draama</option>
		<option value="5">Detektiivfilm</option>
		<option value="6">Põnevusfilm</option>
	</select>
	<input type="submit" name="relationsubmit" value="Loo seos">
  </form>
</body>
</html>