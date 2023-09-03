<?php $page_title = 'Action Page';
	if(!logged_in()) {
 		header('Location: ?pg=login'); }
 		$user = getUser($_SESSION['user']['id']);
 if(isset($_GET['a']) && isset($_GET['id'])) {
 	$id = $_GET['id'];
 	$action = $_GET['a'];
 	if($action === 'del') {
 		header('Location: ?pg=manage_album');
 	} elseif($action === 'view') {
 		try {
 			$sql = "SELECT * FROM album WHERE `id` = {$id} LIMIT 1";
 			$db->prepare($sql);
 			$query = $db->query($sql);
 			$query->execute();
 			if($query->rowCount() === 1) {
 				$album = $query->fetch(PDO::FETCH_OBJ);
 			} else {
 				$album = null;
 			}
 		} catch (PDOException $e) {
 			
 		}
 		
 	}
 }
 // update
 if(isset($_POST['update'])) {
	// Collect the album details
	$title = addslashes($_POST['title']);
	$artist = addslashes($_POST['artist']);
	$label = addslashes($_POST['label']);
	$dateReleased = addslashes($_POST['dateReleased']);
	$a_id = addslashes($_POST['album']);
	try {
		$u_sql = "UPDATE `album` SET `title` = '{$title}', `artist` = '{$artist}', `label` = '{$label}', `released` = '{$dateReleased}' WHERE `id` = ".$a_id. " LIMIT 1";
		$u_qry = $db->prepare($u_sql);
		if($u_qry->execute()) {
			header('Location: ?pg=manage_album');
		}
	} catch (PDOException $e) {
		
	}
 }
?>

<?php require_once('./layout/header.php'); ?>
<div class="container-fluid mt-2">
	<div id="page">
		<!-- REQUIRE HEADER -->
	<?php require_once('./layout/adm-header.php') ?>
		<!-- REQUIRE SIDEBAR -->
	<?php require_once('./layout/adm-sidebar.php'); ?>
		<main>

	<div id="content" style="border: 1px solid lightgray; min-height: 90%;padding: 20px; border-radius: .7em">
		<?php if(!empty($album)) { ?>
		<h3>Manage Album</h3>
		<hr>
		<form action="" method="POST">
			<div class="form-group">
				<label for="title">Album Title</label>
				<input type="text" value="<?php echo($album->title) ?>" class="form-control" name="title">
			</div>
			<div class="form-group">
				<label for="title">Album Artist</label>
				<input type="text" value="<?php echo($album->artist) ?>" class="form-control" name="artist">
			</div>
			<div class="form-group">
				<label for="title">Album Label</label>
				<input type="text" value="<?php echo($album->label) ?>" name="label" class="form-control">
			</div>
			<div class="form-group">
				<label for="title">Album Released Date</label>
				<input type="date" value="<?php echo($album->released) ?>" name="dateReleased" class="form-control">
			</div>
			<input type="hidden" name="album" value="<?php echo($album->id) ?>">
			<p><button type="submit" name="update">Update</button></p>
		</form>
	<?php } else { ?>
	<form action="" method="POST">
			<div class="form-group">
				<label for="title">Album Title</label>
				<input type="text" class="form-control" name="title">
			</div>
			<div class="form-group">
				<label for="title">Album Artist</label>
				<input type="text" class="form-control" name="artist">
			</div>
			<div class="form-group">
				<label for="title">Album Label</label>
				<input type="text"  name="label" class="form-control">
			</div>
			<div class="form-group">
				<label for="title">Album Released Date</label>
				<input type="date"  name="dateReleased" class="form-control">
			</div>
			<p><button type="submit" name="add_new">Create Album</button></p>
		</form>
	<?php } ?>
	</div>
</main>
</div>
</div>
<?php require_once('./layout/footer.php'); ?>