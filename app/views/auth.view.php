<?php
class AuthView
{
    private $user = null;

    public function __construct ($user) {
        $this->user = $user;
    }
     // Muestra el formulario de login junto con la lista de tareas
    public function showLogin($tasks = [], $error = '') {
        // Renderizo el formulario de login
        require './templates/form_login.phtml';
        
    }
    public function showSignup($error = '') {
        require 'templates/form_login.phtml';
    }
    public function showAddUser($error) {
        require 'templates/form_firstLogin.phtml';

    }
    
}