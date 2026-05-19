<?php

require_once __DIR__ . "/includes/db_connection.php";
require_once __DIR__ . "/restrict.php";

function createTable(PDO $pdo, string $table, string $sql)
{
    $statement = $pdo->prepare("SHOW TABLES LIKE :table");
    $statement->execute([':table' => $table]);

    if (!$statement->fetch()) {
        try {
            $pdo->exec($sql);
            echo "Created Table: $table <br>";
        } catch (PDOException $e) {
            echo "Error Creating Table $table: " . $e->getMessage() . "<br>";
        }
    } else {
        echo "Table already exists: $table <br>";
    }
}


// // USERS TABLE
// createTable($pdo, "users", "
//     CREATE TABLE users (
//         id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//         name VARCHAR(50) NOT NULL,
//         email VARCHAR(100) NOT NULL UNIQUE,
//         password VARCHAR(255) NOT NULL,
//         role VARCHAR(50) NOT NULL,
//         status ENUM('active','inactive') DEFAULT 'active',
//         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//         updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
//     )
// ");

// createTable($pdo, "users", "
//     CREATE TABLE users (
//         id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//         name VARCHAR(50) NOT NULL,
//         email VARCHAR(100) NOT NULL UNIQUE,
//         password VARCHAR(255) NOT NULL,
//         role VARCHAR(50) NOT NULL,
//         status ENUM('active','inactive') DEFAULT 'active',
//         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//         updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
//     )
// ");

// //Category table
// createTable($pdo, "categories", "
//     CREATE TABLE categories (
//         id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//         name VARCHAR(50) NOT NULL,
//         slug VARCHAR(50) NOT NULL,
//         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//         updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
//     )
// ");
// createTable($pdo, "contacts", "
//     CREATE TABLE contacts (
//         id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//         name VARCHAR(50) NOT NULL,
//         email VARCHAR(100) NOT NULL UNIQUE,
//         subject VARCHAR(255) NULL,
//         message VARCHAR(255) NOT NULL,
//         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
//     )
// ");


// try {
//     $hashedPassword = password_hash("@dminpassword", PASSWORD_DEFAULT);

//     $sql = "INSERT INTO users(id,name,email,password,role,status)
//     VALUES(:id,:name,:email,:password,:role,:status)";

//     $statement = $pdo->prepare($sql);
//     $statement->execute([
//         ':id' => 1,
//         ':name' => 'Admin',
//         ':email' => 'admin@gmail.com',
//         ':password' => $hashedPassword,
//         ':role' => 'admin',
//         ':status' => 'active',
//     ]);
//     echo "Successfull";
// } catch (PDOException $e) {
//     echo "Error Inserting Data:" . $sql . "<br>" . $e->getMessage();
// }

// try {
//     $sql = "ALTER TABLE users
//     ADD image VARCHAR(255) NULL 
//     AFTER password";
//     $statement = $pdo->prepare($sql);
//     $statement->execute();
//     echo "Successfull";
// } catch (PDOException $e) {
//     echo "Error Inserting Data:" . $sql . "<br>" . $e->getMessage();
// }
// try {
//     $sql = "ALTER TABLE users CHANGE COLUMN image featured_image VARCHAR(255) NULL";

//     $statement = $pdo->prepare($sql);
//     $statement->execute();
//     echo "Successful";
// } catch (PDOException $e) {
//     echo "Error Altering Data:" . $sql . "<br>" . $e->getMessage();
// }


// try {
//     $sql = "ALTER TABLE users
//             MODIFY role VARCHAR(50) NOT NULL DEFAULT 'subscriber';";
//     $statement = $pdo->prepare($sql);
//     $statement->execute();
//     echo "Successful";
// } catch (PDOException $e) {
//     echo "Error Altering Data:" . $sql . "<br>" . $e->getMessage();
// }

//UPDATE CONTACTS

// try {
//     $sql = "ALTER TABLE contacts
//             DROP COLUMN status";
//     $statement = $pdo->prepare($sql);
//     $statement->execute();
//     echo "Successful";
// } catch (PDOException $e) {
//     echo "Error Altering Data:" . $sql . "<br>" . $e->getMessage();
// }

// createTable(
//     $pdo,
//     'blogs',
//     "CREATE TABLE blogs(
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     title VARCHAR(255) NOT NULL,
//     slug  VARCHAR(255) NOT NULL UNIQUE,
//     short_description MEDIUMTEXT NOT NULL,
//     long_description MEDIUMTEXT NOT NULL,
//     featured_image VARCHAR(255) NOT NULL,
//     created_by INT UNSIGNED NULL,
//     status ENUM('draft','pending','published') DEFAULT 'draft',
//     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//     updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,

//     FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
//     )"
// );
// createTable(
//     $pdo,
//     'comments',
//     "CREATE TABLE comments(
//         id INT AUTO_INCREMENT PRIMARY KEY,
//         blog_id INT NOT NULL,
//         name VARCHAR(255) NOT NULL,
//         comment TEXT NOT NULL,
//         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

//         FOREIGN KEY (blog_id)
//         REFERENCES blogs(id)
//         ON DELETE CASCADE
//     )"
// );
// try {

//     $sql = "ALTER TABLE blogs
//             ADD category_id INT UNSIGNED NULL,
//             ADD CONSTRAINT fk_blog_category
//             FOREIGN KEY (category_id)
//             REFERENCES categories(id)
//             ON DELETE SET NULL";

//     $statement = $pdo->prepare($sql);
//     $statement->execute();

//     echo 'Successful';
// } catch (PDOException $e) {

//     echo 'Error: ' . $e->getMessage();
// }

try {
    $sql = "ALTER TABLE comments
    ADD status ENUM('pending','approved') DEFAULT 'pending' 
    AFTER comment";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    echo "Successfull";
} catch (PDOException $e) {
    echo "Error Inserting Data:" . $sql . "<br>" . $e->getMessage();
}
