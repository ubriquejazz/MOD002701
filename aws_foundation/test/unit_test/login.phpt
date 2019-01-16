--TEST--

--FILE--
<?php 

require_once("../../includes/db_connection.php");
require_once("../../includes/functions.php"); 
require_once("../../includes/navigation.php"); 

$output = attempt_login("jgago","secret");
$user_id = $output["user_id"];
var_dump ($user_id);

$output = find_user_by_id($user_id);
$area_id = $output["area"];
var_dump ($area_id);

?>

--EXPECT--
string(1) "9"
string(1) "1"
