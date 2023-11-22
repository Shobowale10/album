<?php $page_title = 'Dashboard';
	if(!logged_in()) {
		header('Location: ?pg=login');
	}
	$user = getUser($_SESSION['user']['id']);

	require_once('./layout/header.php'); ?>

<div class="container-fluid mt-2">
	<div id="page"> 
			
		<!-- require Header -->
		<?php require_once('./layout/adm-header.php') ?>
			<main>
				<h3>Admin Dashboard</h3>
				<hr>
				<p>Welcome to Admin Dashboard</p>
			</main>
			<!-- Required Sidebar -->
		<?php require_once('./layout/adm-sidebar.php') ?>
	</div>
	