<?php $page_title = 'Homepage' ?>
<?php require_once('../layout/header.php'); ?>

	<div class="jumbotron">
		<div class="container">
			<header class="text-center">
					<h1>Album Galleria Project</h1>
				<hr>
				<p>This is an Album Collection Gallery with Tracks with Bunch of funtionalities to demonstrate PHP Power as a Web Development Language with CRUD functionalities with MYSQL</p>
				
			</header>
		</div>
	</div>

	<div class="container mt-3">
		<div class="row">
			<div class="col-sm-3"></div>
				<div class="col-sm-6">
					<div class="row">
						<div class="col-sm-6">
							<div class="card" style="width:200px">
								<i class="card-img-top fa fa-calendar"></i>
								<div class="card-body">
									<h4 class="card-title">Album</h4>
									<p class="card-text">A library of various album collections</p>
									<a href="album.php" class="btn btn-primary btn-block">View</a>
								</div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="card" style="width:200px">
								<i class="card-img-top fa fa-calendar"></i>
								<div class="card-body">
									<h4 class="card-title">Track</h4>
									<p class="card-text">A library of various track collections</p>
									<a href="track.php" class="btn btn-primary btn-block">View</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			<div class="col-sm-3"></div>
		</div>


		<div>
			<p><a href="../admin/login.php?pg=login">Admin Login</a></p>
		</div>
	</div>
<?php require_once('../layout/footer.php'); ?>