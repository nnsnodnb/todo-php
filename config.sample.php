<?php

define('dns' , 'mysql:host=localhost;dbname=todo-php') ;
define('user' , 'root') ;
define('password' , 'root') ;

define('SITE_URL' , 'http://localhost/php/todo-php') ;

error_reporting(E_ALL & ~E_NOTICE) ;

session_set_cookie_params(0 , 'php/todo-php') ;

?>
