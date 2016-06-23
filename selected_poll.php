<?php
session_start();

include('inc/functions.php');
$_SESSION['poll'] = $_GET['poll'];
$poll_id = get_poll_id($_SESSION['poll']);
$is_own_poll = is_poll_created_by($_SESSION['user_id'], $_SESSION['poll']);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['chose'])){
	$has_vote = check_if_already_vote($_SESSION['user_id'], $_GET['poll']);
	if ($has_vote == false) {
		$choice = $_POST['chose'];
		update_vote($choice, $poll_id, $_SESSION['user_id']);
	} else {
		$error_message = 'you can vote just once a poll..';
	}
} 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])){
	delete_poll($poll_id);
	header("location:index.php");
	exit();
}

$page = $_GET['poll'];

include('inc/header.php');
?>

<div class='jumbotron row'>
	<div class='options col-md-7 col-sm-12'>
		
		<form class='selected_form center-block' id='chose' method='post' action='<?php echo "selected_poll.php?poll=" . $_SESSION['poll']; ?>'>
	      <h1 class='text-center'>
			<?php
				echo "<h2>" . $_GET['poll'] . "</h2>";
			?>
	      </h1>
	      <hr/>
	      <div class='option_added'></div>
	      <?php
	      if (isset($error_message)) {
	      	echo "<p class='bg-danger'>" . $error_message . "</p>";
	      }
	      if (!isset($_SESSION['user_id'])) {
	      	echo "<h3>If you want to vote, please login</h3>";
	      } 

	      ?>

	     <select class="form-control" id='options'  name='chose'>
		   <?php 
		     $opt = get_options($_GET['poll']);
		     foreach ($opt as $key => $option) {
		     	echo "<option>" . $option . "</option>";
		     }
		   ?>
		   <option value='extra_option'>add a new option</option>
		 </select>
		 <br>
		
	      <button type="submit" name='vote' class="btn btn-primary <?php if (!isset($_SESSION['user_id'])) { echo 'hide'; }?>">CHOSE</button>
    	</form>
    	<br/>
    	<form id='extra' class='hide' method='post' action='<?php echo "selected_poll.php?poll=" . $_SESSION['poll']; ?>'>
			<div id='' class="form-group">
         		<label for="extra">extra option</label>
         		<input type="text" class="form-control" name='chose' id="extra" placeholder="custom option">
         		
         	</div>
         	<button type="submit" name='extra' class="btn small btn-primary">CHOSE</button>
        </form>
         
	</div>
	<div class='chart col-md-4 col-sm-12'>
		<canvas id="myChart" width="400px" height="400px"></canvas>

	<form class='delete center-block <?php if (!isset($_SESSION['name']) || !$is_own_poll) {echo "hide";} ?>' method='post' action="<?php echo "selected_poll.php?poll=" . $_SESSION['poll']; ?>">
      <button type="submit" name='delete' class="btn btn-default">DELETE POLL</button>
    </form>
	</div>
</div>

<?php
include('inc/footer.php');
?>