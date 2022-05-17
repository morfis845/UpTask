<?php

namespace Controllers;

use Classes\Email;
use Model\User;
use MVC\Router;

class LoginController
{
    public static function login(Router $router)
    {
        $alerts = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new User($_POST);
            $alerts = $auth->validateLogin();
            if (empty($alerts)) {
                $user = User::where('email', $auth->email);
                if ($user) {
                    //debuguear($user);
                    if ($user->checkPasswordAndConfirmed($auth->password)) {
                        session_start();
                        $_SESSION['id'] = $user->id;
                        $_SESSION['name'] = $user->name;
                        $_SESSION['email'] = $user->email;
                        $_SESSION['login'] = true;
                        header('Location: /dashboard');
                    }
                }
                else {
                    User::setAlert('error', 'Email o Contraseña incorrecta');
                }
                //debuguear($userExist);
            }
        }
        $alerts = User::getAlerts();
        $router->render('auth/login', [
            'title' => 'Iniciar Sesión',
            'alerts' => $alerts
        ]);
    }
    public static function logout()
    {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }
    public static function create(Router $router)
    {
        $user = new User;
        $alerts = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User($_POST);
            $alerts = $user->validateNewAccount();
            if (empty($alerts)) {
                $userExist = User::where('email', $user->email);
                if ($userExist) {
                    User::setAlert('error', 'El usuario ya existe');
                    $alerts = User::getAlerts();
                } else {
                    $user->hashPassword();
                    unset($user->repeat_password);
                    $user->tokenGenerate();
                    $result = $user->save();
                    $email = new Email($user->name, $user->email, $user->token);
                    $email->sendEmail();
                    if ($result) {
                        header('Location: /message');
                    }
                }
            }
        }
        $router->render('auth/create', [
            'title' => 'Crear Cuenta',
            'user' => $user,
            'alerts' => $alerts
        ]);
    }
    public static function forget(Router $router)
    {
        session_start();
        $show = true;
        $alerts = [];
        if($_SESSION) $_SESSION = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User($_POST);
            $alerts = $user->emailValidate();
            if (empty($alerts)) {
                $user = User::where('email', $user->email);
                if ($user && $user->confirmed) {
                    $user->tokenGenerate();
                    unset($user->repeat_password);
                    $user->save();
                    $email = new Email($user->name, $user->email, $user->token);
                    $email->restorePassword();
                    $show = false;
                    User::setAlert('success', 'Hemos enviado las instrucciones a tu email');
                } else {
                    User::setAlert('error', 'El Usuario no existe o no está confirmado');
                }
            }
        }
        $alerts = User::getAlerts();
        $router->render('auth/forget', [
            'title' => 'Restablecer Contraseña',
            'alerts' => $alerts,
            'show' => $show
        ]);
    }
    public static function restore(Router $router)
    {
        $token = s($_GET['token']);
        if(!$token) header('Location: /');
        $user = User::where('token', $token);
        $alerts = [];
        if ($user) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $password = new User($_POST);
                $alerts = $password->validateRestore();
                if (empty($alerts)) {
                    $user->password = null;
                    $user->password = $password->password;
                    $user->hashPassword();
                    $user->token = '';
                    $result = $user->save();
                    if ($result) {
                        header('Location: /');
                    }
                }
            }
        } else {
            User::setAlert('error', 'Token no Valido');
        }

        $alerts = User::getAlerts();
        $router->render('auth/restore', [
            'title' => 'Restablecer Contraseña',
            'alerts' => $alerts
        ]);
    }
    public static function message(Router $router)
    {
        $router->render('auth/message', [
            'title' => 'Confirma tu Cuenta'
        ]);
    }
    public static function confirm_account(Router $router)
    {
        $token = s($_GET['token']);
        if (!$token) header('Location: /');

        $user = User::where('token', $token);

        if (empty($user)) {
            User::setAlert('error', 'Token no valido');
        } else {
            $user->confirmed = 1;
            unset($user->repeat_password);
            $user->token = '';
            $user->save();
            User::setAlert('success', 'Cuenta Confirmada');
        }


        $alerts = User::getAlerts();
        $router->render('auth/confirm_account', [
            'title' => 'Cuenta creada correctamente',
            'alerts' => $alerts
        ]);
    }
}
