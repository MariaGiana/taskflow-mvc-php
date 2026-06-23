<?php
require_once './app/models/task.model.php';
require_once './app/views/task.view.php';

Class TaskController{
    private $view;
    private $model;
    private $user;

    public function __construct($res){
        $this->view=new TaskView($res->user);
        $this->model=new TaskModel();
        $this->user = $res->user; 
    }

   public function showTasks() {
        // obtengo las tareas de la DB
        $tasks =$this->model->getTasksByUser($this->user->id);  
        //y ahora las tengo que mandar a la vista:
        $this->view->showTasks($tasks);
    }

   public function addTask() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_POST['title']) || empty($_POST['title'])) {
            $error="Error: complete title";
            $redir="new";
            return $this->view->showError($error,$redir);
        }
    
        if (!isset($_POST['priority']) || empty($_POST['priority'])) {
            $error = "Error: complete priority";
            $redir="new";
            return $this->view->showError($error,$redir);
        }
        if (!isset($_POST['description']) || empty($_POST['description'])) {
            $error = "Error: complete description";
            $redir = "new";
            return $this->view->showError($error, $redir);
        }
    
        $title = $_POST['title'];
        $description = $_POST['description'];
        $priority = $_POST['priority'];
    
        $id = $this->model->insertTask($title, $description, $priority, $this->user->id);
    
        // redirijo al home
        header('Location: ' . BASE_URL .'list');
        exit; 
    } else {
        // Si no se ha enviado el formulario, muestra el formulario para agregar una tarea
        $this->view->showAddTaskForm(); 
    }
}
    
   public function deleteTask($id) {
        // obtengo la tarea por id
        $task = $this->model->getTaskByUser($id, $this->user->id);
    
        if (!$task) {
            $error= "The task with id= $id does not exist";
            $redir="list";
            return $this->view->showError($error,$redir);
        }
    
        $this->model->eraseTask($id);
        header('Location: ' . BASE_URL .'list');
    }
    
    
   public function finishTask($id) {
    $task = $this->model->getTaskByUser($id, $this->user->id);
    
        if (!$task) {
            $error="The task with id= $id does not exist";
            $redir="list";
            return $this->view->showError($error,$redir);
        }
    
        $this->model->updateTask($id);
        header('Location: ' . BASE_URL .'list');
    }



    public function changeTask($id){
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // obtengo la tarea de la DB
            $task = $this->model->getTaskByUser($id, $this->user->id);  
    
            // chequeo si existe antes de mandarla a la vista
            if (!$task) {
                $error = "The task with id= $id does not exist";
                $redir = "list";
                return $this->view->showError($error, $redir);
            }
    
            // si existe, la muestro
            $this->view->showTask($task);
    
        
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['title']) || empty($_POST['title'])) {
                $error="Error: complete title";
                $redir="list";
                return $this->view->showError($error,$redir);
            }
        
            if (!isset($_POST['priority']) || empty($_POST['priority'])) {
                $error = "Error: complete priority";
                $redir="list";
                return $this->view->showError($error,$redir);
            }
            if (!isset($_POST['description']) || empty($_POST['description'])) {
                $error = "Error: complete description";
                $redir = "list";
                return $this->view->showError($error, $redir);
            }
    // Si se envió el formulario, procesamos la actualización
        // Capturamos los datos enviados desde el formulario
        $title = $_POST['title'];
        $description = $_POST['description'];
        $priority = $_POST['priority'];
        $finished = isset($_POST['finished']) ? 1 : 0;  // Si se marca como finalizada

        // Actualizamos la tarea en la base de datos
        $this->model->modifyTask($id, $title, $description, $priority, $finished, $this->user->id);
        header('Location: ' . BASE_URL .'list');
    
        }

}

public function seeTask($id){
    // obtengo las tareas de la DB
    $task = $this->model->getTaskByUser($id, $this->user->id);  
    $this->view->showDescription($task);
}

    public function showError(){
        $error="404 not found";
        $redir="list";
        $this->view->showError($error,$redir);

    }
}

