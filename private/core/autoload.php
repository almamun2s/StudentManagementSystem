<?php 
/**
 * This file loads all the file in core folder and loads models files through auloload function. 
 */

require_once 'app.php';
require_once 'functions.php';
require_once 'config.php'; // The configure file 
require_once 'controller.php'; // Main Controller
require_once 'database.php'; // Connection to Database
require_once 'model.php'; // Main Model
require_once 'model.php'; // Main Model 

spl_autoload_register('autoload');
function autoload($class){
    require_once 'private/models/'. strtolower($class) .'.php';
}