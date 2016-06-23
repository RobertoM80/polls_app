<?php 
  session_start();

  include('inc/functions.php');
  
  $page = 'login';

  if (isset($_SESSION['email']) || isset($_COOKIE['name'])) {
    header("location:my_account.php");
    exit();
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));

    $data_user = array_data_user($email);

    if ($data_user) {
      if (($data_user['status'] === '1') && password_verify($password, $data_user['password'])) {
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $data_user['name'];
        $_SESSION['user_id'] = $data_user['user_id'];
        if (isset($_POST['remember_me'])) {
          setcookie('name', $_SESSION['name'], time()+60*60);
        }
        header("location:my_account.php");
        exit();
      } else if (($data_user['status'] === '1') && !password_verify($password, $data_user['password'])) {
        $error_message = 'Looks like your password is wrong';
      } else {
        $error_message = "Before logging in you must activate your account or register";
      }
    } else {
      $error_message = 'The password or Email is wrong';
    }   
  }

  include('inc/header.php');
?>

    <form class='register center-block' method='post' action='login.php'>
      <h1 class='text-center'>SIGN IN TO POLL PLACE</h1>
      <hr/>

    <?php 
      if (isset($_GET['status']) && $_GET['status'] == 'thanks') {
        echo "<p class='bg-success'>Thanks for register. A link has been sent to your email. Click it to activate your account</p>";
      } else if (isset($_GET['active']) && $_GET['active'] === 'yes') {
        echo "<p class='bg-success'>Your account has been activated!</p>";
      } else if (isset($_GET['out']) && $_GET['out'] === 'yes') {
        echo "<p class='bg-success'>You have been logged out!</p>";
      } else if (isset($_GET['reset']) && $_GET['reset'] === 'yes') {
        echo "<p class='bg-success'>Your password has been changed!!</p>";
      } else if (isset($_GET['loggedin']) && $_GET['loggedin'] === 'no') {
        echo "<p class='bg-danger'>You need to be logged in to view your account</p>";
      } else { 
        if (isset($error_message)) {
          echo "<p class='bg-danger'>" . $error_message . "</p>";
        }
      }
    ?>
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" name='email' id="email" placeholder="Email" value='<?php if (isset($email)) { echo $email; }?>'>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name='password' id="password" placeholder="Password">
      </div>
      <div class="checkbox">
        <label>
          <input type="checkbox" name='remember_me'> Remember me -
        </label>
        <a class='forgot_pass' href="forgot_password.php">FORGOT PASSWORD</a>
      </div>

      <button type="submit" name='login' class="btn btn-default">LogIn</button>
    </form>

  
    <?php 
    include('inc/footer.php');
    ?>