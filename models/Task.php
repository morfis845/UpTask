<?php 
namespace Model;

class Task extends ActiveRecord{
    protected static $table = 'tasks';
    protected static $columnsDB = ['id','name','completed','projectId'];

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->completed = $args['completed'] ?? 0;
        $this->projectId = $args['projectId'] ?? '';
    }
}