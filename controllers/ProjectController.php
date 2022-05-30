<?php 
namespace Controllers;

use Model\Project;
use Model\Task;

class ProjectController{

    public static function index(){
        session_start();
        $userId = $_GET['userId'];
        $projects = Project::belongsTo('userId', $userId);
        echo json_encode($projects);
    }

    public static function update(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $project = new Project($_POST);
            session_start();
            isAuth();
            $id =  $_POST['id'];
            if(!$id) header('Location: /dashboard');
            $searchProject = Project::where('id', $id);
            if(!$searchProject || $searchProject->userId !== $_SESSION['id']){
                header('Location: /dashboard');
                return;
            }
            $project->url = $searchProject->url;
            $project->userId = $searchProject->userId;
            $result = $project->save();
            header('Location: /dashboard');
            echo json_encode($result);
        }
    }

    public static function delete(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            session_start();
            isAuth();
            $project = new Project($_POST);
            $id = $project->id;
            $searchProject = Project::where('id', $id);
            if(!$searchProject || $searchProject->userId !== $_SESSION['id']){
                header('Location: /dashboard');
                return;
            }
            $task = new Task();
            $searchTask = Task::where('projectId', $id);
            if($searchTask){

                $task = $searchTask;
                $task->delete();
            }
            $result = $project->delete($id);
            header('Location: /dashboard');
            echo json_encode($result);
        }
    }
}