<?php

//modelo llama a la db
class UserModel{

    private $db;

    public function __construct(){
    $this->db= new PDO('mysql:host=localhost;dbname=db_tareas;charset=utf8', 'root', '');
    }

    public function getUserByEmail($email){
        $query=$this->db->prepare("SELECT * FROM usuario WHERE email = ?");
        $query->execute([$email]);
        $user = $query->fetch(PDO::FETCH_OBJ);
    
        return $user;
    }


    public function userExists($email) {
        $query=$this->db->prepare ('SELECT COUNT(*) FROM usuario WHERE email = ?');
        $query->execute([$email]);
        return $query->fetchColumn() > 0; // Devuelve true si el usuario existe
    }



    public function createUser($email, $password,$nombre){
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query=$this->db->prepare('INSERT INTO usuario(email, password, nombre) VALUES (?, ?, ?)');
        $query->execute([$email,  $hashedPassword, $nombre]);
        $id = $this->db->lastInsertId();
        return $id;
    }
}