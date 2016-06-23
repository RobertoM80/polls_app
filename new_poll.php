<?php
session_start();

include('inc/functions.php');

if (!isset($_SESSION['email'])) {
	header('location:login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$_POST['options'] = nl2br($_POST['options']);
	$title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
	$options = explode("\n", trim(filter_input(INPUT_POST, 'options', FILTER_SANITIZE_STRING))); //may not be a good solution.. better sanitize special chars but doesn't recognize \n
	//var_dump($options);
	if ($title == '') {
		$error_message = 'You need to incorporate a title!';
	} else if (!$options[1]) {
		$error_message = 'You must include at least 2 options!';
	} else {
		insert_poll($title, $_SESSION['user_id'], $options);
		header('location:index.php');
	}
}

$page = 'new_poll';

include('inc/header.php');
?>

<div class='jumbotron'>
	<h1 class='text-center'>Create your new poll</h1>
	<h3 class='text-center'>Write your options in new lines</h3>
</div>
<?php 
if (isset($error_message)) {
	echo "<p class = 'bg-danger text-center'>" . $error_message . "</p>";
}
?>
<form class='new_poll_form center-block' method='post' action='new_poll.php'>
	<div class="form-group">
	    <label for="title">Title</label>
	    <input type="text" id='title' class="form-control" name = 'title' placeholder="Your poll" value='<?php if (isset($title)) { echo $title; }?>'>
     </div>
     <div class="form-group">
        <label for="options">Options</label>
        <textarea id='options' class="form-control" rows="4" name ='options' placeholder="Your options" ><?php if (isset($options)) { echo implode('', $options);}?></textarea>
     </div>

      <button type="submit" name='new_poll' class="btn btn-primary">Submit</button>
</form>
	

<?php
include('inc/footer.php');
?>