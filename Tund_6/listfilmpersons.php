<?php
require("usesession.php");
  //var_dump($_POST);
  require("../../../config.php");
  require("fnc_filmrelations.php");
  //$database = "if20_gaspar_lu_1";
  
  //$filmhtml = readfilms(); filmhtml väärtus on funktsiooni vastus
 
  
  //$username = "Gaspar Luik";
  
  require("header.php");
?>
  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"];?></h1>
  <p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  
  <ul>
	<li><a href="?logout=1">Logi välja</a>!</li>
	<br>
    <li><a href="home.php">Avaleht</a></li>
	<li><a href="addfilms.php">Sisesta film</a></li>
  </ul>
  
  <hr>
  <?php echo readpersonsinfilm(); ?>
</body>
</html>
