<?php
Class TaskView{
    private $user = null;

    public function __construct ($user) {
        $this->user = $user;
    }
    //muestra todas las tareas
public function showTasks($tasks) {
    $count = count($tasks);
    $user = $this->user; 
    require './templates/listar_tareas.phtml';
}
//muestra el formulario para modificar 
public function showTask($task){
    $user = $this->user; 
    require './templates/form_modificar.phtml';
}

public function showLogin($error){
    $user = $this->user; 
    require './templates/form_login.phtml';
}

public function showDescription($task){
  
    $user = $this->user; 
    require './templates/ver_mas.phtml';
}
public function showAddTaskForm(){
    $user = $this->user; 
    require './templates/form_alta.phtml';
}

public function showError($error,$redir){
    $user = $this->user; 
    require './templates/error.phtml';
}


}
