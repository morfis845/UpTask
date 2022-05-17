<?php 
namespace Model;

use Model\ActiveRecord;

class Project extends ActiveRecord{
    protected static $table = 'projects';
    protected static $columnsDB = ['id','project','url','userId'];

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->project = $args['project'] ?? '';
        $this->url = $args['url'] ?? '';
        $this->userId = $args['userId'] ?? '';
    }
    public function projectValidate(){
        if(!$this->project){
            self::$alerts['error'][] = 'El nombre del proyecto es obligatorio';
        }
        return self::$alerts;
    }
}