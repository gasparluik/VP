<?php
require("../../../config.php");
require("fnc_data.php");
require("fnc_common.php");

  $sortby = 0;
  $sortorder = 0;

  require("header.php");
  ?>
   <p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  
  <ul>
	<li><a href="andmed.php">Veoste sisestamine</a></li>
  </ul>
  
  <hr>
  <hr>
  <?php
      if(isset($_GET["sortby"]) and isset($_GET["sortorder"])){
          if($_GET["sortby"] >= 1 and $_GET["sortby"] <= 4){
              $sortby = intval($_GET["sortby"]);
          }
          if($_GET["sortorder"] == 1 or $_GET["sortorder"] == 2){
              $sortorder = intval($_GET["sortorder"]);
          }
      }
      echo readhauls($sortby, $sortorder);
  ?>