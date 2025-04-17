<?php

namespace App\models;

abstract class ModelAbstractClass {

    public $modelName = '';
    private $errorMessage = '';
    private $currentElement = null;
    private $dataList = null;

    public function __construct($dataList=null,$currentElement=null)
    {
        $this->currentElement = $currentElement;
        $this->dataList = $dataList;
    }
    public function setDataList($dataList):mixed{
        $this->dataList = $dataList;
        return $this;
    }
    public function getDataList(){
        return $this->dataList;
    }
    public function setCurrentElement($currentElement):mixed{
        $this->currentElement = $currentElement;
        return $this;
    }
    public function getCurrentElement(){
        return $this->currentElement;
    }

    public function setErrorMessage($errorMessage):mixed{
        $this->errorMessage = $errorMessage;
        return $this;
    }

    public function getErrorMessage():mixed{
//        inspect($this->errorMessage);
        return $this->errorMessage;
    }

}