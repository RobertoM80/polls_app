<?php
session_start();
include('inc/db.php');
include('inc/functions.php');

$poll_id = get_poll_id($_SESSION['poll']);

try {
	$result = $db->query("SELECT choice, COUNT(*) 
							AS count 
							FROM choices 
							WHERE choices.poll_id = '$poll_id'
							GROUP BY choice");

	$result = $result->fetchAll(PDO::FETCH_ASSOC);

	echo json_encode($result);
	
} catch (Exception $e) {
	echo "Unable to retrieve the data";
}
