<?php 
    include('inc/functions.php');
    
    if (isset($_GET['token'])) {
      $token = trim(filter_input(INPUT_GET, 'token', FILTER_SANITIZE_STRING));
      token_login($token);
      header('location:index.php?active=yes');
      exit();
    } else if (isset($_GET['token_forgot'])) {
      $token = trim(filter_input(INPUT_GET, 'token_forgot', FILTER_SANITIZE_STRING));
      header('location:new_password.php?token=' . $token);
      exit();
    }
?>