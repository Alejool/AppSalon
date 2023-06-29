<?php 
require_once __DIR__ . '/../includes/app.php';

mostrarErrores();

use Controllers\adminControllers;
use Controllers\apiControllers;
use Controllers\citaControllers;
use MVC\Router;
use Controllers\loginControllers ;
use Controllers\servicioControllers;

$router = new Router();

// crear rutas
/** Iniciar sesión */
$router->get('/', [loginControllers::class, 'login']);
$router->post('/', [loginControllers::class, 'login']);
$router->get('/logout', [loginControllers::class, 'logout']);

/** Recuperar password*/
$router->get('/olvidar', [loginControllers::class, 'olvidar']);
$router->post('/olvidar', [loginControllers::class,  'olvidar']);
$router->get('/recuperar', [loginControllers::class, 'recuperar']);
$router->post('/recuperar', [loginControllers::class, 'recuperar']);

/** crer cuentas */
$router->get('/crear-cuenta', [loginControllers::class, 'crear']);
$router->post('/crear-cuenta', [loginControllers::class, 'crear']);

/*confirmar cuenta */
$router->get('/confirmar-cuenta',[loginControllers::class, 'confirmar']);
$router->get('/mensaje',[loginControllers::class, 'mensaje']);

/*  citas  */
$router->get('/cita', [citaControllers::class, 'index']);

/* api */
$router->get('/api/servicios', [apiControllers::class, 'index']);
$router->post('/api/citas', [apiControllers::class, 'guardarCitas']);
$router->post('/api/eliminar', [apiControllers::class, 'eliminar']);


/* admin */
$router->get('/admin', [adminControllers::class, 'index']);

/* servicios */
$router->get('/servicios', [servicioControllers::class, 'index']);
$router->get('/servicios/crear', [servicioControllers::class, 'crear']);
$router->post('/servicios/crear', [servicioControllers::class, 'crear']);
$router->get('/servicios/actualizar',[servicioControllers::class, 'actualizar']);
$router->post('/servicios/actualizar',[servicioControllers::class, 'actualizar']);
$router->post('/servicios/eliminar',[servicioControllers::class, 'eliminar']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();