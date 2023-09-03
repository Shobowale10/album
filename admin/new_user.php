<?php $page_title = 'Create User' ?>
<?php require_once('./layout/header.php'); ?>
<?php 
if(isset($_POST['reg'])) {
	$errors = array();
	$def_fields = array('dept','gender');
	setDefault($def_fields);
	$fields = array(
		'name' => array(
			'required' => true,
			'min' => 3,
			'max' => 20
		),
		'username' => array(
			'required' => true,
			'min' => 3,
			'max' => 20,
			'unique' => true
		),
		'email' => array(
			'required' => true,
			'min' => 5,
			'max' => 50,
			'unique' => true
		),
		'password' => array(
			'required' => true,
			'min' => 6
		),
		'cpassword' => array(
			'required' => true,
			'match' => 'password'
		),
		'phone' => array(
			'required' => true,
			'min' => 11,
			'max' => 11
		),
		'dept' => array(
			'required' => true
		),
		'gender' => array(
			'required' => true
		)
	);
	$errors = array_merge($errors, validate($fields));
	if(empty($errors)) {
		// collect the Data
		$fullname = $_POST['name'];
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$phone = $_POST['phone'];
		$dept = $_POST['dept'];
		$gender = $_POST['gender'];

		// Hash Password
		$hash_pass = password_hash($password, PASSWORD_DEFAULT);
		try {
			$sql = "INSERT INTO admin (`fullname`, `email`, `username`, `password`, `phone`, `dept`, `gender`) VALUES ( :fullname, :email, :username, :password, :phone, :dept, :gender)";
			$query = $db->prepare($sql);
			if($query->execute(array(
				':fullname' => $fullname,
				':email' => $email,
				':username' => $username,
				':password' => $hash_pass,
				':phone' => $phone,
				':dept' => $dept,
				':gender' => $gender
			))) {
				$msg = 'Registration Successful !';
			} else {
				$msg = 'Registration Failed !';
			}
		} catch (PDOException $e) {
			echo($e->getMessage());
		}
	}
}


 ?>
<div class="container mt-5">
	
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<div id="login" style="border: 2px solid tan;padding: 20px; background: lightgray;border-radius: .3em;">
				<h4>Create New Admin User</h4>
	<hr>
	<p class="lead">Already Register , <a href="?pg=login">Login</a> here</p>
	<?php if(!empty($errors)): ?>
		<ul class="text-danger">
			<?php foreach($errors as $error): ?>
				<li><?php echo($error) ?></li>
		<?php endforeach; ?>
		</ul>
	<?php endif; ?>
	<?php if(!empty($msg)): ?>
	<p><?php echo($msg) ?></p>
<?php endif; ?>
			<form method="POST">
				<div class="row">
					<div class="col-sm-6">
				<div class="form-group">
			<label for="">Fullname</label>
			<input type="text" name="name" class="form-control" placeholder="Fullname" value="<?php echo(getValue('name')) ?>">
		</div>		
					</div>
					<div class="col-sm-6">
						<div class="form-group">
			<label for="">Username</label>
			<input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo(getValue('username')) ?>">
		</div>
					</div>
				</div>
		<div class="form-group">
			<label for="">E-mail</label>
			<input type="text" name="email" class="form-control" placeholder="E-mail address" value="<?php echo(getValue('email')) ?>">
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
			<label for="">Password</label>
			<input type="password" name="password" class="form-control" placeholder="Password">
		</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
			<label for="">Confirm Password</label>
			<input type="password" name="cpassword" class="form-control" placeholder="confirm Password">
		</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4">
				<div class="form-group">
					<label for="">Phone Number</label>
					<input type="text" name="phone" class="form-control" placeholder="Phone Number" value="<?php echo(getValue('phone')) ?>">
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label for="">Department</label>
					<select name="dept" id="dept" class="form-control">
						<option disabled selected>-- Choose Department --</option>
						<option value="it" <?php echo(isset($_POST['dept']) && $_POST['dept'] === 'it' ? 'selected' : ''); ?>>IT</option>
						<option value="finance" <?php echo(isset($_POST['dept']) && $_POST['dept'] === 'finance' ? 'selected' : ''); ?>>Finance</option>
						<option value="marketing" <?php echo(isset($_POST['dept']) && $_POST['dept'] === 'marketing' ? 'selected' : ''); ?>>Marketing</option>
					</select>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label>Gender</label> <br>
					<label><input type="radio" name="gender" value="male" <?php echo(isset($_POST['gender']) && $_POST['gender'] === 'male' ? 'checked' : ''); ?>> Male</label>
					<label><input type="radio" name="gender" value="female" <?php echo(isset($_POST['gender']) && $_POST['gender'] === 'female' ? 'checked' : ''); ?>> Female</label>
				</div>
			</div>
		</div>
		<p><button type="submit" name="reg" class="btn btn-primary"> Create Account</button></p>
	</form>
			</div>
		</div>
		<div class="col-sm-2"></div>
	</div>
</div>

<?php require_once('./layout/footer.php'); ?>
<?php if(!empty($msg)): ?>
	<?php $msg = ''; ?>
<?php endif; ?>
<?php if(!empty($errors)): ?>
		<?php unset($errors) ?>
	<?php endif; ?>
	<script>
		if(window.history.replaceState) {
			window.history.replaceState(null,null,window.location.href);
		}
	</script>