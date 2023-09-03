<aside>
		<div class="list-group mb-3 list-group-flush">
  <a href="?pg=manage_album&a=manage_album" class="list-group-item list-group-item-action">Manage Album</a>
  <a href="?pg=manage_track&a=manage_track" class="list-group-item list-group-item-action">Manage Track</a>
  <a href="?pg=manage_user&a=manage_user" class="list-group-item list-group-item-action">Manage User</a>
  <?php if(!empty($_SESSION['user']['id'])): ?>
<a class="list-group-item list-group-item-action" href="?pg=logout">Logout</a>
	<?php endif; ?>
</div>

	</aside>