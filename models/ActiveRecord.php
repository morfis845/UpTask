<?php
namespace Model;

class ActiveRecord{
    //**DataBase**
    protected static $db;
    protected static $columnsDB = [];
    protected static $table  = '';
    //**DataBase**
    //Errors
    protected static $alerts = [];
    //Errors


    //Define database connection
    public static function setDB($database){
        self::$db = $database;
    }
    public function save(){
        if(!is_null($this->id)){
            //Update record
            $result = $this->update();
        }
        else{
            //Create new record
            $result = $this->create();
        }
        return $result;
    }

    public function create(){
        //Sanitize data
        $attributes = $this->sanitizeAttributes();
        //Insert database
        $query = "INSERT INTO ".static::$table." (";
        $query .= join(', ',array_keys($attributes));
        $query .= ") VALUES('"; 
        $query .= join("', '", array_values($attributes));
        $query .= "');";
        $result = self::$db->query($query);
        return [
            'result' => $result,
            'id' => self::$db->insert_id
        ];;
    }
    public function update(){
        //Sanitize data
        $attributes = $this->sanitizeAttributes();
        $values = [];
        foreach($attributes as $key => $value){
            $values[] = "{$key}='{$value}'";
        }
        $query = "UPDATE " .static::$table ." SET "; 
        $query .= join(', ', $values);
        $query .= "WHERE id= '" . self::$db->escape_string($this->id) . "'";
        $query .= "LIMIT 1;";

        $result = self::$db->query($query);
        return [
            'result' => $result,
            'id' => self::$db->insert_id
        ];
    }
    //Delete record
    public function delete(){
        $query = "DELETE FROM " .static::$table. " WHERE id = " . self::$db->escape_string($this->id). " LIMIT 1;";
        $result = self::$db->query($query);
        return $result;
    }
    //Identify and match database attributes
    public function attributes(){
        $attributes = [];
        foreach(static::$columnsDB as $column){
            if($column === 'id') continue;
            $attributes[$column] = $this->$column;
        }
        return $attributes;
    }
    //Sanitize the attributes before saving them in the DB
    public function sanitizeAttributes(){
        $attributes = $this->attributes();
        $sanitized = [];

        foreach($attributes as $key => $value){
            $sanitized[$key] = self::$db->escape_string($value);
        }
        return $sanitized;
    }
    //file upload
    // public function setImage($image){
    //     //Delete previous image
    //     if(!is_null($this->id)){
    //         $this->deleteImage();
    //     }
    //     //Assign the name of the image  to  the image attribute
    //     if($image){
    //         $this->image = $image;
    //     }
    // }
    //Delete the file
    // public function deleteImage(){
    //     //Chech if the file  exits
    //     $fileExists =  file_exists(CARPETA . $this->image);
    //     if($fileExists){
    //         unlink(IMAGE_FILES . $this->image);
    //     }
    // }
    //validation
    public static function getAlerts(){
        return static::$alerts;
    }
    public static function setAlert($type, $message){
        static::$alerts[$type][$type] = $message;
    }
    public function validate(){
        static::$alerts = [];
        return static::$alerts;
    }
    //List all records
    public static function getAll(){
        $query = "SELECT * FROM ". static::$table;
        $result = self::consultSQL($query);
        return $result;
    }
    //Get records with limit
    public static function get($amount){
        $query = "SELECT * FROM ". static::$table . " LIMIT ".$amount;
        $result = self::consultSQL($query);
        return $result;
    }
    //Search for a record by its id
    public static function find($id){
        $query = "SELECT * FROM ".static::$table." WHERE id = ${id}";
        $result = self::consultSQL($query);
        return array_shift($result);
    }
    public static function where($column, $attribute){
        $query = "SELECT * FROM ".static::$table." WHERE ${column} = '${attribute}'";
        $result = self::consultSQL($query);
        return array_shift($result);
    }
    public static function belongsTo($column, $attribute){
        $query = "SELECT * FROM ".static::$table." WHERE ${column} = '${attribute}'";
        $result = self::consultSQL($query);
        return $result;
    }
    public static function consultSQL($query){
        //Consult DB
        $result = self::$db->query($query);
        //Iterate the results
        $array = [];
        while($registry = $result->fetch_assoc()){
            $array[] = static::createObject($registry);
        }
        //Release the memory
        $result->free();
        //Return results
        return $array;
    }

    protected static function createObject($registry){
        $object = new static;
        foreach($registry as $key => $value){
            if(property_exists($object, $key)){
                $object->$key = $value;
            }
        }
        return $object;
    }
    //Synchronizes the object in memory with changes  made by the user
    public function syncUp($args = []){
        foreach($args as $key => $value){
            if(property_exists($this, $key)  && !is_null($value)){
                $this->$key = $value;
            }
        }
    }
    public static function SQL($query){
        $result = self::consultSQL($query);
        return $result;
    }
}