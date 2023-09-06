<?php 
	session_start();
	require_once('conection.php') ;


	function getUser($id) {
		global $db;
		try {
			$sql = "SELECT * FROM admin WHERE `id` = ".$id. ' LIMIT 1';
			$db->prepare($sql);
			$qry = $db->query($sql);
			$qry->execute();
			if($qry->rowCount() === 1){
				$user = $qry->fetch(PDO::FETCH_OBJ);
			} else {
				$user = null;
			}
		} catch (PDOException $e) {
			
		}
		return $user;
	}

	function getContent() {
		global $db;
		$base = 'home';
		$dir = './pages/';
		$dir1 = './admin/';
		$page = isset($_GET['pg']) ? $_GET['pg'] : '';
		
		
		if (empty($page)) {
			require_once($dir. $base . '.php');
		} elseif (!empty($page)) {
			$file = $dir. $page . '.php';
			$file1 = $dir1. $page . '.php';
			if (is_file($file)) {
				require_once($file);
			} elseif (is_file($file1)) {
				require_once($file1);
			}
			elseif (!(is_file($file) || is_file($file1))) {
				echo('Page Not Found !');
			}
		}
	}

	function format_time($sec) {
		$value = '';
		if($sec > 60) {
			if(fmod($sec, 60) != 0) {
				if(fmod($sec, 60) < 10) {
					$value .= floor($sec/60).' min : ' . '0' . fmod($sec, 60).' sec';
				} else {
					$value .= floor($sec/60).' min : ' . fmod($sec, 60).' sec';
				}
				
			} else {
				$value .= floor($sec/60).' min : ' . ' 00 sec';
			}
			
		} else {
			$value .=  $sec .' sec';
		}
		return $value;
	}

	function logged_in() {
		return isset($_SESSION['user']['id']);
	}

	function setDefault($arr = array()) {
		foreach($arr as $field) {
			if(!isset($_POST[$field])) {
				$_POST[$field] = '';
			}
		}
	}

	function validate($fields= array()) {
		global $db;
		$error = [];
		foreach($fields as $field => $fd_rules) {
			$value = trim($_POST[$field]);
			foreach($fd_rules as $rule => $rule_val) {
				if($rule === 'required' && empty($value)) {
					$error[] = "{$field} is required !";
				}elseif(!empty($value)) {
					switch($rule) {
						case 'min':
							if(strlen($value) < $rule_val) {
								$error[] = "{$field} must be at least {$rule_val} characters long!";
							}
						break;
						case 'max':
							if(strlen($value) > $rule_val) {
								$error[] = "{$field} cannot be more than {$rule_val} characters long!";
							}
						break;
						case 'match':
							if($value != $_POST[$rule_val]) {
								$error[] = "Password does not match!";
							}
						break;
						case 'unique':
							try {
								$sql = "SELECT * FROM admin WHERE `{$field}` = '{$value}' LIMIT 1";
								$db->prepare($sql);
								$qry = $db->query($sql);
								$qry->execute();
								$found = $qry->rowCount();
								if($found === 1) {
									$error[] = "<b>{$value}</b> already be used by another User!";
								}
							} catch (PDOException $e) {
								
							}
						break;
					}
				}
			}
		}


		return $error;
	}

	function getValue($field) {
		if(isset($_POST[$field]) && !empty($_POST[$field])) {
			return htmlentities($_POST[$field],ENT_QUOTES, 'utf-8');
		}
	};
?>
