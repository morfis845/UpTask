<?php 

namespace Controllers;

use Model\Project;
use Model\Task;
use MVC\Router;

class TaskController{
    public static function index(){
        session_start();
        isAuth();
        $projectId = $_GET['id'];
        if(!$projectId){
            header('Location: /dashboard');
        }
        $project = Project::where('url', $projectId);
        if(!$project || $project->userId !== $_SESSION['id']) header('Location: /404');
        $tasks = Task::belongsTo('projectId',  $project->id);
        echo json_encode(['tasks' => $tasks]);
    }
    public static function create(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            session_start();
            $projectId = $_POST['projectId'];
            $project = Project::where('url', $projectId);
            if(!$project || $project->userId !== $_SESSION['id']){
                $answer = [
                    'type' =>  'error',
                    'message' => 'Ocurrio un error al agregar la tarea'
                ];
                echo json_encode($answer);
                return;
            }
            $task = new Task($_POST);
            $task->projectId = $project->id;
            $result = $task->save();
            $answer = [
                'type' => 'success',
                'id' => $result['id'],
                'message' => 'Tarea Creada Correctamente',
                'projectId' => $project->id
            ];
            echo json_encode($answer);
        }
    }
    public static function update(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            session_start();
            $project = Project::where('url', $_POST['projectId']);
            if(!$project || $project->userId !== $_SESSION['id']){
                $answer = [
                    'type' =>  'error',
                    'message' => 'Ocurrio un error al actualizar la tarea'
                ];
                echo json_encode($answer);
                return;
            }
            $task = new Task($_POST);
            $task->projectId = $project->id;
            $result = $task->save();
            if($result){
                $answer = [
                    'type' => 'success',
                    'id' => $task->id,
                    'projectId' => $project->id,
                    'message' => 'Actualizado correctamente'
                ];
                echo json_encode(['answer' => $answer]);
            }
        }
    }
    public static function delete(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            session_start();
            $project = Project::where('url', $_POST['projectId']);
            if(!$project || $project->userId !== $_SESSION['id']){
                $answer = [
                    'type' =>  'error',
                    'message' => 'Ocurrio un error al actualizar la tarea'
                ];
                echo json_encode($answer);
                return;
            }
            $task = new Task($_POST);
            $result = $task->delete();
            $result = [
                'result' => $result,
                'message' => 'Eliminado Correctamente'
            ];
            echo json_encode($result);


        }
    }
}