<?php include_once __DIR__.'/header-dashboard.php';?>

<div class="container-sm">
    <?php include_once __DIR__.'/../templates/alerts.php' ?>
    <a href="/perfil" class="link">Volver a Perfil</a>
    <form action="/restore-password" method="POST" class="form">
        <div class="field">
            <label for="current_password">Contraseña actual</label>
            <input type="password" name="current_password" id="current_password" placeholder="Tu contraseña">
        </div>
        <div class="field">
            <label for="new_password">Nueva Contraseña</label>
            <input type="password" name="new_password" id="new_password" placeholder="Nueva contraseña">
        </div>
        <input type="submit" value="Guardar Cambios">
    </form>
    <div class="actions">
        <a href="/forget">¿Olvidaste la contraseña?</a>
    </div>
</div>

<?php include_once __DIR__.'/footer-dashboard.php';?>