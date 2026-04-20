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
// admin panel
// dashboard 
    case '/dashboard':
        require_once __DIR__ ."/backend/dashboard.php";
        break;
// Login 
    case '/admin-login':
            require_once __DIR__ ."/backend/login.php";
            break;
    // Register 
    case '/admin-register':
            require_once __DIR__ ."/backend/register.php";
            break;
    // 404 Page 
    case '/Error-404':
            require_once __DIR__ ."/backend/404.php";
            break;
            
    case '/blank-page':
        require_once __DIR__ ."/backend/blank.php";
        break;
// bootstrap UI 
    case '/alerts':
        require_once __DIR__ ."/backend/includes/bootstrap UI/alerts.php";
        break;
    case '/buttons':
        require_once __DIR__ ."/backend/includes/bootstrap UI/buttons.php";
        break;
    case '/dropdowns':
        require_once __DIR__ ."/backend/includes/bootstrap UI/dropdowns.php";
        break;
    case '/modals':
        require_once __DIR__ ."/backend/includes/bootstrap UI/modals.php";
        break;
    case '/popovers':
        require_once __DIR__ ."/backend/includes/bootstrap UI/popovers.php";
        break;
    case '/progress-bar':
        require_once __DIR__ ."/backend/includes/bootstrap UI/progress-bar.php";
        break;
// boostrap UI end
// Forms 
    case '/form-basics':
        require_once __DIR__ ."/backend/includes/Forms/form_basics.php";
        break;
    case '/form-advanceds':
        require_once __DIR__ ."/backend/includes/Forms/form_advanceds.php";
        break;
// Forms end 
// Tables 
    case '/simple-tables':
        require_once __DIR__ ."/backend/includes/Tables/simple-tables.php";
        break;
    case '/datatables':
        require_once __DIR__ ."/backend/includes/Tables/datatables.php";
        break;
// Tables end 
// UI COLORS 
    case '/ui-colors':
        require_once __DIR__ ."/backend/ui-colors.php";
        break;
// UI COLORS END 
// Charts 
    case '/charts':
        require_once __DIR__ ."/backend/charts.php";
        break;
// Charts end 
    default:
        http_response_code(404);
        require_once __DIR__ . "/frontend/404.php";
        break;
}

 

    
