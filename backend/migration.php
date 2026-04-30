<?php 

require_once __DIR__ . "/includes/db_connection.php";

function createTable(PDO $pdo, string $table, string $sql)
{
    $statement = $pdo->prepare("SHOW TABLES LIKE :table");
    $statement->execute([':table' => $table]);

    if (!$statement->fetch()){
        try{
            $pdo->exec($sql);
            echo "Created Table: $table <br>";
        }catch(PDOException $e){
            echo "Error Creating Table $table: " . $e->getMessage() . "<br>";
        }
    }else{
        echo "Table already exists: $table <br>";
    }
}


// USERS TABLE
createTable($pdo, "users", "
    CREATE TABLE users (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        status ENUM('active','inactive') DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
    )
");

//Category table
createTable($pdo, "categories", "
    CREATE TABLE categories (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL,
        slug VARCHAR(50) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
    )
");
createTable($pdo, "contacts", "
    CREATE TABLE contacts (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        subject VARCHAR(255) NULL,
        message VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    )
");