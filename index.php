<?php 

$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch($request){
    case '/':
        require_once __DIR__ . "/frontend/index.php";
        break;
    case '/about':
        require_once __DIR__ . '/frontend/about.php';
        break;
    case '/articles':
        require_once __DIR__ . '/frontend/articles.php';
        break;
    case '/contact':
        require_once __DIR__ . '/frontend/contact.php';
        break;
    default:
        http_response_code(404);
        require_once __DIR__ . "/frontend/404.php";
        break;
}