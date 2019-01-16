--TEST--

--FILE--
<?php 

require_once("../../includes/db_connection.php");
require_once("../../includes/functions.php"); 
require_once("../../includes/navigation.php"); 

$output = find_page_by_id(31);
$user_id = $output["inquirer"];

$output = find_user_by_id($user_id);
$area_id = $output["area"];
var_dump ($area_id);

?>

--EXPECT--
string(1) "1"
