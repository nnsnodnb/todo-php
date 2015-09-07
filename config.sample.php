<?php

$dsn = 'mysql:host=localhost;dbname=todo_php';
$user = 'root';
$password = 'password';

$dbh = new PDO($dsn, $user, $password);
$dbh->query('SET NAMES UTF8');

define('SITE_URL' , 'http://localhost/todo-php') ;

error_reporting(E_ALL & ~E_NOTICE) ;

session_set_cookie_params(0 , 'todo-php') ;

?>
