<?php 
namespace Controllers;

use Model\Project;

class ProjectController{

    public static function index(){
        session_start();
        $userId = $_GET['userId'];
        $projects = Project::belongsTo('userId', $userId);
        echo json_encode($projects);
    }





    public static function update(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            session_start();
            isAuth();
            $id =  $_POST['id'];
            if(!$id) header('Location: /dashboard');
            $project = Project::where('id', $id);
            if($project->userId !== $_SESSION['id']){
                header('Location: /dashboard');
            }

            echo json_encode($project);
        }
    }
}