<?php 
include('inc/functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));

  $data_user = array_data_user($email);

  if ($email == '') {
  	$error_message = 'Please enter your email address to retreive the password';
  } else if (!$data_user) {
  	$error_message = 'This email is not valid';
  } else if ($data_user) {
    $token = bin2hex(openssl_random_pseudo_bytes(32));
    update_user_token($token, $email);
    $mex = "Hi" . ' ' . $data_user['name'] . "\nClick to this link to create a new password:\nhttp://localhost/activate.php?token_forgot=$token";
  }

  if (!isset($error_message) && $_POST['address'] != '') {
    $error_message = "Bad form imput";
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

    $mail->setFrom($email, $data_user['name']);
    $mail->addAddress($email, $data_user['name']);     // Add a recipient

    $mail->isHTML(false);                                  // Set email format to HTML

    $mail->Subject = 'Retreive password for ' . $data_user['name'];
    $mail->Body = $mex;

    if($mail->send()) {
      header('location:forgot_password.php?forgot=sent'); 
      exit();
    }
      $error_message = 'Message could not be sent.';
      $error_message .= 'Mailer Error: ' . $mail->ErrorInfo;
  }
//---------------------------------------------------------------------------------------------
}

$page = 'forgot password';

include('inc/header.php');
?>

 <form class='register center-block' method='post' action'forgot_password.php'>
      <h1 class='text-center'>RETREIVE PASSWORD</h1>
      <hr/>

      <?php
      if (isset($error_message)) {
      	echo "<p class='bg-danger'>" . $error_message . "</p>";
      } else if (isset($_GET['forgot']) && $_GET['forgot'] == 'sent') {
      	echo "<p class='bg-success'>A Link has been emailed to you. Click it to change to a new password</p>";
      }
      ?>

      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" name='email' id="email" placeholder="Email">
      </div>
      <div class="form-group" style='display:none;'>
        <label for='address'>Address</label>
        <input type='text' id='address' name='address' />
        <p>Please leave this field empty.</p>
      </div>

      <button type="submit" name='login' class="btn btn-default">SEND PASSWORD</button>
      <a href="index.php" class="btn btn-danger">CANCEL</a>
    </form>


<?php 
include('inc/footer.php');
?>
