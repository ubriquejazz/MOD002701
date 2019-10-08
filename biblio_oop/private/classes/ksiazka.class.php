<?php

class Ksiazka extends DatabaseObject {

  static protected $table_name = 'ksiazki';
  static protected $db_columns = ['id', 'title', 'category', 'isbn', 'year', 
          'first_name', 'last_name', 'publisher', 'city', 
          'letter', 'condition_id', 'description'];

  public $id;
  public $title;
  public $category;
  public $isbn;
  public $year;
  public $first_name;
  public $last_name;  
  public $publisher;
  public $city;
  public $letter;
  public $condition_id;
  public $description;

  const CATEGORIES =  [ 'Powieść', 'Różne', 'Historia', 'Biografia', 'Religia','DVD', 'Albumy', 'Klasyka polska', 'Klasyka zagraniczna','Poezja', 'Młodzieżowa/Dziecięca'];

  const CONDITION_OPTIONS = [
    1 => 'Beat up',
    2 => 'Decent',
    3 => 'Dobrze',
    4 => 'Great',
    5 => 'Like New'
  ];

  public function __construct($args=[]) {
    $this->title = $args['title'] ?? '';
    $this->category = $args['category'] ?? '';
    $this->isbn = $args['isbn'] ?? '';
    $this->year = $args['year'] ?? '';
    // publisher/author
    $this->first_name = $args['first_name'] ?? '';
    $this->last_name = $args['last_name'] ?? '';
    $this->publisher = $args['publisher'] ?? '';   
    $this->city = $args['city'] ?? '';
    // library
    $this->letter = $args['letter'] ?? '';
    $this->condition_id = $args['condition_id'] ?? 3;
    $this->description = $args['description'] ?? '';
    // Caution: allows private/protected properties to be set
    // foreach($args as $k => $v) {
    //   if(property_exists($this, $k)) {
    //     $this->$k = $v;
    //   }
    // }
  }

  public function name() {
    return "{$this->title}, {$this->last_name} {$this->year}";
  }

  public function author() {
    return "{$this->first_name} {$this->last_name}";
  }

  public function condition() {
    if($this->condition_id > 0) {
      return self::CONDITION_OPTIONS[$this->condition_id];
    } else {
      return "Unknown";
    }
  }

  protected function validate() {
    $this->errors = [];

    if(is_blank($this->title)) {
      $this->errors[] = "Title cannot be blank.";
    }
    if(is_blank($this->last_name)) {
      $this->errors[] = "Author cannot be blank.";
    }
    return $this->errors;
  }

  static function find_by_category($id) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE category='" . self::$database->escape_string($id) . "'";
    return static::find_by_sql($sql);
  }

// CREATE TABLE ksiazki (
//   id INT(11) AUTO_INCREMENT PRIMARY KEY,
//   title VARCHAR(255) NOT NULL,
//   category VARCHAR(255) NOT NULL,
//   isbn VARCHAR(13) NOT NULL,
//   year INT(4) NOT NULL,
//   first_name VARCHAR(255) NOT NULL,
//   last_name VARCHAR(255) NOT NULL,
//   publisher VARCHAR(255) NOT NULL,
//   city VARCHAR(255) NOT NULL,
//   letter VARCHAR(255) NOT NULL,
//   condition_id TINYINT(3) NOT NULL,
//   description TEXT NOT NULL
//);
//
// INSERT INTO ksiazki (title, category, isbn, year, first_name, last_name, publisher, city, letter, condition_id, description) VALUES ('RFiD','DVD','9781107030404', '2016', 'Marco', 'Roselli','Cambridge','Cambridge','R', '3','');

} // end class

?>