<?php
require_once __DIR__ . '/../Model/sizeModel.php';
class ProductController
{
    private $sizeModel;

    public function __construct($db)
    {
        $this->sizeModel = new SizeModel($db);
    }

    public function getSizeById($id){
     
    }


}


