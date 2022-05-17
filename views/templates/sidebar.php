<aside class="sidebar">
    <div class="container-sidebar">
        <a href="/dashboard">
            <h2>UpTask</h2>
        </a>
        <div class="close-menu">
            <img src="build/img/close.svg" id="close-menu" alt="">
        </div>
    </div>
    <nav class="sidebar-nav">
        <a class="<?php echo ($current === 'Proyectos') ? 'active' :  ''; ?>" href="/dashboard">Proyectos</a>
        <a class="<?php echo ($current === 'Crear Proyecto') ? 'active' :  ''; ?>" href="/create-project">Crear Proyecto</a>
        <a class="<?php echo ($current === 'Perfil') ? 'active' :  ''; ?>" href="/perfil">Perfil</a>
    </nav>
    <div class="close-session-mobile">
        <a href="/logout" class="close-session">Cerrar Sesión</a>
    </div>
</aside>