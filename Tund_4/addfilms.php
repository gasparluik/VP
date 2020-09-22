<?php
  //var_dump($_POST);
  require("../../../config.php");
  require("fnc_films.php");
  //$database = "if20_gaspar_lu_1";
  
  //$filmhtml = readfilms(); filmhtml väärtus on funktsiooni vastus
  $inputerror = "";
  //kui klikiti submit, siis...
  if(isset($_POST["filmsubmit"])){
  if(empty($_POST["titleinput"]) or empty($_POST["genreinput"]) or empty($_POST["directorinput"]) or empty($_POST["studioinput"]) or empty($_POST["durationinput"]) or empty($_POST["genreinput"])){
	  $inputerror .= "Osa infot sisestamata! ";
	}
	if($_POST["yearinput"] > date("Y") or $_POST["yearinput"] < 1895){
		$inputerror .= "Ebareaalne valmimisaasta";
	}
	if(empty($inputerror)){
		savefilm($_POST["titleinput"], $_POST["yearinput"], $_POST["durationinput"], $_POST["genreinput"], $_POST["studioinput"], $_POST["directorinput"]);
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
	<label for="titleinput">Filmipealkiri</label>
	<input type="text" name="titleinput" id="titleinput" placeholder="Pealkiri">
	<br>
	<label for="yearinput">Filmi valmimisaasta</label>
	<input type="number" name="yearinput" id="yearinput" value="<?php echo date("Y"); ?>">
	<br>
	<label for="durationnput">Kestus minutites</label>
	<input type="number" name="durationinput" id="durationnput" value="80">
	<br>
	<label for="genreinput">Zanr</label>
	<input type="text" name="genreinput" id="genreinput" placeholder="Zanr">
	<br>
	<label for="studioinput">Filmi tootja/stuudio</label>
	<input type="text" name="studioinput" id="stuidoinput" placeholder="Stuudio">
	<br>
	<label for="directorinput">Filmi lavastaja</label>
	<input type="text" name="directorinput" id="directorinput" placeholder="Lavastaja nimi">
	<br>
	<input type="submit" name="filmsubmit" value="Salvesta filmi info">
  </form>
</body>
</html>
