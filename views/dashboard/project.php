<?php include_once __DIR__.'/header-dashboard.php';?>

<div class="container-sm">
    <div class="container-new-task">
        <button type="button" class="save-task" id="save-task"> 
            &#43; Nueva Tarea
        </button>
    </div>

    <div class="filter" id="filter">
        <div class="filter-input">
            <h2>Filtros:</h2>
            <div class="field">
                <label for="all">Todas</label>
                <input type="radio" name="filter" id="all" value="" checked>
            </div>
            <div class="field">
                <label for="completed">Completadas</label>
                <input type="radio" name="filter" id="completed" value="1">
            </div>
            <div class="field">
                <label for="pending">Pendientes</label>
                <input type="radio" name="filter" id="pending" value="0">
            </div>
        </div>
    </div>

    <ul id="list-tasks" class="list-tasks">

    </ul>
</div>

<?php include_once __DIR__.'/footer-dashboard.php';?>
<?php  

$script .= '
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="build/js/tasks.js"></script>
';

?>