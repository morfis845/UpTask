<div class="container create">
<?php include_once __DIR__.'/../templates/name-page.php'; ?>
    <div class="container-sm">
        <p class="page-description">Registrate</p>
        <?php include_once __DIR__.'/../templates/alerts.php'; ?>
        <form action="/create" method="POST" class="form">
            <div class="field">
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" placeholder="Tu Nombre" value="<?php echo $user->name; ?>">
            </div>
            <div class="field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Tu Email" value="<?php echo $user->email; ?>">
            </div>
            <div class="field">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Tu Contraseña">
            </div>
            <div class="field">
                <label for="repeat-password">Repetir contraseña</label>
                <input type="password" id="repeat-password" name="repeat-password" placeholder="Repite tu Contraseña">
            </div>
            <input type="submit" class="button" value="Registrate">
        </form>
        <div class="actions">
            <a href="/">¿Ya tienes una cuenta? Iniciar Sesión</a>
            <a href="/forget">¿Olvidaste la contraseña?</a>
        </div>
    </div> <!--.container-sm-->
</div>