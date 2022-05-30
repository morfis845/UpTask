<?php include_once __DIR__.'/header-dashboard.php';?>

    <div class="container-sm">
        <?php include_once __DIR__.'/../templates/alerts.php'; ?>
        <form action="/create-project" class="form" method="POST">

        <?php include_once __DIR__.'/form.php' ?>
        <input type="submit" value="Crear Proyecto">
        </form>
    </div>

<?php include_once __DIR__.'/footer-dashboard.php';?>