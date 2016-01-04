<?php

$dsn = 'mysql:host=127.0.0.1;dbname=todo_php';
$user = 'root';
$password = 'password';

$dbh = new PDO($dsn, $user, $password);
$dbh->query('SET NAMES UTF8');

define('SITE_URL' , (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST”] . '/todo-php') ;

error_reporting(E_ALL & ~E_NOTICE) ;

session_set_cookie_params(0 , 'todo-php') ;

?>
