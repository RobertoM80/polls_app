<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title><?php echo $page . ' '; ?> - Bob' site</title>
  <meta name="description" content="PORTFOLIO">
  <meta name="Roberto Mirabella" content="">

  <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css">
  <link href='https://fonts.googleapis.com/css?family=Buda:300' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="css/main.css">

</head>
<body>

  <!-- Primary Page Layout
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <div id="top" class="container-fluid">
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <ul><li><a class="navbar-brand" href="#">
         <!--  <img id='logo' class="myLogo" src="images/myLastLogo.png" height="60" width="68" alt="logo" clear='right'> -->
        </a></li></ul>
        <div class="collapse navbar-collapse">
       
          <ul class="nav navbar-nav navbar-right">
            <li><a id='home_polls' class='<?php if ($page == 'home polls') { 
                                                  echo 'active'; 
                                            }?>'href="index.php">HOME</a></li>
            <li><a id='login' class="     <?php if ($page == 'login') { 
                                                  echo 'active'; } 
                                                else if (isset($_SESSION['name'])) { 
                                                  echo 'hide';} ?>" href="login.php">SIGN IN</a></li>
            <li><a id='new_poll' class="  <?php if (isset($_SESSION['name']) && $page == 'new_poll') {
                                                  echo 'active';}
                                                else if (!isset($_SESSION['name'])) { 
                                                  echo 'hide';} ?>" href="new_poll.php">NEW POLL</a></li>
            <li><a id='register' class="  <?php if ($page == 'register') { 
                                                  echo 'active'; } 
                                                else if (isset($_SESSION['name'])) { 
                                                  echo 'hide';} ?>" href="register.php">SIGN UP</a></li>
            <li><a id='logout' class="    <?php if (!isset($_SESSION['name'])) { 
                                                  echo 'hide';} ?>" href="logout.php">SIGN OUT</a></li>
            <li><a id='my_account' class="<?php if (isset($_SESSION['name']) && $page == 'my_account') { 
                                                  echo 'active'; } 
                                                else if (!isset($_SESSION['name'])) { 
                                                  echo 'hide';} ?>" href="my_account.php">MY POLLS</a></li>
            
          </ul>
        </div>
      </div>
    </div>
