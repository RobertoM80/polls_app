<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=registered_users', 'root', 'root');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
	echo 'Unable to connect!';
	echo $e->getMessage();
	exit;
}

//echo 'Connected to the database..';
?>