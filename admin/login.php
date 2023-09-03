<?php $page_title = 'Login Page' ?>
<?php require_once('../layout/header.php');
if(isset($_POST['login'])) {
	$errors = array();
	$fields = array(
		'eUser' => array(
			'required' => true,
		),
		'password' => array(
			'required' => true
		)
	);
	$errors = array_merge($errors, ($fields));
	if(empty($errors)) {
		$eUser = $_POST['eUser'];
		$password = $_POST['password'];
		try {
			$sql = "SELECT * FROM admin WHERE `email` = '{$eUser}' OR `username` = '{$eUser}' LIMIT 1";
			$db->prepare($sql);
			$query = $db->query($sql);
			$query->execute();
			if($query->rowCount() === 1) {
				$user = $query->fetch(PDO::FETCH_OBJ);
				$hash_pass = $user->password;
				if(password_verify($password, $hash_pass)) {
					$_SESSION['user']['id'] = $user->id;
					header('Location: ?pg=index');
				} else {
					$msg = "E-mail / Username / Password combination Error !";
				}
			} else {
				$msg = "Unrecognized User Credential !";
			}
		} catch (Exception $e) {
			
		}
	}
}


 ?>
<div class="container mt-5">
	
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-6">
			<div id="login" style="border: 2px solid tan;padding: 20px; background: lightgray;border-radius: .3em;">
				<h4>Admin Login</h4>
	<hr>
	<?php if(!empty($msg)): ?>
	<p class="text-danger"><?php echo($msg) ?></p>
<?php endif; ?>
<?php if(!empty($errors)): ?>
		<ul class="text-danger">
			<?php foreach($errors as $error): ?>
				<li><?php echo ($error) ?></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
			<form method="POST">
		<div class="form-group">
			<label for="">E-mail or Username</label>
			<input type="text" name="eUser" class="form-control" placeholder="E-mail or Username">
		</div>
		<div class="form-group">
			<label for="">Password</label>
			<input type="password" name="password" class="form-control" placeholder="Password">
		</div>
		<p><button type="submit" name="login" class="btn btn-primary"> Login</button></p>
	</form>
	<p>Are you New, <a href="?pg=new_user">Register</a> Here</p>
			</div>
		</div>
		<div class="col-sm-3"></div>
	</div>
</div>

<?php require_once('../layout/footer.php'); ?>
<?php if(!empty($msg)): ?>
	<?php $msg = ''; ?>
<?php endif; ?>
<script>
		if(window.history.replaceState) {
			window.history.replaceState(null,null,window.location.href);
		}
	</script>