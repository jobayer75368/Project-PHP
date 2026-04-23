<?php 

// Connecting Database 
$servername = "localhost";
$username = "root";
$password = "";
$dbname= "my_database";

try{
    $pdo = new PDO ("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (\Throwable $th){
    echo "Connection failed!" .$th->getMessage();
}


// Creating table 
// try{
//     $sql="CREATE TABLE IF NOT EXISTS admins(
    
//     id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     name VARCHAR(50) NOT NULL,
//     email VARCHAR(100) NOT NULL UNIQUE,
//     password VARCHAR(255) NOT NULL,
//     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
//     )";
//     $pdo->exec($sql);
//     echo "Data Table created succesfully!";

// }catch(PDOException $e){
//     echo "Error creating table;".$sql."<br>".$e->getMessage();
//  }

//  Inserting Data 

// try{
//     $hashedPassword = password_hash("@dminPassword", PASSWORD_DEFAULT);

//     $sql = "INSERT INTO admins(name,email,password)
//     VALUES(:name,:email,:password)";
//     $statement = $pdo->prepare($sql);
//     $statement->execute([
//         ':name'=> 'Jobayer',
//         ':email'=> 'jobayer30325@gmail.com',
//         ':password'=> $hashedPassword
//     ]);
//     echo "Admin inserted successfully";
// }catch(PDOException $e){
//     echo "Error Inserting Data:".$sql."<br>".$e->getMessage();
//  }

// try{
//     $sql = "DELETE FROM admins WHERE id IN(9,10)";
//     $statement =$pdo->prepare($sql);
//     $statement->execute();
//     echo "Admin Deleted successfully!";
// }
// catch(PDOException $e){
//     echo "Error Deleting admin:".$sql."<br>".$e->getMessage();
// }


