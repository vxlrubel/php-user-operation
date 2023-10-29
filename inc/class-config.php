<?php

$servername = "localhost";
$username = "root";
$password = "";

$prefix = 'app_';

try {
  $pdo = new PDO("mysql:host=$servername;dbname=app", $username, $password);
  // set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  $table_name = "{$prefix}users";
  $check_table = $pdo->query("SHOW TABLES LIKE '$table_name'");

  if( $check_table->rowCount() == 0 ){

    $sql = "CREATE TABLE $table_name (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        full_name VARCHAR(30) NOT NULL,
        email_address VARCHAR(55),
        phone_number VARCHAR(15) NOT NULL,
        user_address VARCHAR(255) NOT NULL,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

    )";
    $pdo->exec( $sql );
  }
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}


/**
 * require the function template
 */
require_once __DIR__ . '/core-template.php';

require_once __DIR__ . '/class-user.php';
