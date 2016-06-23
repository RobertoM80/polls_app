<?php

// function display_errors() { // cancel before pushing into production server..
// 	error_reporting(E_ALL);
// 	ini_set("display_errors", 1);
// 	ini_set("html_errors", 1);
// }

// display_errors();

function there_is_one($email) {
	include('db.php');

	try {
		$result = $db->prepare("
								SELECT email 
								FROM users
								WHERE users.email = ?"
							   );

		$result->bindParam(1, $email, PDO::PARAM_STR);
		$result->execute();
		$e_mail = $result->fetch();
		if (strlen($e_mail['email']) > 0) {
			return true;
		} else {
			return false;
		}

	} catch (Exception $e) {
		echo "Unable to retrieve the data";
	}
}

function registr_user($name, $email, $password, $token) {
	include('db.php');

	try {
		$result =$db->prepare("
								INSERT INTO users
								(name, email, password, token)
								VALUES(?, ?, ?, ?);
			");
		$result->bindParam(1, $name);
		$result->bindParam(2, $email);
		$result->bindParam(3, $password);
		$result->bindParam(4, $token);

		$result->execute();

	} catch (Exception $e) {
		echo "Unable to retrieve the data";
	}
}

function token_login($token){
	include('db.php');
	try {
	  $results = $db->query("UPDATE users 
	                         SET status = '1'
	                         WHERE token='$token'");

	} catch (Exception $e) {
	  echo "Unable to retrieve the data";
	}
  
}

function array_data_user($email) {
	include('db.php');
	//$email = 'robertomirabella1980@gmail.com';
	try {
		$result =$db->prepare("
								SELECT * FROM users
								WHERE users.email = ?
								
			");

		$result->bindParam(1, $email, PDO::PARAM_STR);

		$result->execute();

		$arr = $result->fetch(PDO::FETCH_ASSOC);

		return $arr;

	} catch (Exception $e) {
		echo "Unable to retrieve the data";
	}
}

function update_user_token($token, $email) {
	include('db.php');

	try {
	  $result = $db->prepare("UPDATE users 
	                         SET token = ?
	                         WHERE users.email = ?
								
			");

		$result->bindParam(1, $token, PDO::PARAM_STR);
		$result->bindParam(2, $email, PDO::PARAM_STR);
		$result->execute();

	} catch (Exception $e) {
	  echo "Unable to retrieve the data: $e";
	}
}

function update_password($password, $token) {
	include('db.php');

	try {
	  $result = $db->prepare("UPDATE users 
	                         SET password = ?
	                         WHERE users.token = ?
								
			");

		$result->bindParam(1, $password, PDO::PARAM_STR);
		$result->bindParam(2, $token, PDO::PARAM_STR);
		$result->execute();

	} catch (Exception $e) {
	  echo "Unable to retrieve the data: $e";
	}
}

function insert_poll($poll, $id, $options) {
	include('db.php');
    //qui un loop che 
	//var_dump($options);
	$serialized_opt = serialize($options);
	try {
	    $result = $db->prepare("INSERT INTO polls (poll, user_id, options)
	  						  VALUES (?, ?, ?);
			");

		$result->bindParam(1, $poll);
		$result->bindParam(2, $id);
		$result->bindParam(3, $serialized_opt);
		$result->execute();
		// var_dump($result);
		// $poll_id = $db->query("SELECT poll_id FROM polls WHERE poll = $poll");
		// var_dump($poll_id);
		// foreach ($options as $key => $option) {

		// 	$result = $db->prepare("INSERT INTO options ()");
		// }

	} catch (Exception $e) {
	  echo "Unable to write data: $e";
	}
}

function all_polls() {
	include('db.php');

	try {
		$result =$db->prepare("
								SELECT poll FROM polls;
								
								
			");

		$result->execute();

		$arr = $result->fetchAll(PDO::FETCH_ASSOC);

		return $arr;

	} catch (Exception $e) {
		echo "Unable to retrieve the data";
	}	
}

function my_polls($id) {
	include('db.php');

	try {
		$result =$db->prepare("
								SELECT poll FROM polls
								WHERE polls.user_id = ?;
								
								
			");

		$result->bindParam(1, $id);

		$result->execute();

		$arr = $result->fetchAll(PDO::FETCH_ASSOC);

		return $arr;

	} catch (Exception $e) {
		echo "Unable to retrieve the data";
	}	
}

function get_options($text) {
	include('db.php');

	try {
		$result =$db->prepare("
								SELECT options FROM polls
								WHERE polls.poll = ?;
								
								
			");

		$result->bindParam(1, $text);

		$result->execute();

		$arr = $result->fetchAll(PDO::FETCH_ASSOC);
		return unserialize($arr[0]['options']);
		

	} catch (Exception $e) {
		echo "Unable to retrieve the data";
	}	
}

function check_if_already_vote($id, $poll) {
	include('db.php');

	try {
		$result = $db->query("
								SELECT choice 
								FROM choices
								JOIN polls ON choices.poll_id = polls.poll_id
								WHERE choices.user_id = '$id'
								AND polls.poll = '$poll'"
							   );

		$result = $result->fetch(PDO::FETCH_ASSOC);
		

		if ($result) {
			return true;
		} else {
			return false;
		}
		

	} catch (Exception $e) {
		echo "Unable to retrieve the data";
	}
}

function get_poll_id($poll) {
	include('db.php');

	try {
		$result =$db->prepare("
								SELECT poll_id FROM polls
								WHERE polls.poll = ?;
								
								
			");

		$result->bindParam(1, $poll);

		$result->execute();

		$arr = $result->fetch(PDO::FETCH_ASSOC);

		foreach ($arr as $key => $value) {
			return $value;
		}

	} catch (Exception $e) {
		echo "Unable to retrieve the data";
	}	
}

function update_vote($choice, $poll_id, $user_id) {
	include('db.php');

	try {
		$result = $db->query("
								INSERT INTO choices
								(choice, poll_id, user_id)
								VALUES ('$choice','$poll_id','$user_id')
							   ");

	} catch (Exception $e) {
		echo "Unable to retrieve the data";
	}
}

function delete_poll($poll_id){
	include('db.php');

	try {
		$result = $db->query("
								DELETE FROM polls
								WHERE poll_id = '$poll_id'
							   ");

		$result = $db->query("
								DELETE FROM choices
								WHERE poll_id = '$poll_id'
							   ");

	} catch (Exception $e) {
		echo "Unable to retrieve the data";
	}
}

function is_poll_created_by($user_id, $poll) {
	include('db.php');

	try {
		$result =$db->query("
								SELECT * FROM polls
								WHERE polls.user_id = '$user_id'
								AND polls.poll ='$poll';				
			");

		$result->execute();
		$arr = $result->fetch(PDO::FETCH_ASSOC);

		if ($arr) {
			return true;
		} else {
			return false;
		}

	} catch (Exception $e) {
		echo "Unable to retrieve the data";
	}	
}


















