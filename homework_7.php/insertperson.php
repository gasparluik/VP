<?php
require ("usesession.php");
require ("header.php");
require ("../../../config.php");
require ("fnc_films.php");
require ("fnc_filmrelations.php");

$inputerror=""; 


$monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
  $firstname= "";
  $lastname = "";
  $birthday = null; // täpselt sama kui "";
  $birthmonth = null;
  $birthyear = null;
  $birthdate = null;

  $firstnameerror = "";
  $lastnameerror = "";
  $birthdayerror = null;
  $birthmontherror = null;
  $birthyearerror = null;
  $birthdateerror = null;
    
  $notice = "";
  
  $personhtml=readperson();
  
  if(isset($_POST["submituserdata"])){
	  
	  if (!empty($_POST["firstnameinput"])){
		saveperson ($_POST["firstnameinput"]);
	  } else {
		  $firstnameerror = "Palun sisesta eesnimi!";
	  }
	  
	  if (!empty($_POST["lastnameinput"])){
		saveperson ($_POST["lastnameinput"]);
	  } else {
		  $lastnameerror = "Palun sisesta perekonnanimi!";
	  }
	  
	  
	  if(!empty($_POST["birthdayinput"])){
		 saveperson (intval($_POST["birthdayinput"]));
	  } else {
		  $birthdayerror = "Palun vali sünnikuupäev!";
	  }
	  
	   if(!empty($_POST["birthmonthinput"])){
		 saveperson (intval($_POST["birthmonthinput"]));
	  } else {
		  $birthmontherror = "Palun vali sünnikuu!";
	  }
	  
	   if(!empty($_POST["birthyearinput"])){
		 saveperson (intval($_POST["birthyearinput"]));
	  } else {
		  $birthyearerror = "Palun vali sünniaasta!";
	  }
	  
	  //kontrollime kuupäeva valiidsust!
	  
	  if(!empty ($birthday) and !empty($birthmonth) and !empty($birthyear)){
		  if(checkdate($birthmonth, $birthday, $birthyear)){
			  $tempdate = new DateTime($birthyear ."-" .$birthmonth ."-" .$birthday);
			  $birthdate = $tempdate->format ("Y-m-d");
		  } else {
			  $birthdateerror = "Kuupäev ei ole reaalne!";
			}
		}
  }		
	
/* $personhtml=readperson(); */

/* if(isset($_POST["namesubmit"])){
  echo"tegutsen";
    if(empty($_POST["firstnameinput"])){
        $inputerror .="Osa infot on sisestamata! ";
    }
    if(empty($inputerror)){
        echo"salvestan";
        saveperson($_POST["firstnameinput"]);
    }
}
if(isset($_POST["namesubmit"])){
  echo"tegutsen";
    if(empty($_POST["lastnameinput"])){
        $inputerror .="Osa infot on sisestamata! ";
    }
    if(empty($inputerror)){
        echo"salvestan";
        saveperson($_POST["lastnameinput"]); */
 /*    }
} */

?>


<img src="IMG/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
<h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See konkreetne veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p> See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli </a> 
  Digitehnoloogiate instituudis.</p>

<form method="POST" action:"<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <label for="firstnameinput">Eesnimi:</label>
	  <br>
	  <input name="firstnameinput" id="firstnameinput" type="text" value="<?php echo $firstname; ?>"><span><?php echo $firstnameerror; ?></span>
	  <br>
	  <br>
      <label for="lastnameinput">Perekonnanimi:</label><br>
	  <input name="lastnameinput" id="lastnameinput" type="text" value="<?php echo $lastname; ?>"><span><?php echo $lastnameerror; ?></span>
	  <br>
	  <br>
	  
	  <label for="birthdayinput">Sünnipäev: </label>
		  <?php
			echo '<select name="birthdayinput" id="birthdayinput">' ."\n";
			echo '<option value="" selected disabled>päev</option>' ."\n";
			for ($i = 1; $i < 32; $i ++){
				echo '<option value="' .$i .'"';
				if ($i == $birthday){
					echo " selected ";
				}
				echo ">" .$i ."</option> \n";
			}
			echo "</select> \n";
		  ?>
	  <label for="birthmonthinput">Sünnikuu: </label>
	  <?php
	    echo '<select name="birthmonthinput" id="birthmonthinput">' ."\n";
		echo '<option value="" selected disabled>kuu</option>' ."\n";
		for ($i = 1; $i < 13; $i ++){
			echo '<option value="' .$i .'"';
			if ($i == $birthmonth){
				echo " selected ";
			}
			echo ">" .$monthnameset[$i - 1] ."</option> \n";
		}
		echo "</select> \n";
	  ?>
	  <label for="birthyearinput">Sünniaasta: </label>
	  <?php
	    echo '<select name="birthyearinput" id="birthyearinput">' ."\n";
		echo '<option value="" selected disabled>aasta</option>' ."\n";
		for ($i = date("Y") - 15; $i >= date("Y") - 110; $i --){
			echo '<option value="' .$i .'"';
			if ($i == $birthyear){
				echo " selected ";
			}
			echo ">" .$i ."</option> \n";
		}
		echo "</select> \n";
	  ?>
	  <br>
	  <span><?php echo $birthdateerror ." " .$birthdayerror ." " .$birthmontherror ." " .$birthyearerror ." " .$firstnameerror ." " .$lastnameerror; ?></span>
	  <input name="submituserdata" type="submit" value="Uus persoon"><span><?php echo "&nbsp; &nbsp; &nbsp;" .$notice; ?></span>
</form>
<?php echo $inputerror ?>

</body>
</html>