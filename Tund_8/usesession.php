<?php
session_start();
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
  }