<?php $page_title = 'Manage Album';
	if(!logged_in()) {
 		header('Location: ?pg=login'); }
 		$user = getUser($_SESSION['user']['id']);
?>

<?php require_once('./layout/header.php'); ?>
<div class="container-fluid mt-2">
	<div id="page">
		<!-- REQUIRE HEADER -->
	<?php require_once('./layout/adm-header.php') ?>
		<!-- REQUIRE SIDEBAR -->
	<?php require_once('./layout/adm-sidebar.php'); ?>
	
	<?php 
    try {
	    $pg_sql = "SELECT * FROM album";
	    $db->prepare($pg_sql);
	    $pg_qry = $db->query($pg_sql);
	    $pg_qry->execute();
	    $totalrecord = $pg_qry->rowCount();}
		catch (PDOException $e) {

	}
    	$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    	$recordperpage = isset($_GET['ppg']) ? (int)$_GET['ppg'] : 7;
    	$startpage = ($page - 1) * $recordperpage;
    	$totalpage = ceil($totalrecord/$recordperpage);
    	$serialno = $startpage + 1;
	?>

<main>
	<div id="content" style="border: 1px solid lightgray; min-height: 90%;padding: 20px; border-radius: .7em">
		<div class="row">
			<div class="col-sm-8">
				<h3>Manage Album</h3>
			</div>
			<div class="col-sm-4">
				<p class="text-right"><a href="?pg=action&a=new" class="btn btn-primary ">Add New Album</a></p>
			</div>
		</div>
		<hr>
	<?php 
        $sql = "SELECT * FROM album LIMIT {$recordperpage} OFFSET {$startpage}";
        $db->prepare($sql);
        $query = $db->query($sql);
        $query->execute();
        if($query->rowCount() != 0) {
	    ?>
        <div class="row">
            
        </div>

	<table class="table table-bordered table-sm">
		<thead class="bg-dark text-light text-center text-uppercase">
			<tr>
				<th>S/N</th>
				<th>Album Title</th>
				<th>Album Artist</th>
				<th colspan="2">Action</th>
			</tr>
		</thead>
				
		<tbody class="text-center">
		<?php
		while($album = $query->fetch(PDO::FETCH_OBJ)): ?>
			<tr>
				<td><?php echo($serialno); ?></td>
				<td><?php echo($album->title); ?></td>
				<td><?php echo($album->artist); ?></td>
				<td><a href="?pg=action&id=<?php echo($album->id) ?>&a=view"><i class="fa fa-binoculars text-primary"></i> View</a></td>
				<td><a href="?pg=action&id=<?php echo($album->id) ?>&a=del"><i class="fa fa-trash text-danger"></i></a></td>
				
			</tr>
		<?php
            $serialno++;
	    endwhile; ?>
		</tbody>
	</table>
	<p class="text-right font-weight-bolder">Page<?php echo($page)?> of <?php echo($totalpage)?></p>
	</div>
</div>
        <?php } else { ?>
	        <p>No Album has been added !</p>
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