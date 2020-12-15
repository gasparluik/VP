<?php
require("../../../config.php");
require("fnc_message.php");
require("fnc_common.php");

  $sortby = 0;
  $sortorder = 0;

  require("header.php");
  ?>
  <ul>
	<li><a href="insertMessages.php">Sõnumite saatmine</a></li>
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
      echo readmessages($sortby, $sortorder);
  ?>