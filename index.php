<?php

$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($request) {
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
    // frontend end 

    // backend 

    // register 
    case '/register':
        require_once __DIR__ . '/backend/register.php';
        break;

    // Login 
    case '/login':
        require_once __DIR__ . '/backend/login.php';
        break;

    //creating new table        
    case '/migration':
        require_once __DIR__ . '/backend/migration.php';
        break;

    //Database connection        
    case '/db_connection':
        require_once __DIR__ . '/backend/includes/db_connection.php';
        break;

    // admin panel
    // dashboard 
    case '/admin/dashboard':
        require_once __DIR__ . "/backend/dashboard.php";
        break;

    //Admin profile
    case '/admin/profile':
        require_once __DIR__ . '/backend/admin_profile.php';
        break;

    // 404 Page 
    case '/admin/Error-404':
        require_once __DIR__ . "/backend/404.php";
        break;

    case '/admin/blank':
        require_once __DIR__ . "/backend/blank.php";
        break;
    case '/admin/logout':
        require_once __DIR__ . "/backend/logout.php";
        break;

    // Contacts 
    case '/admin/contacts':
        require_once __DIR__ . "/backend/includes/Contacts/contact.php";
        break;
    case '/admin/contacts/delete':
        require_once __DIR__ . "/backend/includes/Contacts/contact_delete.php";
        break;
    // Contacts end 

    //Categories
    case '/admin/category/list':
        require_once __DIR__ . "/backend/includes/categories/category_list.php";
        break;
    case '/admin/category/create':
        require_once __DIR__ . "/backend/includes/categories/create_category.php";
        break;
    case '/admin/category/edit':
        require_once __DIR__ . "/backend/includes/categories/edit_category.php";
        break;
    case '/admin/category/delete':
        require_once __DIR__ . "/backend/includes/categories/delete.php";
        break;
    // categories end 

    //BLOGS
    case '/admin/blog/list':
        require_once __DIR__ . "/backend/includes/blogs/blog_list.php";
        break;
    case '/admin/blog/create':
        require_once __DIR__ . "/backend/includes/blogs/blog_create.php";
        break;
    case '/admin/blog/edit':
        require_once __DIR__ . "/backend/includes/blogs/blog_edit.php";
        break;
    case '/admin/blog/delete':
        require_once __DIR__ . "/backend/includes/blogs/blog_delete.php";
        break;
    // Blogs end

    // Tables 
    case '/admin/users-tables':
        require_once __DIR__ . "/backend/includes/Tables/users-tables.php";
        break;
    case '/admin/datatables':
        require_once __DIR__ . "/backend/includes/Tables/datatables.php";
        break;
    case '/admin/admin-tables':
        require_once __DIR__ . "/backend/includes/Tables/admin-tables.php";
        break;
    case (preg_match('#^/blog/([a-zA-Z0-9-]+)$#', $request, $matches) ? true : false):
        $_GET['slug'] = $matches[1];
        require_once __DIR__ . '/frontend/single_blog.php';
        break;
    case (preg_match('#^/category/([a-zA-Z0-9-]+)$#', $request, $matches) ? true : false):
        $_GET['slug'] = $matches[1];
        require_once __DIR__ . '/frontend/category.php';
        break;
    // Tables end  

    default:
        http_response_code(404);
        require_once __DIR__ . "/frontend/404.php";
        break;
}
