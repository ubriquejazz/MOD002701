<?php
	
	require_once("../includes/navigation.php");

 	$area = array("None", "Cambridge", "Chelmsford", "Peterborough");

	function redirect_to($new_location) {
	  header("Location: " . $new_location);
	  exit;
	}

	function mysql_prep($string) {
		global $connection;
		
		$escaped_string = mysqli_real_escape_string($connection, $string);
		return $escaped_string;
	}
	
	function confirm_query($result_set) {
		if (!$result_set) {
			die("Database query failed.");
		}
	}

	function form_errors($errors=array()) {
		$output = "";
		if (!empty($errors)) {
		  $output .= "<div class=\"error\">";
		  $output .= "Please fix the following errors:";
		  $output .= "<ul>";
		  foreach ($errors as $key => $error) {
		    $output .= "<li>";
				$output .= htmlentities($error);
				$output .= "</li>";
		  }
		  $output .= "</ul>";
		  $output .= "</div>";
		}
		return $output;
	}

	/* Security Functions */

	function password_encrypt($password) {
  	  $hash_format = "$2y$10$";   	// Tells PHP to use Blowfish with a "cost" of 10
	  $salt_length = 22; 			// Blowfish salts should be 22-characters or more
	  $salt = generate_salt($salt_length);
	  $format_and_salt = $hash_format . $salt;
	  $hash = crypt($password, $format_and_salt);
		return $hash;
	}
	
	function generate_salt($length) {
	  // Not 100% unique, not 100% random, but good enough for a salt
	  // MD5 returns 32 characters
	  $unique_random_string = md5(uniqid(mt_rand(), true));
	  
		// Valid characters for a salt are [a-zA-Z0-9./]
	  $base64_string = base64_encode($unique_random_string);
	  
		// But not '+' which is valid in base64 encoding
	  $modified_base64_string = str_replace('+', '.', $base64_string);
	  
		// Truncate string to the correct length
	  $salt = substr($modified_base64_string, 0, $length);
	  
		return $salt;
	}
	
	function password_check($password, $existing_hash) {
		// existing hash contains format and salt at start
	  $hash = crypt($password, $existing_hash);
	  if ($hash === $existing_hash) {
	    return true;
	  } else {
	    return false;
	  }
	}

	function attempt_login($username, $password) {
		$admin = find_admin_by_username($username);
		if ($admin) {
			// found admin, now check password
			if (password_check($password, $admin["hashed_password"])) {
				// password matches
				return $admin;
			} else {
				// password does not match
				return false;
			}
		} else {
			// admin not found
			return false;
		}
	}

	function confirm_admin() {
		if ($_SESSION['user_id'] > 0) {
			return false;
		}
		else {
			// 
			return true;
		}
	}	
	
	function logged_in() {
		return isset($_SESSION['admin_id']);
	}

	function confirm_logged_in() {
		if (!logged_in()) {
			redirect_to("login.php");
		}
	}

	/* Dropdown Boxes */

	function find_inquirer() {
		global $current_page;

		$output = "";
		$user_set = find_all_users(true);
		while ($user = mysqli_fetch_assoc($user_set)){
			$email = htmlentities($user["email"]);
			$uname = explode("@", $email);
			$output .= "<option value=\"{$user["id"]}\"";
			if ($current_page["inquirer"] == $user["id"]) {
				$output .= " selected";
			}
			$output .= ">{$uname[0]}</option>";
		}
		mysqli_free_result($user_set);
		return $output;
	}
	
	function find_contributor() {
		global $current_page;

		$output = "";
		$user_set = find_users_for_skill($current_page["skill_id"], false);
		while ($response = mysqli_fetch_assoc($user_set)){
			$user_id = $response["user_id"];
			$user = find_user_by_id($user_id);
			$email = htmlentities($user["email"]);
			$uname = explode("@", $email);
			$output .=  "<option value=\"{$user["id"]}\"";
			if ($current_page["contributor"] == $user["id"]) {
				$output .=  " selected";
			}
			$output .=  ">{$uname[0]}</option>";
		}
		mysqli_free_result($user_set);
		$output .=  "<option value=\"0\">no one</option>";
		return $output;
	}

	function find_user() {
		$output = "";
		$user_set = find_all_users(true);
		while ($user = mysqli_fetch_assoc($user_set)){
			$email = htmlentities($user["email"]);
			$uname = explode("@", $email);
			$output .= "<option value=\"{$user["id"]}\"";
			$output .= ">{$uname[0]}</option>";
		}
		mysqli_free_result($user_set);
		$output .=  "<option value=\"0\">admin</option>";
		return $output;
	}

	/* Manage User - Feedbacks */

	function find_inquires($user_id,$public=true) {
		global $connection;
		
		$safe_user_id = mysqli_real_escape_string($connection, $user_id);	
		$query  = "SELECT * FROM pages ";
		$query .= "WHERE inquirer = {$safe_user_id} ";
		if ($public) {
			$query .= "AND visible = 1 ";
		}
		$query .= "ORDER BY position ASC";
		$page_set = mysqli_query($connection, $query);
		confirm_query($page_set);
		return $page_set;
	}

	function find_contributions($user_id, $public=true) {
		global $connection;
		
		$safe_user_id = mysqli_real_escape_string($connection, $user_id);	
		$query  = "SELECT * FROM pages ";
		$query .= "WHERE contributor = {$safe_user_id} ";
		if ($public) {
			$query .= "AND visible = 1 ";
		}
		$query .= "ORDER BY position ASC";
		$page_set = mysqli_query($connection, $query);
		confirm_query($page_set);
		return $page_set;
	}

	function find_available_inquires($user_id, $public=true) {
		global $connection;
		
		$safe_user_id = mysqli_real_escape_string($connection, $user_id);	
		$query  = "SELECT * FROM pages ";
		$query .= "WHERE inquirer = {$safe_user_id} ";		
		$query .= "AND contributor = 0 ";
		if ($public) {
			$query .= "AND visible = 1 ";
		}
		$query .= "ORDER BY position ASC";		
		$page_set = mysqli_query($connection, $query);
		confirm_query($page_set);
		return $page_set;
	}

	// it shows the availabe inquires (no contributor) 
	// for all the skills in the selected area (id)
	function show_available_pages($page_array, $area_id){
		$output = "";
		$user_set = find_users_for_area($area_id);
		while($user = mysqli_fetch_assoc($user_set)) {
		//	$output .= $user["id"];
			$page_set = find_available_inquires($user["id"]);
			$output .= "<ul class=\"pages\">";
			while($page = mysqli_fetch_assoc($page_set)) {
				$output .= "<li";
				if ($page_array && $page["id"] == $page_array["id"]) {
					$output .= " class=\"selected\"";
				}
				$output .= ">";
				$output .= "<a href=\"show_page.php?page=";
				$output .= urlencode($page["id"]);
				$output .= "\">";
				$output .= htmlentities($page["menu_name"]);
				$output .= "</a></li>";
			}
			$output .= "</ul>";
			mysqli_free_result($page_set);
		}
		mysqli_free_result($user_set);
		return $output;
	}

	/* User Area - Navigation */

	function user_request_nav_int($page_set, $page_array, $inquirer){
		$output = "<ul class=\"pages\">";
		while($page = mysqli_fetch_assoc($page_set)) {
			$output .= "<li";
			if ($page_array && $page["id"] == $page_array["id"]) {
				$output .= " class=\"selected\"";
			}
			$output .= ">";
			if ($inquirer == "1"){
				$output .= "<a href=\"show_page.php?inquirer=1&page=";
			} else {	
				// inquirer
				$output .= "<a href=\"show_page.php?inquirer=0&page=";
			}
			$output .= urlencode($page["id"]);
			$output .= "\">";
			$output .= htmlentities($page["menu_name"]);
			$output .= "</a></li>";
		}
		mysqli_free_result($page_set);
		$output .= "</ul></br>";
		return $output;
	}
	
	function user_request_nav($page_array, $inquirer, $user_id){
		global $area;
		$user = find_user_by_id($user_id, false);

		$output = "<ul class=\"skills\">";		
		if ($inquirer == "1"){
			$output .= "<li> My Contributions </li>";
			$page_set = find_contributions($user_id);
		} else {
			// inquirer
			$output .= "<li> State of my inquires </li>";
			$page_set = find_inquires($user_id);		
		}
		$output .= user_request_nav_int($page_set, $page_array, $inquirer);

		if ($inquirer == "1") {
			$output .= "<li> Available Inquires (";
			$output .= $area[$user["area"]] . ")</a></li>";
			$output .= show_available_pages($page_array, $user["area"]);
			$output .= "<br/><li><a href=\"contact.php?role=1";
			$output .= "\">I want to contribute</a></li><br>";
			$output .= "<li><a href=\"feedback.php?role=1";
		} else {	
			// inquirer
			$output .= "<li><a href=\"contact.php?role=2";
			$output .= "\">I want to create a new inquire</a></li><br>";
			$output .= "<li><a href=\"feedback.php?role=0";
		}
		$output .= "\">I want to leave a feedback</a></li>";
		$output .= "</ul>";
		return $output;
	}

?>
