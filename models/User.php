<?php 

namespace Model;

class User extends ActiveRecord{
    protected static $table = 'users';
    protected static $columnsDB = ['id','name','email','password','token','confirmed'];

    public $id;
    public $name;
    public $email;
    public $password;
    public $token;
    public $confirmed;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->repeat_password = $args['repeat-password'] ?? '';
        $this->current_password = $args['current-password'] ?? '';
        $this->new_password = $args['new-password'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmed = $args['confirmed'] ?? 0;
    }

    public function validateNewAccount(){
        if(!$this->name){
            self::$alerts['error'][] = 'El nombre del usuario es obligatorio';
        }
        if(!$this->email){
            self::$alerts['error'][] = 'El email del usuario es obligatorio';
        }
        if(!$this->password){
            self::$alerts['error'][] = 'La contraseña es obligatoria';
        }
        else if(strlen($this->password) < 6){
            self::$alerts['error'][] = 'La contraseña debe ser mayor a 6 caracteres';
        }
        else if(!$this->repeat_password){
            self::$alerts['error'][] = 'Debe repetir la contraseña';
        }
        else if($this->password !== $this->repeat_password){
            self::$alerts['error'][] = 'Las contraseñas no son iguales';
        }
        return self::$alerts;
    }
    public function validateLogin(){
        if(!$this->email){
            self::$alerts['error'][] = 'El email del usuario es obligatorio';
        }
        else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alerts['error'][] = 'Email no valido';
        }
        if(!$this->password){
            self::$alerts['error'][] = 'La contraseña es obligatoria';
        }
        return self::$alerts;
    }
    public function validateRestore(){
        if(!$this->password){
            self::$alerts['error'][] = 'La contraseña es obligatoria';
        }
        else if(strlen($this->password) < 6){
            self::$alerts['error'][] = 'La contraseña debe ser mayor a 6 caracteres';
        }
        return self::$alerts;
    }
    public function checkPasswordAndConfirmed($password){
        $result = password_verify($password, $this->password);
        if(!$result){
            self::$alerts['error']['error'] = 'Email o Contraseña Incorrecta';
        }
        elseif(!$this->confirmed){
            self::$alerts['error']['error'] = 'Email o Contraseña Incorrecta';
        }
        else{
            return true;
        }
    }

    public function emailValidate(){
        if(!$this->email){
            self::$alerts['error'][] = 'El email es obligatorio';
        }
        else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alerts['error'][] = 'Email no valido';
        }
        return self::$alerts;
    }

    public function checkPassword(){
        return password_verify($this->current_password, $this->password);
    }

    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
    public function tokenGenerate(){
        $this->token = md5(uniqid($this->token));
    }

    public function validatePerfil(){
        if(!$this->name){
            self::$alerts['error'][] = 'El nombre es oblogatorio';
        }
        if(!$this->email){
            self::$alerts['error'][] = 'El email es oblogatorio';
        }
        return self::$alerts;
    }
    public function newPassword(){
        if(!$this->current_password){
            self::$alerts['error'][] = 'Debes introducir tu contraseña actual';
        }
        else if(!$this->new_password){
            self::$alerts['error'][] = 'Debes introducir tu nueva contraseña';
        }
        else if(strlen($this->new_password) < 6){
            self::$alerts['error'][] = 'La nueva contraseña debe tener al menos 6 caracteres';
        }
        return self::$alerts;
    }
}