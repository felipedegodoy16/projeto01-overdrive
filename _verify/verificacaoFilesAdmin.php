<?php 
  
  session_start();

  $_SESSION['logged'] = $_SESSION['logged'] ?? false;

  if(!$_SESSION['logged']) {
    header('Location: ../login.php');
  }

  if($_SESSION['cargo'] !== 'A') {
    header('Location: ../index.php');
  }