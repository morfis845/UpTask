<?php include_once __DIR__.'/header-dashboard.php';?>

<div class="container-sm">
    <?php include_once __DIR__.'/../templates/alerts.php' ?>
    <a href="/restore-password" class="link">Cambiar Contraseña</a>
    <form action="/perfil" method="POST" class="form">
        <div class="field">
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" value="<?php echo $user->name; ?>" placeholder="Cambiar tu nombre">
        </div>
        <div class="field">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?php echo $user->email; ?>" placeholder="Cambiar tu email">
        </div>
        <input type="submit" value="Guardar Cambios">
    </form>
</div>

<?php include_once __DIR__.'/footer-dashboard.php';?>