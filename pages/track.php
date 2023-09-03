<?php $page_title = 'Track List' ?>
<?php require_once('../layout/header.php');
require_once('../includes/function.php'); ?>
<?php 
try {
	$pg_sql = "SELECT * FROM track";
	$db->prepare($pg_sql);
	$pg_qry = $db->query($pg_sql);
	$pg_qry->execute();
	$ttrec = $pg_qry->rowCount();
}  catch (PDOException $e) {
	
}
$pg = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$ppg = isset($_GET['ppg']) ? (int)$_GET['ppg'] : 10;
$ttpg = ceil($ttrec / $ppg);
 $start_pg = ($pg - 1) * $ppg;
 if($pg == 1) {
 	$sn = 1;
 } else {
 	$sn = $start_pg + 1;
 }
?>


	<div class="container mt-5">
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
				<h1 class="text-center">TRACK LIST</h1>
	<hr>
	<?php 
$sql = "SELECT * FROM track LIMIT {$ppg} OFFSET {$start_pg}";
$db->prepare($sql);
$query = $db->query($sql);
$query->execute();

	// $albums = $query->fetchAll();
	

if($query->rowCount() != 0) {
	 ?>
	<div class="row">
		<div class="col">
			<p>Welcome, <a href="?pg=login">Login</a> here </p>
			<form name="getPpg">
		<label for="ppg">Showing </label>
		<input type="hidden" name="pg" value="track">
		<select name="ppg" id="ppg">
			<option value="5" <?php echo((isset($ppg) && $ppg == 5) ? 'selected' : ''); ?>>5</option>
			<option value="10" <?php echo((isset($ppg) && $ppg == 10) ? 'selected' : ''); ?>>10</option>
			<option value="15" <?php echo((isset($ppg) && $ppg == 15) ? 'selected' : ''); ?>>15</option>
			<option value="20" <?php echo((isset($ppg) && $ppg == 20) ? 'selected' : ''); ?>>20</option>
		</select>
	</form>
		</div>
		<div class="col">

			 <?php if($pg == 1 && $ttrec < 10) { ?>
<p class="lead text-right">Showing Record <?php echo($sn) ?> - <?php echo($ttrec) ?> of <?php echo($ttrec) ?> Record</p>
	 <?php } elseif($pg == $ttpg) { ?>
<p class="lead text-right">Showing Record <?php echo($sn) ?> - <?php echo($ttrec) ?> of <?php echo($ttrec) ?> Record</p>
	 <?php } else { ?>
<p class="lead text-right">Showing Record <?php echo($sn) ?> - <?php echo(($ppg + $sn) - 1) ?> of <?php echo($ttrec) ?> Record</p>
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
		</tr>
	</thead>
	<tbody class="text-center">
		<?php 

		while($track = $query->fetch(PDO::FETCH_OBJ)): ?>
<tr>
	<td><?php echo($sn); ?></td>
	<td><?php echo($track->title); ?></td>
	<td><?php echo($track->track_number); ?></td>
	<td><?php echo(format_time((int)$track->duration)); ?></td>
</tr>

		<?php
$sn++;
		 endwhile; ?>
	</tbody>
</table>
<ul class="pagination pagination-sm justify-content-center">
	<?php if($pg > 1) { ?>
		<li class="page-item"><a href="?pg=track&page=<?php echo($pg - 1) ?>&ppg=<?php echo($ppg); ?>" class="page-link">Prev</a></li>
	<?php } ?>
	<?php for($i = 1; $i <= $ttpg; $i++): ?>
		<?php if($pg == $i) { ?>
			<li class="page-item active"><a href="#" class="page-link disabled" ><?php echo($i) ?></a></li>
		<?php } else { ?>
			<li class="page-item"><a href="?pg=track&page=<?php echo($i) ?>&ppg=<?php echo($ppg); ?>" class="page-link"><?php echo($i) ?></a></li>
		<?php } ?>
<?php endfor; ?>
<?php if($pg < $ttpg) { ?>
		<li class="page-item"><a href="?pg=track&page=<?php echo($pg + 1) ?>&ppg=<?php echo($ppg); ?>" class="page-link">Next </a></li>
	<?php } ?>
</ul>
<hr>

<p class="text-right font-weight-bold">Page <?php echo($pg); ?> of <?php echo($ttpg); ?> Pages</p>
<?php } else { ?>
	<p>No Information to Showcase this Time</p>
<?php } ?>
			</div>
			<div class="col-sm-2"></div>
		</div>
	</div>
<?php require_once('./layout/footer.php'); ?>
	<script>
var ppg = document.getElementById('ppg');
var frm = document.forms.getPpg;
ppg.addEventListener('change', function() {
	frm.submit();
});	

	</script>

