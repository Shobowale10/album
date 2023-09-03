<?php $page_title = 'Manage Track';
require_once('../includes/function.php');
 if(!logged_in()) {
 	header('location: ?pg=login'); }
	$user = getUser($_SESSION['user']['id']);
?>
<?php require_once('./layout/header.php'); ?>
<div class="container-fluid mt-2">
	<div id="page">
		<!-- REQUIRE HEADER -->
	<?php require_once('./layout/adm-header.php') ?>
		<!-- REQUIRE SIDEBAR -->
	<?php require_once('./layout/adm-sidebar.php') ?>

	<?php 
	try {
		$pg_sql = "SELECT * FROM track";
		$db->prepare($pg_sql);
		$pg_qry = $db->query($pg_sql);
		$pg_qry->execute();
		$totalrecord = $pg_qry->rowCount();
	} catch (PDOException $e) {
	
	}
		$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
		$recordperpage = isset($_GET['ppg']) ? (int)$_GET['ppg'] : 10;
		$totalpage = ceil($totalrecord / $recordperpage);
		$startpage = ($page - 1) * $recordperpage;
 	if($page == 1) {
 		$serialno = 1;
 	}else {
 		$serialno = $startpage + 1;
 	}
	?>

	<main>
		<div id="content" style="border:1px solid lightgrey;padding:1.2em; min-height:90%; border-radius:0.7em">
			<h3>Manage Track</h3>
			<hr>
	<?php 
		$sql = "SELECT * FROM track LIMIT {$recordperpage} OFFSET {$startpage}";
		$db->prepare($sql);
		$query = $db->query($sql);
		$query->execute();
	if($query->rowCount() != 0) {
	?>
	<div class="row">
		<div class="col">
		<?php if($page == 1 && $totalrecord < 10) { ?>
			<p class="lead text-right">Showing Record <?php echo($serialno) ?> - <?php echo($totalrecord) ?> of <?php echo($totalrecord) ?> Record</p>
		<?php } elseif($page == $totalpage) { ?>
			<p class="lead text-right">Showing Record <?php echo($serialno) ?> - <?php echo($totalrecord) ?> of <?php echo($totalrecord) ?> Record</p>
		<?php } else { ?>
			<p class="lead text-right">Showing Record <?php echo($serialno) ?> - <?php echo(($recordperpage + $serialno) - 1) ?> of <?php echo($totalrecord) ?> Record</p>
		<?php } ?>
		</div>
	</div>

	<table class="table table-bordered table-sm">
		<thead class="bg-dark text-light text-center text-uppercase">
			<tr>
				<th>S/N</th>
				<th>title</th>
				<th>Track Number</th>
				<th>Duration</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody class="text-center">
		<?php 

		while($track = $query->fetch(PDO::FETCH_OBJ)): ?>
			<tr>
				<td><?php echo($serialno); ?></td>
				<td><?php echo($track->title); ?></td>
				<td><?php echo($track->track_number); ?></td>
				<td><?php echo(format_time((int)$track->duration)); ?></td>
			</tr>
		<?php
			$serialno++;
		endwhile; ?>
		</tbody>
	</table>
	<ul class="pagination pagination-sm justify-content-center">
		<?php if($page > 1) { ?>
			<li class="page-item"><a href="?pg=manage_track&page=<?php echo($page) ?>" class="page-link">Prev</a></li>
		<?php } ?>
		<?php for($i = 1; $i <= $totalpage; $i++): ?>
		<?php if($page == $i) { ?>
			<li class="page-item active"><a href="?pg=manage_track&page=<?php echo($i) ?>" class="page-link disabled"><?php echo($i) ?></a></li>
		<?php } else { ?>
			<li class="page-item"><a href="?pg=manage_track&page=<?php echo($i) ?>" class="page-link"><?php echo($i) ?></a></li>
		<?php } ?>
		<?php endfor; ?>
		<?php if($page <
		 $totalpage) { ?>
			<li class="page-item"><a href="?pg=manage_track&page=<?php echo($page + 1) ?>"class="page-link">Next </a></li>
		<?php } ?>
	</ul>
		<p class="text-right font-weight-bold">Page <?php echo($page); ?> of <?php echo($totalpage); ?> Pages</p>
		</div>
	</div>
		<?php } else { ?>
			<p>No Track has been added !</p>
		<?php } ?>
	</div>
</div>
</main>

<?php require_once('./layout/footer.php'); ?>
<script>
	var ppg = document.getElementById('ppg');
	var frm = document.forms.getPpg;
	ppg.addEventListener('change', function() {
	frm.submit();
	});	
</script>
