<?php 
include('inc/functions.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);
  $confirm_password = $_POST['confirm_password'];

  if ($password == '' || $confirm_password == '') {
    $error_message = "Please, Fill in the required fields: name, email, password and confirm_password.";
  } else if (strlen($_POST['password']) < 5) {
    $error_message = 'Password must be at least 5 characters';
  } else if ($password != password_verify($confirm_password, $password)) {
    $error_message = "Password and confirm_password must be the same";
  } else {
    $token = $_GET['token'];
    update_password($password, $token);
    header("location:index.php?reset=yes");
  }


  if (!isset($error_message) && $_POST['address'] != '') {
    $error_message = "Bad form imput";
  }
}

$page = 'set password';

include('inc/header.php');
?>

<form class='register center-block' method='post' action'new_password.php'>
      <h1 class='text-center'>RETREIVE PASSWORD</h1>
      <hr/>

      <?php

      if (isset($error_message)) {
      	echo "<p class='bg-danger'>" . $error_message . "</p>";
      } else if (isset($success)) {
      	echo "<p class='bg-success'>" . $success . "</p>";
      } 

      ?>

      <div class="form-group">
        <label for="password">Password (minimum 5 chars)</label>
        <input type="password" class="form-control" name='password' id="password" placeholder="Password">
      </div>
      <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" class="form-control" name='confirm_password' id="confirm_password" placeholder="Password">
      </div>

      <div class="form-group" style='display:none;'>
        <label for='address'>Address</label>
        <input type='text' id='address' name='address' />
        <p>Please leave this field empty.</p>
      </div>

      <button type="submit" name='login' class="btn btn-default">RESET PASSWORD</button>
      <a href="index.php" class="btn btn-danger">CANCEL</a>
    </form>


<?php 

include('inc/footer.php');

?>