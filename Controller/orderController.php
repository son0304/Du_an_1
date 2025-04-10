<?php

require_once __DIR__ . '/../Model/orderModel.php';

class OrderController {
    private $orderModel;

    public function __construct($db) {
        $this->orderModel = new OrderModel($db);
    }
   
    
}

