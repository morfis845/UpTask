<?php

namespace Controllers;

use MVC\Router;
use Model\Project;
use Model\User;

class DashboardController
{
    public static function index(Router $router)
    {
        session_start();
        isAuth();
        $id =  $_SESSION['id'];
        $projects = Project::belongsTo('userId', $id);
        $router->render('dashboard/index', [
            'title' => 'Proyectos',
            'current' => 'Proyectos',
            'projects' => $projects
        ]);
    }
    public static function create(Router $router)
    {
        session_start();
        isAuth();
        $alerts = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $project = new Project($_POST);
            $alerts = $project->projectValidate();
            if (empty($alerts)) {
                //generate url
                $hash = md5(uniqid());
                $project->url = $hash;
                $project->userId = $_SESSION['id'];
                $project->save();
                header('Location: /project?id=' . $project->url);
            }
        }
        $router->render('dashboard/create', [
            'title' => 'Crear Proyecto',
            'current' => 'Crear Proyecto',
            'alerts' => $alerts
        ]);
    }
    public static function project(Router $router)
    {
        session_start();
        isAuth();
        $token = $_GET['id'];
        if (!$token) header('Location: /dashboard');
        $project = Project::where('url', $token);
        if ($project->userId !== $_SESSION['id']) {
            header('Location: /dashboard');
        }
        $router->render('dashboard/project', [
            'title' => $project->project,
            'current' => 'Proyectos'
        ]);
    }
    public static function perfil(Router $router)
    {
        session_start();
        isAuth();
        $user = User::find($_SESSION['id']);
        $alerts = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user->syncUp($_POST);
            $alerts = $user->validatePerfil();
            if (empty($alerts)) {
                $userExist = User::where('email', $user->email);
                if ($userExist && $userExist->id !== $user->id) {
                    User::setAlert('error', 'El email ya pertenece a otra cuenta, añade uno nuevo');
                } else {
                    $user->save();
                    $_SESSION['name'] = $user->name;
                    $_SESSION['email'] = $user->email;
                    User::setAlert('success', 'Cambio realizado correctamente');
                }
            }
        }
        $alerts = User::getAlerts();
        $router->render('dashboard/perfil', [
            'title' => 'Perfil',
            'current' => 'Perfil',
            'alerts' => $alerts,
            'user' => $user
        ]);
    }
    public static function restore(Router $router){
        session_start();
        isAuth();
        $alerts = [];
        $user = User::find($_SESSION['id']);
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $user = User::find($_SESSION['id']);
            $user->syncUp($_POST);
            $alerts = $user->newPassword();
            if(empty($alerts)){
                $result = $user->checkPassword();
                if($result){
                    $user->password = $user->new_password;
                    $user->hashPassword();
                    $result = $user->save();
                    if($result){
                        User::setAlert('success', 'Contraseña cambiada correctamente');
                    }
                    unset($user->current_password);
                    unset($user->new_password);
                }
                else{
                    User::setAlert('error', 'Contraseña incorrecta');
                }
            }
        }
        $alerts = User::getAlerts();
        $router->render('dashboard/restore_password', [
            'title' => 'Cambiar Contraseña',
            'current' => 'Perfil',
            'alerts' => $alerts
        ]);
    }
}
