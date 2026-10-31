<?php
session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/controllers/HomeController.php';
require_once __DIR__ . '/../app/controllers/EmployeeController.php';
require_once __DIR__ . '/../app/controllers/AttendanceController.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/UserController.php';
require_once __DIR__ . '/../app/controllers/ProductController.php';
require_once __DIR__ . '/../app/middleware/AuthMiddleware.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

switch ($uri) {
    case '/':
        AuthMiddleware::handle();
        (new HomeController($pdo))->index();
        break;
    case '/employees':
        AuthMiddleware::handle();
        (new EmployeeController($pdo))->index();
        break;
    case '/employees/create':
        AuthMiddleware::handle();
        (new EmployeeController($pdo))->create();
        break;
    case '/employees/store':
        AuthMiddleware::handle();
        (new EmployeeController($pdo))->store();
        break;
    case '/users':
        AuthMiddleware::handle(); (new UserController($pdo))->index(); break;
    case '/users/create':
        AuthMiddleware::handle(); (new UserController($pdo))->create(); break;
    case '/users/store':
        AuthMiddleware::handle(); (new UserController($pdo))->store(); break;
    case '/users/edit':
        AuthMiddleware::handle(); (new UserController($pdo))->edit(); break;
    case '/users/update':
        AuthMiddleware::handle(); (new UserController($pdo))->update(); break;
    case '/users/delete':
        AuthMiddleware::handle(); (new UserController($pdo))->delete(); break;
    case '/products':
        AuthMiddleware::handle(); (new ProductController($pdo))->index(); break;
    case '/products/create':
        AuthMiddleware::handle(); (new ProductController($pdo))->create(); break;
    case '/products/store':
        AuthMiddleware::handle(); (new ProductController($pdo))->store(); break;
    case '/products/edit':
        AuthMiddleware::handle(); (new ProductController($pdo))->edit(); break;
    case '/products/update':
        AuthMiddleware::handle(); (new ProductController($pdo))->update(); break;
    case '/products/delete':
        AuthMiddleware::handle(); (new ProductController($pdo))->delete(); break;
    case '/attendance':
        AuthMiddleware::handle();
        (new AttendanceController($pdo))->index();
        break;
    case '/employees/summary':
        AuthMiddleware::handle();
        (new AttendanceController($pdo))->summary();
        break;
    case '/attendance/report':
        AuthMiddleware::handle();
        (new AttendanceController($pdo))->report();
        break;
    case '/attendance/create':
        AuthMiddleware::handle();
        (new AttendanceController($pdo))->create();
        break;
    case '/attendance/store':
        AuthMiddleware::handle();
        (new AttendanceController($pdo))->store();
        break;
    case '/attendance/check-out':
        AuthMiddleware::handle();
        (new AttendanceController($pdo))->checkOut();
        break;
    case '/login':
        (new AuthController($pdo))->login();
        break;
    case '/logout':
        (new AuthController($pdo))->logout();
        break;
    default:
        http_response_code(404);
        echo '404 - Halaman tidak ditemukan';
}
