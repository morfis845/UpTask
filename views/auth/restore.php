<div class="container restore">
<?php include_once __DIR__.'/../templates/name-page.php'; ?>
    <div class="container-sm">
        <p class="page-description">Coloca tu nueva contraseña</p>
        <?php include_once __DIR__.'/../templates/alerts.php'; ?>
        <?php if($alerts) return; ?>
        <form method="POST" class="form">
            <div class="field">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Tu Contraseña">
            </div>
            <input type="submit" class="button" value="Restablecer">
        </form>
    </div> <!--container-sm-->
</div>