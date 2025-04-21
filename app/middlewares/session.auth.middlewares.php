<?php
//en este archivo creo la session con los parametros:
function sessionAuthMiddleware($res) {
    session_start();
    if(isset($_SESSION['ID_USER'])){
        $res->user = new stdClass();
        $res->user->id = $_SESSION['ID_USER'];
        $res->user->email = $_SESSION['EMAIL_USER'];
        $res->user->nombre =$_SESSION['NAME_USER'];
      
        return;
    } else {
        header('Location: ' . BASE_URL . 'showLogin');
        die();
    }
}