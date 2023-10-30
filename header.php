
<?php 

session_start(); 

require_once __DIR__ . '/inc/class-config.php'; 

$active_page = 'home';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Asignment Application</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>

<nav class="navbar">
    <ul>
        <li class="<?php current_page(''); ?>"><a href="<?php home_url('/'); ?>">Home </a></li>
        <li class="<?php current_page('register'); ?>"><a href="<?php home_url('/register'); ?>">Add New</a></li>
        <li class="<?php current_page('login'); ?>"><a href="<?php home_url('/login'); ?>">Login</a></li>
    </ul>
</nav>