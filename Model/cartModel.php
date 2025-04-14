<?php
require_once '../../Config/config.php';

class CartModel
{
  public $conn;
  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function listCartModel()
  {
      
  }
  
}
