<?php

namespace App\models;

class ModelErrorClass extends ModelAbstractClass{

    public function __construct($dataList=null,$currentElement=null)
    {
        parent::__construct($dataList,$currentElement);
        $this->modelName='errorModel';
    }

}