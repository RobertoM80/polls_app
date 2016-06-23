<?php 
session_start();

include('inc/functions.php');

$page = 'my_account';
$array_my_polls = my_polls($_SESSION['user_id']);

include('inc/header.php');
?>

<div class='jumbotron'>
  <h1 class='text-center'><?php echo $_SESSION['name'];?></h1>
  <h3 class='text-center'>Here you can see all the polls that you have created!</h3>
  <h4 class='text-center'>Click on them to select it and vote!</h4>
</div>

<?php 
foreach ($array_my_polls as $key => $value) {
	$query_string = urlencode($value['poll']);
	echo "<a href='selected_poll.php?poll=" . htmlentities($query_string) ."'><p class='well text-center'>" . strtoupper($value['poll']) . "</p></a>";
}
include('inc/footer.php');
?>