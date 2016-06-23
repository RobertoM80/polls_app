<?php 
session_start();

include('inc/functions.php');

if (isset($_SESSION['email'])) {
  header("location:my_account.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
  $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
  $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);
  $confirm_password = $_POST['confirm_password'];

  if ($name == '' || $email == '' || $password == '' || $confirm_password == '') {
    $error_message = "Please, Fill in the required fields: name, email, password and confirm_password.";
  } else if ($password != password_verify($confirm_password, $password)) {
    $error_message = "Password and confirm_password must be the same";
  } else if (strlen($_POST['password']) < 5) {
    $error_message = 'Password must be at least 5 characters';
  } else if (there_is_one($email)) {
     $error_message = 'Your email is already been used. You can register with just one email.';
  } else {
    $token = bin2hex(openssl_random_pseudo_bytes(32));
    registr_user($name, $email, $password, $token);
  }

  if (!isset($error_message) && $_POST['address'] != '') {
    $error_message = "Bad form imput";
  }

  if (isset($token)) {
    $mex = "$name Welcome to Bob's site!\n To activate your account click this link: \n 
          http://localhost/activate.php?token=$token"; 
  }

//---------------------------------------------------------------------------------------------

  require 'inc/phpmailer/PHPMailerAutoload.php';

  $mail = new PHPMailer;

  if (!isset($error_message) && !$mail->validateAddress($email)) {
    $error_message = 'Ivalid Email address..';
  } 

  if (!isset($error_message)) {

    //$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp-mail.outlook.com';              // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'bronzetto@outlook.com';       // SMTP username
    $mail->Password = 'bob02091980';                      // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom($email, $name);
    $mail->addAddress($email, $name);     // Add a recipient

    $mail->isHTML(false);                                  // Set email format to HTML

    $mail->Subject = 'Created Account for ' . $name;
    $mail->Body = $mex;

    if($mail->send()) {
      header('location:index.php?status=thanks'); 


      exit;
    }
      $error_message = 'Message could not be sent.';
      $error_message .= 'Mailer Error: ' . $mail->ErrorInfo;
  }
//---------------------------------------------------------------------------------------------

}
$page = 'register';

include('inc/header.php');

?>

 <form class='register center-block' method='post' action'register.php'>
      <h1 class='text-center'>SIGN UP TO POLL PLACE</h1>
      <hr/>

      <?php 
        if (isset($error_message)) {
          echo "<p class='bg-danger'>" . $error_message . "</p>";
        }    
      ?>

      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name='name' id="name" placeholder="Name" value='<?php if (isset($name)) { echo $name; }?>'>
      </div>
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" name='email' id="email" placeholder="Email" value='<?php if (isset($email)) { echo $email; }?>'>
      </div>
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

      <button type="submit" class="btn btn-default" name='register'>Register</button>
    </form>

<?php
include('inc/footer.php');

?>