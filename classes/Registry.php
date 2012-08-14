<?php
class Registry {
  private $config = array();

  public static function getInstance() {
    static $instance;
    if (!(isset($instance) && is_object($instance))) {
      $instance = new Registry();
    }
    return $instance;
  }

  public function set($field, $value) {
      if($field == 'mysql' && is_array($value) && count($value) == 5) {
          $this->config[$field] = $value;
          return true;
      } elseif($field == 'website' && is_array($value) && count($value) == 2) {
          $this->config[$field] = $value;
          return true;
      } elseif($field == 'validPages' && is_array($value) && count($value) == 2) {
          $this->config[$field] = $value;
          return true;
      }
      
      throw new InvalidArgumentException('Invalid field "'.$field.'" or field has invalid value/type.');
  }

  public function get($field) {
    if (!isset($this->config[$field])) {
      throw new InvalidArgumentException('Unknown attribute '.$field);
    }
    return $this->config[$field];
  }
}
?>
