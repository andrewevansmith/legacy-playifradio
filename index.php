<?php 

/** 
 * A new MVC Framework
 * 
 * @author Legacy archive
 * @copyright 2012 Legacy archive 
 * @license http://www.php.net/license/3_01.txt PHP License 3.01 
 */  

function redirect($uri)
{
   header( 'Location: '. BASE_URL . $uri ) ;
}

require_once "framework/core/config.php";
require_once "framework/libraries/singleton.php"; 
require_once "framework/libraries/errorhandler.php"; 
require_once "framework/libraries/encryption.php"; 
require_once "framework/libraries/database.php"; 
require_once "framework/libraries/session.php"; 
require_once "framework/core/model.php";
require_once "framework/core/controller.php";
require_once "framework/core/router.php";

$encryptor = new Encryptor();
Router::start_application();

