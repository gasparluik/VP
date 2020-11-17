<?php
require("usesession.php");
  require("../../../config.php");
  require("fnc_films.php");
  require("fnc_filmrelations.php");
  require("header.php");
  $inputerror = "";
  //kui klikiti submit, siis...
  $quotehtml = readquote();
  
if(isset($_POST["quotesubmit"])){
  echo"tegutsen";
    if(empty($_POST["quoteinput"])){
        $inputerror .="Osa infot on sisestamata! ";
    }
    if(empty($inputerror)){
        echo"salvestan";
        savequote($_POST["quoteinput"]);
    }
} 

?>
  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  
  <ul>
	<li><a href="?logout=1">Logi välja</a>!</li>
    <li><a href="home.php">Avaleht</a></li>
	<li><a href="listfilms.php">Vaata sisestatud filme</a></li>
  </ul>
  
  <hr>
  
  <form method="POST">
	<label for="quoteinput">tsitaat</label>
	<input type="text" name="quoteinput" id="quoteinput" placeholder="Tsitaat">
	<br>
	<input type="submit" name="quotesubmit" value="Salvesta tsitaat">
  </form>
</body>
</html>
