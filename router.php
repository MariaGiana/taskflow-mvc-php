<?php

require_once './app/controllers/task.controller.php';
require_once './app/controllers/auth.controller.php';
require_once './app/middlewares/session.auth.middlewares.php';
require_once './libs/response.php';

// base_url para redirecciones y base tag
define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

// instancio el response que tiene la variable $user
$res = new Response();

$action = 'showLogin'; // acción por defecto si no se envía ninguna
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

// parsea la acción para separar acción real de parámetros
$params = explode('/', $action);


switch ($params[0]) {
    case 'showLogin':
        $controller = new AuthController($res);
        $controller->showLogin();
        break;

    case 'new':
        // Solo usuarios logueados pueden agregar tareas
        //si no agrego el authMidd no me reconoce la session
        sessionAuthMiddleware($res);
        $controler = new TaskController($res);
        $controler->addTask();
        break;

    case 'delete':
        // Solo usuarios logueados pueden eliminar tareas
        sessionAuthMiddleware($res);
        $controler = new TaskController($res);
        $controler->deleteTask($params[1]);
        break;

    case 'done':
        sessionAuthMiddleware($res);
        $controler = new TaskController($res);
        $controler->finishTask($params[1]);
        break;

    case 'edit':
        sessionAuthMiddleware($res);
        $controler = new TaskController($res);
        $controler->changeTask($params[1]);
        break;

    case 'seeMore':
        $controler = new TaskController($res);
        $controler->seeTask($params[1]);
        break;

    case 'seeMoreLogin':
        sessionAuthMiddleware($res);
        $controler = new TaskController($res);
        $controler->seeTask($params[1]);
        break;

    case 'list':
         sessionAuthMiddleware($res);
        $controler = new TaskController($res);
        $controler->showTasks();
        break;

    case 'login':
        // Proceso de login
        $controller = new AuthController($res);
        $controller->login();
        break;

    case 'signIn':
        // Proceso de crear usuario
        $controller = new AuthController($res);
        $controller->createLogin();
        break;


    case 'logout':
        // Proceso de logout
        $controller = new AuthController($res);
        $controller->logout();
        break;

    default:
        // Manejo de error: página no encontrada
        $controler = new TaskController($res);
        $controler->showError();
        break;
}
