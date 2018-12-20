<?php

  // Members

  function find_all_members() {
    global $db;

    $sql = "SELECT * FROM members ";
    $sql .= "ORDER BY last_name ASC, first_name ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }  

  function find_member_by_id($id) {
    global $db;

    $sql = "SELECT * FROM members ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $member = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $member; // returns an assoc. array
  }

  function validate_member($member, $options=[]) {

    if(is_blank($member['first_name'])) {
      $errors[] = "First name cannot be blank.";
    } elseif (!has_length($member['first_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "First name must be between 2 and 255 characters.";
    }

    if(is_blank($member['last_name'])) {
      $errors[] = "Last name cannot be blank.";
    } elseif (!has_length($member['last_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Last name must be between 2 and 255 characters.";
    }

    if(is_blank($member['email'])) {
      $errors[] = "Email cannot be blank.";
    } elseif (!has_length($member['email'], array('max' => 255))) {
      $errors[] = "Last name must be less than 255 characters.";
    } elseif (!has_valid_email_format($member['email'])) {
      $errors[] = "Email must be a valid format.";
    }

    // Check if the phone is a valid UK code
    $phone_str = (string) $member['phone'];
    if(!has_length_exactly($phone_str, 11)) {
      $errors[] = "Phone number must have 11 digits.";
    }

    return $errors;
  }

  function insert_member($member) {
    global $db;

    $errors = validate_member($member);
    if (!empty($errors)) {
      return $errors;
    }

    $sql = "INSERT INTO members ";
    $sql .= "(first_name, last_name, email, phone) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $member['first_name']) . "',";
    $sql .= "'" . db_escape($db, $member['last_name']) . "',";
    $sql .= "'" . db_escape($db, $member['email']) . "',";
    $sql .= "'" . db_escape($db, $member['phone']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);

    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function update_member($member) {
    global $db;

    $sql = "UPDATE members SET ";
    $sql .= "first_name='" . db_escape($db, $member['first_name']) . "', ";
    $sql .= "last_name='" . db_escape($db, $member['last_name']) . "', ";
    $sql .= "email='" . db_escape($db, $member['email']) . "', ";
    $sql .= "phone='" . db_escape($db, $member['phone']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $member['id']) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function delete_member($member) {
    global $db;

    $sql = "DELETE FROM members ";
    $sql .= "WHERE id='" . db_escape($db, $member['id']) . "' ";
    $sql .= "LIMIT 1;";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  // Registers

  function find_all_registers() {
    global $db;

    $sql = "SELECT * FROM registers ";
    $sql .= "ORDER BY user_id ASC, id ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_register_by_id($id) {
    global $db;

    $sql = "SELECT * FROM registers ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $register = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $register; // returns an assoc. array
  }
  
  function validate_register($register) {
    $errors = [];

    // user_id
    if(is_blank($register['user_id'])) {
      $errors[] = "User cannot be blank.";
    }

    // page_id
    if(is_blank($register['page_id'])) {
      $errors[] = "Page cannot be blank.";
    }

    // check_in
    if(is_blank($register['check_in'])) {
      $errors[] = "Check-in cannot be blank.";
    } elseif(!has_length($register['check_in'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Name must be between 2 and 255 characters.";
    }

    // check_out
    if(is_blank($register['check_out'])) {
      $errors[] = "Check-out cannot be blank.";
    } elseif(!has_length($register['check_out'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Check-out must be between 2 and 255 characters.";
    }

    return $errors;
  }

  function insert_register($register) {
    global $db;

    $errors = validate_register($register);
    if(!empty($errors)) {
      return $errors;
    }

    // id
    $current_id = $register['id'] ?? '0';
    if(!has_unique_register($current_id)) {
      $errors[] = "ID must be unique.";
      return $errors;
    }

    $sql = "INSERT INTO registers ";
    $sql .= "(id, user_id, page_id, visible, content) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $register['id']) . "',";     
    $sql .= "'" . db_escape($db, $register['user_id']) . "',";
    $sql .= "'" . db_escape($db, $register['page_id']) . "',";
    $sql .= "'" . db_escape($db, $register['check_in']) . "',";
    $sql .= "'" . db_escape($db, $register['check_out']) . "',";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function update_register($register) {
    global $db;

    $errors = validate_register($register);
    if(!empty($errors)) {
      return $errors;
    }

    $sql = "UPDATE registers SET ";
    $sql .= "page_id='" . db_escape($db, $register['page_id']) . "', ";
    $sql .= "user_id='" . db_escape($db, $register['user_id']) . "', ";
    $sql .= "check_in='" . db_escape($db, $register['check_in']) . "', ";
    $sql .= "check_out='" . db_escape($db, $register['check_out']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $register['id']) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function delete_register($id) {
    global $db;

    $sql = "DELETE FROM registers ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function count_registers_by_user_id($user_id) {
    global $db;

    $sql = "SELECT COUNT(id) FROM registers ";
    $sql .= "WHERE user_id='" . db_escape($db, $subject_id) . "' ";
    $sql .= "ORDER BY id ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $row = mysqli_fetch_row($result);
    mysqli_free_result($result);
    return $row[0];
  }

  function find_registers_for_user($user_id){
    global $db;

    $sql = "SELECT * FROM registers ";
    $sql .= "WHERE user_id='" . db_escape($db, $user_id) . "' ";
    $sql .= "ORDER BY id ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

?>
