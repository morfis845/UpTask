<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\DashboardController;
use Controllers\LoginController;
use Controllers\ProjectController;
use Controllers\TaskController;
use MVC\Router;
$router = new Router();


$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);
$router->get('/create', [LoginController::class, 'create']);
$router->post('/create', [LoginController::class, 'create']);

$router->get('/forget', [LoginController::class, 'forget']);
$router->post('/forget', [LoginController::class, 'forget']);

$router->get('/restore', [LoginController::class, 'restore']);
$router->post('/restore', [LoginController::class, 'restore']);

$router->get('/confirm-account', [LoginController::class, 'confirm_account']);
$router->get('/message', [LoginController::class, 'message']);


//** Privates Pages
$router->get('/dashboard', [DashboardController::class, 'index']);
$router->get('/create-project', [DashboardController::class, 'create']);
$router->post('/create-project', [DashboardController::class, 'create']);
$router->get('/project', [DashboardController::class, 'project']);
$router->get('/perfil', [DashboardController::class, 'perfil']);
$router->post('/perfil', [DashboardController::class, 'perfil']);
$router->get('/restore-password', [DashboardController::class, 'restore']);
$router->post('/restore-password', [DashboardController::class, 'restore']);
//Private Pages**

//API tasks
$router->get('/api/tasks', [TaskController::class, 'index']);
$router->post('/api/task', [TaskController::class, 'create']);
$router->post('/api/task/update', [TaskController::class, 'update']);
$router->post('/api/task/delete', [TaskController::class, 'delete']);

//API projects
$router->get('/api/projects', [ProjectController::class, 'index']);
$router->get('/api/project/create', [ProjectController::class, 'create']);
$router->post('/api/project/update', [ProjectController::class, 'update']);
$router->post('/api/project/delete', [ProjectController::class, 'delete']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();