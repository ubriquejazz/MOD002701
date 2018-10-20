<?php

	/* Manage Content - Navigation */

	function find_selected_page($public=false) {
		global $current_skill;
		global $current_page;
		
		if (isset($_GET["skill"])) {
			$current_skill = find_skill_by_id($_GET["skill"], $public);
			if ($current_skill && $public) {
				$current_page = find_default_page_for_skill($current_skill["id"]);
			} else {
				$current_page = null;
			}
		} elseif (isset($_GET["page"])) {
			$current_skill = null;
			$current_page = find_page_by_id($_GET["page"], $public);
		} else {
			$current_skill = null;
			$current_page = null;
		}
	}
	
	function public_navigation($skill_array, $page_array) {
		$output = "<ul class=\"skills\">";
		$skill_set = find_all_skills();		
	// 	$skill_set = find_all_skills();
		while($skill = mysqli_fetch_assoc($skill_set)) {
			$output .= "<li";
			if ($skill_array && $skill["id"] == $skill_array["id"]) {
				$output .= " class=\"selected\"";
			}
			$output .= ">";
			$output .= "<a href=\"index.php?skill=";
			$output .= urlencode($skill["id"]);
			$output .= "\">";
			$output .= htmlentities($skill["menu_name"]);
			$output .= "</a>";
			
			if ($skill_array["id"] == $skill["id"] || 
				$page_array["skill_id"] == $skill["id"]) 
			{
				$page_set = find_pages_for_skill($skill["id"]);
			//	$page_set = find_pages_for_skill($skill["id"]);
				$output .= "<ul class=\"pages\">";
				while($page = mysqli_fetch_assoc($page_set)) {
					$output .= "<li";
					if ($page_array && $page["id"] == $page_array["id"]) {
						$output .= " class=\"selected\"";
					}
					$output .= ">";
					$output .= "<a href=\"index.php?page=";
					$output .= urlencode($page["id"]);
					$output .= "\">";
					$output .= htmlentities($page["menu_name"]);
					$output .= "</a></li>";
				}
				$output .= "</ul>";
				mysqli_free_result($page_set);
			}

			$output .= "</li>"; // end of the skill li
		}
		mysqli_free_result($skill_set);
		$output .= "</ul>";
		return $output;
	}

	// navigation takes 2 arguments
	// - the current skill array or null
	// - the current page array or null
	function navigation($skill_array, $page_array) {
		$output = "<ul class=\"skills\">";
		//
		$skill_set = find_all_skills(false);
		while($skill = mysqli_fetch_assoc($skill_set)) {
			$output .= "<li";
			if ($skill_array && $skill["id"] == $skill_array["id"]) {
				$output .= " class=\"selected\"";
			}
			$output .= ">";
			$output .= "<a href=\"manage_content.php?skill=";
			$output .= urlencode($skill["id"]);
			$output .= "\">";
			$output .= htmlentities($skill["menu_name"]);
			$output .= "</a>";
			//
			$page_set = find_pages_for_skill($skill["id"], false);
			$output .= "<ul class=\"pages\">";
			while($page = mysqli_fetch_assoc($page_set)) {
				$output .= "<li";
				if ($page_array && $page["id"] == $page_array["id"]) {
					$output .= " class=\"selected\"";
				}
				$output .= ">";
				$output .= "<a href=\"manage_content.php?page=";
				$output .= urlencode($page["id"]);
				$output .= "\">";
				$output .= htmlentities($page["menu_name"]);
				$output .= "</a></li>";
			}
			mysqli_free_result($page_set);
			$output .= "</ul></li>";
		}
		mysqli_free_result($skill_set);
		$output .= "</ul>";
		return $output;
	}

	/* Manage User - Navigation */

	function find_selected_user($public=false) {
		global $current_user;
		
		if (isset($_GET["user"])) {
			$current_user = find_user_by_id($_GET["user"], $public);
		} else {
			$current_user = null;
		}
	}

	function user_nav($user_array){
		global $area;

		$output = "<ul class=\"skills\">";
 		for ($i = 1; $i < sizeof($area); $i++) {
			$output .= "<li>  {$area[$i]}  </li>";
			//
			$user_set = find_users_for_area($i, false);
			$output .= "<ul class=\"pages\">";
			while($user = mysqli_fetch_assoc($user_set)) {
				$output .= "<li";
				if ($user_array && $user["id"] == $user_array["id"]) {
					$output .= " class=\"selected\"";
				}
				$output .= ">";
				$output .= "<a href=\"manage_user.php?user=";
				$output .= urlencode($user["id"]);
				$output .= "\">";

				$email = htmlentities($user["email"]);
				$uname = explode("@", $email);
				$output .= $uname[0];
				$output .= "</a></li>";
			}
			mysqli_free_result($user_set);
			$output .= "</ul>";
		}
		$output .= "</ul>";
		return $output;
	}

	/* Content Sensitive (public input) */

	function find_all_skills($public = true) {
		global $connection;
		
		$query  = "SELECT * ";
		$query .= "FROM skills ";
		if ($public == true)
			$query .= "WHERE visible = 1 ";
		$query .= "ORDER BY position ASC";
		$skill_set = mysqli_query($connection, $query);
		confirm_query($skill_set);
		return $skill_set;
	}

	function find_skill_by_id($skill_id, $public=true) {
		global $connection;
		
		$safe_skill_id = mysqli_real_escape_string($connection, $skill_id);
		
		$query  = "SELECT * ";
		$query .= "FROM skills ";
		$query .= "WHERE id = {$safe_skill_id} ";
		if ($public) {
			$query .= "AND visible = 1 ";
		}
		$query .= "LIMIT 1";
		$skill_set = mysqli_query($connection, $query);
		confirm_query($skill_set);
		if($skill = mysqli_fetch_assoc($skill_set)) {
			return $skill;
		} else {
			return null;
		}
	}

	function find_page_by_id($page_id, $public=true) {
		global $connection;
		
		$safe_page_id = mysqli_real_escape_string($connection, $page_id);
		
		$query  = "SELECT * ";
		$query .= "FROM pages ";
		$query .= "WHERE id = {$safe_page_id} ";
		if ($public) {
			$query .= "AND visible = 1 ";
		}
		$query .= "LIMIT 1";
		$page_set = mysqli_query($connection, $query);
		confirm_query($page_set);
		if($page = mysqli_fetch_assoc($page_set)) {
			return $page;
		} else {
			return null;
		}
	}

	function find_pages_for_skill($skill_id, $public = true) {
		global $connection;
		
		$safe_skill_id = mysqli_real_escape_string($connection, $skill_id);	
		$query  = "SELECT * ";
		$query .= "FROM pages ";
		$query .= "WHERE skill_id = {$safe_skill_id} ";
		if ($public) {
			$query .= "AND visible = 1 ";
		}
		$query .= "ORDER BY position ASC";
		$page_set = mysqli_query($connection, $query);
		confirm_query($page_set);
		return $page_set;
	}

	function find_all_users($public = true) {
		global $connection;
		
		$query  = "SELECT * ";
		$query .= "FROM users ";
		if ($public == true)
			$query .= "WHERE visible = 1 ";
		$skill_set = mysqli_query($connection, $query);
		confirm_query($skill_set);
		return $skill_set;
	}

	function find_users_for_skill($skill_id, $public = true) {
		global $connection;
		
		$safe_skill_id = mysqli_real_escape_string($connection, $skill_id);	
		$query  = "SELECT user_id FROM skill_list ";
		$query .= "WHERE skill_id = {$safe_skill_id}" ;
		if ($public) {
			$query .= " AND visible = 1";
		}
		$id_set = mysqli_query($connection, $query);
		confirm_query($id_set);
		return $id_set;
	}

	function find_user_by_id($user_id, $public = true) {
		global $connection;
		
		$safe_user_id = mysqli_real_escape_string($connection, $user_id);	
		$query  = "SELECT * ";
		$query .= "FROM users ";
		$query .= "WHERE id = {$safe_user_id} ";
		if ($public) {
			$query .= "AND visible = 1 ";
		}
		$query .= "LIMIT 1";
		$user_set = mysqli_query($connection, $query);
		confirm_query($user_set);
		if($user = mysqli_fetch_assoc($user_set)) {
			return $user;
		} else {
			return null;
		}
	}

	function find_users_for_area($area_id, $public=true) {
		global $connection;
		
		$safe_area_id = mysqli_real_escape_string($connection, $area_id);	
		$query  = "SELECT * ";
		$query .= "FROM users ";
		$query .= "WHERE area = {$safe_area_id} ";
		if ($public) {
			$query .= "AND visible = 1 ";
		}
		$user_set = mysqli_query($connection, $query);
		confirm_query($user_set);
		return $user_set;
	}

	/* No content sensitive */

	function find_default_page_for_skill($skill_id) {
		$page_set = find_pages_for_skill($skill_id);
		if($first_page = mysqli_fetch_assoc($page_set)) {
			return $first_page;
		} else {
			return null;
		}
	}

	function find_username($user_id){
		if ($user_id > 0) {
			$user = find_user_by_id($user_id);
			$email = htmlentities($user["email"]);
			$uname = explode("@", $email);
			return $uname[0];			
		} else {
			return "no one";
		}
	}

	function find_skills_for_user($user_id) {
		global $connection;
		
		$safe_user_id = mysqli_real_escape_string($connection, $user_id);	
		$query  = "SELECT skill_id FROM skill_list ";
		$query .= "WHERE user_id = {$safe_user_id}";
		$id_set = mysqli_query($connection, $query);
		confirm_query($id_set);
		return $id_set;
	}	

	/* Manage Admins - Navigation */

	function find_all_admins() {
		global $connection;
		
		$query  = "SELECT * ";
		$query .= "FROM admins ";
		$query .= "ORDER BY username ASC";
		$admin_set = mysqli_query($connection, $query);
		confirm_query($admin_set);
		return $admin_set;
	}
	
	function find_admin_by_id($admin_id) {
		global $connection;
		
		$safe_admin_id = mysqli_real_escape_string($connection, $admin_id);
		
		$query  = "SELECT * ";
		$query .= "FROM admins ";
		$query .= "WHERE id = {$safe_admin_id} ";
		$query .= "LIMIT 1";
		$admin_set = mysqli_query($connection, $query);
		confirm_query($admin_set);
		if($admin = mysqli_fetch_assoc($admin_set)) {
			return $admin;
		} else {
			return null;
		}
	}

	function find_admin_by_username($username) {
		global $connection;
		
		$safe_username = mysqli_real_escape_string($connection, $username);
		
		$query  = "SELECT * ";
		$query .= "FROM admins ";
		$query .= "WHERE username = '{$safe_username}' ";
		$query .= "LIMIT 1";
		$admin_set = mysqli_query($connection, $query);
		confirm_query($admin_set);
		if($admin = mysqli_fetch_assoc($admin_set)) {
			return $admin;
		} else {
			return null;
		}
	}

?>
