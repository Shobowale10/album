<?php $page_title='manage user';
    if (!logged_in()) {
        header('location: ?pg=login'); }
    $user = getUser($_SESSION['user']['id']);
?>

<?php require_once('./layout/header.php'); ?>
<div class="container-fluids mt-2">
    <div id="page">
        <!-- REQUIRE HEADER -->
    <?php require_once('./layout/adm-header.php'); ?>
        <main>
            <h3>Manage User</h3> <hr>


        </main>
        <!-- REQUIRE SIDEBAR -->
    <?php require_once('./layout/adm-sidebar.php'); ?>

        </div>
</div>

<?php require_once('./layout/footer.php'); ?>


