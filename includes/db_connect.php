<?php 
$GLOBALS['config'] = array(
		'mysql' => array(
			'user' => 'Lanre',
			'dsn' => 'mysql:host=localhost;dbname=student',
			'password' => 'Olanrewaju'
		)

);
try {
	$db = new PDO($GLOBALS['config']['mysql']['dsn'],$GLOBALS['config']['mysql']['user'],$GLOBALS['config']['mysql']['password']);
	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	// echo('Connection Successful !');
} catch (PDOException $e) {
	die('Connection Failed !');
}

?>