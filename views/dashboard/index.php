<?php include_once __DIR__ . '/header-dashboard.php'; ?>

<?php if (count($projects) === 0) : ?>
    <p class="empty-projects">No Hay Proyectos aún <a href="/create-project">Comienza creando uno</a></p>
<?php else : ?>
    <ul class="list-projects">
        <?php foreach ($projects as $project) : ?>
            <div class="project" id="<?php echo $project->id; ?>">
            <a href="/project?id=<?php echo $project->url; ?>">
                <li class="project-li">
                    <?php echo $project->project; ?>
                </li>
            </a>
            <div class="icons">
                <svg class="edit" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="16 3 21 8 8 21 3 21 3 16 16 3"></polygon>
                </svg>
                <svg  class="delete" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="3 6 5 6 21 6"></polyline>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    <line x1="10" y1="11" x2="10" y2="17"></line>
                    <line x1="14" y1="11" x2="14" y2="17"></line>
                </svg>
            </div>
            </div>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php include_once __DIR__ . '/footer-dashboard.php'; ?>

<?php

$script .= '
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="build/js/project.js"></script>
'

?>