<?php

$hostname = 'localhost';
$dbname   = 'app';
$username = 'root';
$password = '';

$prefix = 'app_';

try {
  $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  $table_name = "{$prefix}users";
  $table_posts = "{$prefix}posts";
  $check_table = $pdo->query("SHOW TABLES LIKE '$table_name'");

  $check_table_posts = $pdo->query("SHOW TABLES LIKE '$table_posts'");

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
  
  if( $check_table_posts->rowCount() == 0 ){
    $posts_sql = "CREATE TABLE $table_posts(
      id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      post_title VARCHAR(255) NOT NULL,
      post_desc TEXT UNIQUE NOT NULL,
      post_status VARCHAR(10) DEFAULT 'publish',
      post_type VARCHAR(5) NOT NULL DEFAULT 'post',
      post_author INT(6) NOT NULL,
      post_password VARCHAR(20),
      post_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    $pdo->exec( $posts_sql );
  }
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}


/**
 * require the function template
 */
require_once __DIR__ . '/core-template.php';

require_once __DIR__ . '/class-user.php';
