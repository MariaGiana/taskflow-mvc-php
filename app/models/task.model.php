<?php

class TaskModel
{
    private $db;
    // 1. Abro la conexión
    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=db_tareas;charset=utf8', 'root', '');
    }



    public function getTasksByUser($userId)
    {
        $query = $this->db->prepare('SELECT * FROM tareas WHERE id_usuario = ? ORDER BY prioridad ASC');
        $query->execute([$userId]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }


    public function getTaskByUser($id_task, $id_user)
    {
        $query = $this->db->prepare('SELECT * FROM tareas WHERE id = ? AND id_usuario = ?');
        $query->execute([$id_task, $id_user]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function insertTask($title, $description, $priority, $userId, $finished = false)
    {
        $query = $this->db->prepare('INSERT INTO tareas(titulo, descripcion, prioridad, finalizada, id_usuario) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$title, $description, $priority, $finished, $userId]);
        $id = $this->db->lastInsertId();

        return $id;
    }

    public function eraseTask($id)
    {
        $query = $this->db->prepare('DELETE FROM tareas WHERE id = ?');
        $query->execute([$id]);
    }


    function updateTask($id)
    {
        $query = $this->db->prepare('UPDATE tareas SET finalizada = 1 WHERE id = ?');
        $query->execute([$id]);
    }


    public function modifyTask($id, $title, $description, $priority, $finished, $userId)
    {
        $query = $this->db->prepare('UPDATE tareas SET titulo = ?, prioridad = ?, descripcion = ?, finalizada = ? WHERE id = ?');
        $query->execute([$title, $priority, $description, $finished, $id]);
    
        return true;
    }
}
