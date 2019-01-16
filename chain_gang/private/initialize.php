<?php

  ob_start(); // turn on output buffering
  ini_set('display_startup_errors', 1);
  ini_set('display_errors', 1);
  error_reporting(-1);

  // Assign file paths to PHP constants
  // __FILE__ returns the current path to this file
  // dirname() returns the path to the parent directory
  define("PRIVATE_PATH", dirname(__FILE__));
  define("PROJECT_PATH", dirname(PRIVATE_PATH));
  define("PUBLIC_PATH", PROJECT_PATH . '/public');
  define("SHARED_PATH", PRIVATE_PATH . '/shared');

  // Assign the root URL to a PHP constant
  // * Do not need to include the domain
  // * Use same document root as webserver
  // * Can set a hardcoded value:
  // define("WWW_ROOT", '/~kevinskoglund/chain_gang/public');

  // * Can dynamically find everything in URL up to "/public"
  $public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
  $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
  //define("WWW_ROOT", $doc_root);
  define("WWW_ROOT", '');
  
  require_once('functions.php');
  require_once('status_error_functions.php');
  require_once('db_credentials.php');
  require_once('database_functions.php');
  require_once('validation_functions.php');

  // Load class definitions manually
  require_once('classes/databaseobject.class.php');
  require_once('classes/admin.class.php');
  require_once('classes/bicycle.class.php');
  require_once('classes/pagination.class.php');
  require_once('classes/session.class.php');

  $database = db_connect();
  DatabaseObject::set_database($database);

  $session = new Session;

?>
