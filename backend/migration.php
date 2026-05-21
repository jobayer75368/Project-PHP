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

// try {
//     $sql = "ALTER TABLE comments
//     ADD status ENUM('pending','approved') DEFAULT 'pending' 
//     AFTER comment";
//     $statement = $pdo->prepare($sql);
//     $statement->execute();
//     echo "Successfull";
// } catch (PDOException $e) {
//     echo "Error Inserting Data:" . $sql . "<br>" . $e->getMessage();
// }


// Setting 
// createTable($pdo, "settings", "
//     CREATE TABLE settings (
//         id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//         website_name VARCHAR(100) NOT NULL,
//         website_footer VARCHAR(255) NOT NULL,

//         about_title VARCHAR(255) NOT NULL,
//         about_details TEXT NULL,

//         phone VARCHAR(100) NULL,
//         email VARCHAR(100) NOT NULL UNIQUE,
//         location TEXT NULL,

//         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//         updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
//     )
// ");


// Inserting data in settings table 
// try {

//     $sql = "INSERT INTO settings(id,website_name,website_footer,about_title,about_details,phone,email,location)
//     VALUES(:id,:website_name,:website_footer,:about_title,:about_details,:phone,:email,:location)";

//     $statement = $pdo->prepare($sql);
//     $statement->execute([
//         ':id' => 1,
//         ':website_name' => 'BLOGGER',
//         ':website_footer' => '© 2024 ModernBlog | Designed with ❤️',

//         ':about_title' => 'Who We Are',
//         ':about_details' => 'We provide professional training in web development, software development, graphic design, and digital marketing. We focus on practical learning, real projects, and career-focused skills to prepare students for industry success.

// Our experienced mentors guide students through modern technologies and creative techniques using simple teaching methods. We help learners build confidence, improve problem-solving abilities, and develop strong portfolios for freelance and job opportunities.

// We believe quality education should be accessible, practical, and future-oriented for every student. Our mission is to create skilled professionals who can compete globally and build successful careers in the technology industry.',

//         ':phone' => '+880 1234-567890',
//         ':email' => 'info@example.com',
//         ':location' => 'Dhaka, Bangladesh',
//     ]);
//     echo "Successfull";
// } catch (PDOException $e) {
//     echo "Error Inserting Data:" . $sql . "<br>" . $e->getMessage();
// }


// try {
//     $sql = "ALTER TABLE settings
//     DROP image";
//     $statement = $pdo->prepare($sql);
//     $statement->execute();
//     echo "Successfull";
// } catch (PDOException $e) {
//     echo "Error Inserting Data:" . $sql . "<br>" . $e->getMessage();
// }
