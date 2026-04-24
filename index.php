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
// backend 
// register 
    case '/register':
        require_once __DIR__ . '/backend/register.php';
        break;
// Login 
    case '/login':
        require_once __DIR__ . '/backend/user_login.php';
        break;
    case '/migration':
        require_once __DIR__ . '/backend/migration.php';
        break;
    case '/db_connection':
        require_once __DIR__ . '/backend/includes/db_connection.php';
        break;


// admin panel
// dashboard 
    case '/admin/dashboard':
        require_once __DIR__ ."/backend/dashboard.php";
        break;
// Login 
    case '/admin/login':
            require_once __DIR__ ."/backend/login.php";
            break;
    // 404 Page 
    case '/admin/Error-404':
            require_once __DIR__ ."/backend/404.php";
            break;
            
    case '/admin/blank':
        require_once __DIR__ ."/backend/blank.php";
        break;
    case '/admin/logout':
        require_once __DIR__ ."/backend/logout.php";
        break;
// bootstrap UI 
    case '/admin/alerts':
        require_once __DIR__ ."/backend/includes/bootstrap UI/alerts.php";
        break;
    case '/admin/buttons':
        require_once __DIR__ ."/backend/includes/bootstrap UI/buttons.php";
        break;
    case '/admin/dropdowns':
        require_once __DIR__ ."/backend/includes/bootstrap UI/dropdowns.php";
        break;
    case '/admin/modals':
        require_once __DIR__ ."/backend/includes/bootstrap UI/modals.php";
        break;
    case '/admin/popovers':
        require_once __DIR__ ."/backend/includes/bootstrap UI/popovers.php";
        break;
    case '/admin/progress-bar':
        require_once __DIR__ ."/backend/includes/bootstrap UI/progress-bar.php";
        break;
// boostrap UI end
// Forms 
    case '/admin/form-basics':
        require_once __DIR__ ."/backend/includes/Forms/form_basics.php";
        break;
    case '/admin/form-advanceds':
        require_once __DIR__ ."/backend/includes/Forms/form_advanceds.php";
        break;
// Forms end 
// Tables 
    case '/admin/users-tables':
        require_once __DIR__ ."/backend/includes/Tables/users-tables.php";
        break;
    case '/admin/datatables':
        require_once __DIR__ ."/backend/includes/Tables/datatables.php";
        break;
    case '/admin/admin-tables':
        require_once __DIR__ ."/backend/includes/Tables/admin-tables.php";
        break;
// Tables end  
    default:
        http_response_code(404);
        require_once __DIR__ . "/frontend/404.php";
        break;
}

 

    
