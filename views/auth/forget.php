<div class="container forget">
<?php include_once __DIR__.'/../templates/name-page.php'; ?>
    <div class="container-sm">
        <p class="page-description">Restablecer Contraseña</p>
        <?php include_once __DIR__.'/../templates/alerts.php';
        if(!$show) return; ?>
        <form action="/forget" method="POST" class="form">
            <div class="field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Tu Email">
            </div>
            <input type="submit" class="button" value="Restablecer">
        </form>
        <div class="actions">
            <a href="/">¿Ya tienes una cuenta? Iniciar Sesión</a>
            <a href="/create">¿Aún no tienes una cuenta? Crear una</a>
        </div>
    </div> <!--container-sm-->
</div>