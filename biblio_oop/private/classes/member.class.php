<?php

class Member extends DatabaseObject {

  static protected $table_name = "members";
  static protected $db_columns = ['id', 'first_name', 'last_name', 'email', 'phone'];

  public $id;
  public $first_name;
  public $last_name;
  public $email;
  public $phone;

  public function __construct($args=[]) {
    $this->first_name = $args['first_name'] ?? '';
    $this->last_name = $args['last_name'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->phone = $args['phone'] ?? '';
  }

  public function full_name() {
    return $this->first_name . " " . $this->last_name;
  }

  protected function validate() {
    $this->errors = [];

    if(is_blank($this->first_name)) {
      $this->errors[] = "First name cannot be blank.";
    } elseif (!has_length($this->first_name, array('min' => 2, 'max' => 255))) {
      $this->errors[] = "First name must be between 2 and 255 characters.";
    }

    if(is_blank($this->last_name)) {
      $this->errors[] = "Last name cannot be blank.";
    } elseif (!has_length($this->last_name, array('min' => 2, 'max' => 255))) {
      $this->errors[] = "Last name must be between 2 and 255 characters.";
    }

    if(is_blank($this->email)) {
      $this->errors[] = "Email cannot be blank.";
    } elseif (!has_length($this->email, array('max' => 255))) {
      $this->errors[] = "Email must be less than 255 characters.";
    } elseif (!has_valid_email_format($this->email)) {
      $this->errors[] = "Email must be a valid format.";
    }

    if(is_blank($this->phone)) {
      $this->errors[] = "Phone cannot be blank.";
    } elseif (!has_length($this->phone, array('min' => 11, 'max' => 13))) {
      $this->errors[] = "Phone must be between 11 and 13 characters.";
    }

    return $this->errors;
  }

  static public function find_by_phone($phone) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE phone='" . self::$database->escape_string($phone) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

} // end class

?>
