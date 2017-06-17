<?php 
session_start();
include('inc/functions.php');

$page = 'home polls';
$array_total_polls = all_polls();

include('inc/header.php') ;
?>

<div class='jumbotron'>
  <h1 class='text-center'>POLL PLACE</h1>
  <h3 class='text-center'>Here you can see all the polls that have been created</h3>
  <h4 class='text-center'>Click on them to select it and vote!</h4>
</div>

<?php 
if (isset($_GET['status']) && $_GET['status'] == 'thanks') {
	echo "<p class='bg-success text-center'>An Email has been sent to your email. please click the link to activate your account</p>";
} else if (isset($_GET['active']) && $_GET['active'] == 'yes') {
	echo "<p class='bg-success text-center'>Your account has been activate!</p>";
}

foreach ($array_total_polls as $key => $value) {
	$query_string = urlencode($value['poll']);
	echo "<a href='selected_poll.php?poll=" . htmlentities($query_string) ."'><p class='well text-center'>" . strtoupper($value['poll']) . "</p></a>";
}
include('inc/footer.php');
?>