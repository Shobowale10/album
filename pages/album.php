<?php
	$page_title = 'Album List';
	require_once('./layout/header.php'); 

    try {
	    $pg_sql = "SELECT * FROM album";
	    $db->prepare($pg_sql);
	    $pg_qry = $db->query($pg_sql);
	    $pg_qry->execute();
	    $totalrecord = $pg_qry->rowCount();
	}   catch (PDOException $e) {
		
	}


    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $recordperpage = isset($_GET['ppg']) ? (int)$_GET['ppg'] : 7;
    $startpage = ($page - 1) * $recordperpage;
    $totalpage = ceil($totalrecord/$recordperpage);
    $serialno = $startpage + 1;
?>


	<div class="container mt-5">
		<div class="row">
			<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<h1 class="text-center">ALBUM LIST</h1>
				<hr>

				<?php 
					$sql = "SELECT * FROM album LIMIT {$recordperpage} OFFSET {$startpage}";
					$db->prepare($sql);
					$query = $db->query($sql);
					$query->execute();

					if($query->rowCount() != 0) { ?>
						<div class="row">
							<div class="col">
								<p>Welcome, <a href="?pg=login">Login</a> here </p>
							</div>
							<div class="col">
							<?php if($page == 1 && $totalrecord < 10) { ?>
								<p class="lead text-right">Showing Record <?php echo($serialno) ?> - <?php echo($totalrecord) ?> of <?php echo($totalrecord) ?> Record</p>
							<?php } elseif($page == $totalrecord) { ?>
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
									<th>Artist</th>
									<th>Label</th>
									<th>Released</th>
									<th>No of Track</th>
								</tr>
							</thead>

							<tbody class="text-center">
								<?php 
									while($album = $query->fetch(PDO::FETCH_OBJ)): ?>
										 $a_id = $album->id;?>
											<tr>
												<td><?php echo($serialno); ?></td>
												<td><?php echo($album->title); ?></td>
												<td><?php echo($album->artist); ?></td>
												<td><?php echo($album->label); ?></td>
												<td><?php echo(((int)$album->released)); ?></td>
												<td>
													<?php 
														try {
															$t_sql = "SELECT * FROM `track` WHERE `album_id` = {$a_id}";
															$db->prepare($t_sql);
															$t_qry = $db->query($t_sql);
															$t_qry->execute();
															$t_num = $t_qry->rowCount();
														} catch (PDOException $e) {}
														echo($t_num);
													?>
												</td>
											</tr>
										<?php $serialno++;
									endwhile; 
								?>
							</tbody>
						</table>

						<hr>
						<p class="text-right font-weight-bolder">Page<?php echo($page)?> of <?php echo($totalpage)?></p>
						<?php } else { ?>
							<p>No Information to Showcase this Time</p>
						<?php 
					} ?>
				</div>
			</div>
		</div>

		<script>
			var ppg = document.getElementById('ppg');
			var frm = document.forms.getPpg;
			ppg.addEventListener('change', function() {
				frm.submit();
			});	
		</script>

		<?php require_once('./layout/footer.php'); ?>

