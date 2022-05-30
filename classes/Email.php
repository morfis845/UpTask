<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    protected $email;
    protected $name;
    protected $token;

    public function __construct($name, $email, $token)
    {
        $this->name = $name;
        $this->email = $email;
        $this->token = $token;
    }
    public function sendEmail()
    {
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = '00ced5c4346a2c';
        $phpmailer->Password = 'ba665b456f32e5';

        $phpmailer->setFrom('cuentas@uptask.com');
        $phpmailer->addAddress('cuentas@uptask.com', 'uptask.com');
        $phpmailer->Subject = 'Confirma tu cuenta';
        $phpmailer->isHTML(TRUE);
        $phpmailer->CharSet = 'UTF-8';

        $content = '<html>';
        $content .= '<p><strong>Hola '.$this->name.'</strong> Haz Creado tu cuenta en UpTask, solo debes confirmarla en el siguiente enlace</p>';
        $content .= '<p>Presiona aquí: <a href="http://localhost:3001/confirm-account?token='.$this->token.'">Confirmar Cuenta</a></p>';
        $content .= '<p>Si tu no creaste  esta cuenta, puedes ignorar este mensaje</p>';
        $content .= '</html>';
        $phpmailer->Body = $content;
        $phpmailer->send();
    }
    public function restorePassword()
    {
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = '00ced5c4346a2c';
        $phpmailer->Password = 'ba665b456f32e5';

        $phpmailer->setFrom('cuentas@uptask.com');
        $phpmailer->addAddress('cuentas@uptask.com', 'uptask.com');
        $phpmailer->Subject = 'Cambiar Contraseña';
        $phpmailer->isHTML(TRUE);
        $phpmailer->CharSet = 'UTF-8';

        $content = '<html>';
        $content .= '<p><strong>Hola '.$this->name.'</strong> Haz click en el siguiente enlace para cambiar tu contraseña.</p>';
        $content .= '<p>Presiona aquí: <a href="http://localhost:3001/restore?token='.$this->token.'">Cambiar Contraseña</a></p>';
        $content .= '<p>Si tu no solicitaste este cambio, puedes ignorar este mensaje</p>';
        $content .= '</html>';
        $phpmailer->Body = $content;
        $phpmailer->send();
    }
}
