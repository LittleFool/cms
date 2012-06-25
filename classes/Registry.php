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
    $this->config[$field] = $value;
  }

  public function get($field) {
    if (!isset($this->config[$field])) {
      throw new InvalidArgumentException('Unknown attribute '.$field);
    }
    return $this->config[$field];
  }
}
?>