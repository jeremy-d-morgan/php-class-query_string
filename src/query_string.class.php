<?php
/** 
 * query_string.class.php
 * 
 * PHP class to manipulate (add, edit, and remove) $_GET variables and 
 * return the variables as a preformated query string. 
 * 
 * @author Jeremy Morgan <jeremy@jeremymorgan.org> 
 * @copyright 2013 Jeremy Morgan 
 * @license https://raw.github.com/jeremymorgan-dot-org/php-class-query_string/master/LICENSE MIT License (MIT) 
 */
class query_string {
  
  /** 
   * Public Variable(s) 
   * @var string $value stores formated query string
   */ 
  public $value = "";
  
  /** 
   * Private Variable(s) 
   * @var array $get stores query string ($_GET) array
   */ 
  private $get = array();
  
  /** 
   * Grab the current $_GET value and update the query string value
   * @return void 
   */ 
  public function __construct() {  
    $this->get = $_GET;
    $this->updateValue();
  }
  
 /** 
  * Add or modify $get variables and update query string $value
  * @param array $vars key/value variables to be added or modified
  * @return void 
  */ 
  public function set($vars) {  
    foreach ($vars as $key => $value) {
      $this->get[$key] = $value;
    }
    $this->updateValue();
  }
  
  /** 
   * Remove $get variables and update query string $value
   * @param array $key variables to be reomved from $get
   * @return void 
   */ 
  public function remove($keys)  {  
    foreach ($keys as $key) {
      unset($this->get[$key]);
    }
    $this->updateValue();
  }
  
  /** 
   * Get the query string $value
   * @return string query string $value 
   */ 
  public function getValue() {  
    return $this->value;
  }
  
  /** 
   * Update the query string value (convert $get array to formated query string)
   * @return void 
   */ 
  private function updateValue () {
    //empty the value string
    $this->value = "";
    //first variable gets a prepended "?", rest get "&"
    $first = true;
    //generate GET query string
    foreach ($this->get as $key => $value) {
      //check if it's the first variable
      if ($first) {
        $pre = "?";
        $first = false;
      } else {
        $pre = "&";
      }
      //append variable string
      $this->value .= $pre.urlencode($key)."=".urlencode($value);
    }
  }
  
}

?>
