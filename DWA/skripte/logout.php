<?php
  session_start();
  $_SESSION['idKorisnika']=NULL;
  header("location: ../index.php");
?>