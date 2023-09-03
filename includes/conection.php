<?php 
// PDO Connection

$GLOBALS['mysql'] = array(
	'dsn' => 'mysql:host=localhost;dbname=album',
	'user' => 'Lanre',
	'password' => 'Olanrewaju'
);

try {
	$db = new PDO($GLOBALS['mysql']['dsn'],$GLOBALS['mysql']['user'],$GLOBALS['mysql']['password']);
	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	// echo('Connection Successful !');
} catch (PDOException $e) {
	die('Connection Failed !'. $e->getMessage());
}
 ?>