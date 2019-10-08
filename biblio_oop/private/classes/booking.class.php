<?php

class Booking extends DatabaseObject {

  static protected $table_name = "bookings";
  static protected $db_columns = ['id', 'user_id', 'bike_id', 'date_in', 'date_out', 'description'];

  public $id;
  public $user_id;
  public $bike_id;
  public $date_in;
  public $date_out;
  public $description;

  protected $skip_validation = false;
  const MAX_PERIOD = 15*60*60*24; // 15 days 

  public function __construct($args=[]) {
    $this->user_id = $args['user_id'] ?? '';
    $this->bike_id = $args['bike_id'] ?? '';
    $this->date_in = $args['date_in'] ?? date('2010-01-01');
    $this->date_out = $args['date_out'] ?? date('2010-01-01');
    $this->description = $args['description'] ?? '';
  }

  public function renew_dates(){
    $this->date_in = date("Y-m-d");
    $this->date_out = date("Y-m-d", time() + self::MAX_PERIOD);
    return true;
  }

  public function valid_dates(){
    $past = strtotime($this->date_in);
    $future = strtotime($this->date_out);
    return $past < $future;
  }

  public function is_expired(){
    $future = strtotime($this->date_out);
    if( time() < $future) {
      return false;
    } 
    return true;
  }

  public function full_name() {
    return $this->date_out;
  }

  protected function update() {
    $this->skip_validation = true;
    return parent::update();
  }

  protected function validate() {
    $this->errors = [];

    if (!$this->skip_validation && !is_unbooked_bicycle($this->bike_id) ) {
      $this->errors[] = "Bicycle is already booked. Try another.";
    }

    if (is_blank($this->bike_id)) {
      $this->errors[] = "Bicycle cannot be blank.";
    } elseif (!is_real_bicycle($this->bike_id)) {
      $this->errors[] = "Bicycle does not exist. Try another.";
    } 

    if (!is_real_user($this->user_id)) {
      $this->errors[] = "Member does not exist. Try another.";
    }

    if(is_blank($this->date_in)) {
      $this->errors[] = "Check-in cannot be blank.";
    }

    if(is_blank($this->date_out)) {
      $this->errors[] = "Check-out cannot be blank.";
    } elseif (!$this->valid_dates()) {
      $this->errors[] = "Check-out should be later.";
    }

    return $this->errors;
  }

  static function find_by_user_id($id) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE user_id='" . self::$database->escape_string($id) . "'";
    return static::find_by_sql($sql);
  }

  static function count_by_user_id($id) {
    $sql = "SELECT COUNT(id) FROM " . static::$table_name . " ";
    $sql .= "WHERE user_id='" . self::$database->escape_string($id) . "'";
    $result_set = self::$database->query($sql);
    $row = $result_set->fetch_row();
    $result_set->free();
    return $row[0];
  }

  static function find_by_bike_id($id) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE bike_id='" . self::$database->escape_string($id) . "'";
    return static::find_by_sql($sql);
  }

} // end class

?>


