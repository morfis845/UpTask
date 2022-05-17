<div class="container login">
<?php include_once __DIR__.'/../templates/name-page.php'; ?>
    <div class="container-sm">
        <p class="page-description">Iniciar Sesión</p>
        <?php include_once __DIR__.'/../templates/alerts.php'; ?>
        <form action="/" method="POST" class="form">
            <div class="field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Tu Email">
            </div>
            <div class="field">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Tu Contraseña">
            </div>
            <input type="submit" class="button" value="Iniciar Sesión">
        </form>
        <div class="actions">
            <a href="/create">¿Aún no tienes una cuenta? Crear una</a>
            <a href="/forget">¿Olvidaste la contraseña?</a>
        </div>
    </div> <!--container-sm-->
</div>