<?php
require_once 'app/controllers/auth.controller.php'; 
require_once 'app/utils/response.php'; 
require_once 'app/middlewares/session.auth.middlewares.php';


define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF'] . '/'));

$res = new Response();

$action = 'home'; // accion por defecto 
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

$controller = new RemeraController();


// determina que camino seguir según la acción

//agregar session.auth.middlewares cuando haya que agregar, editar o eliminar productos que se necesite tener el login



switch ($params[0]) {
    case 'listar':
        sessionAuthMiddlewares($res);
        $controller = new MarcaController($res);
        $controller->showHome();
        break;
    case 'nueva':
        sessionAuthMiddlewares($res); // Setea $res->user si existe session
        verifyAuthMiddleware($res); // Verifica que el usuario esté logueado o redirige a login
        $controller = new MarcaController($res);
        $controller->addMarcas();
        break;
    case 'eliminar':
        sessionAuthMiddlewares($res);
        verifyAuthMiddleware($res); // Verifica que el usuario esté logueado o redirige a login
        $controller = new MarcaController($res);
        $controller->deleteMarca($params[1]);
        break;
    case 'finalizar':
        sessionAuthMiddlewares($res);
        verifyAuthMiddleware($res); // Verifica que el usuario esté logueado o redirige a login
        $controller = new MarcaController($res);
        // $controller->finishMarca($params[1]);
        break;
    case 'showLogin':
        $controller = new AuthController();
        $controller->showLogin();
        break;
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
    default: 
        echo "404 Page Not Found"; // deberiamos llamar a un controlador que maneje esto
        break;
}
