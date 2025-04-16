<?php

class ModelJobClass {

    private $currentJob = null;
    private $jobList = null;

    public function __construct($jobList=null,$currentJob=null)
    {
//        echo 'ModelJobState';
        $this->currentJob = $currentJob;
        $this->jobList = $jobList;
    }
    public function setJobList($jobList){
        $this->jobList = $jobList;
    }
    public function getJobList(){
        return $this->jobList;
    }
    public function setCurrentJob($currentJob){
        $this->currentJob = $currentJob;
    }
    public function getCurrentJob(){
//        echo 'getCurrentJob';
        return $this->currentJob;
    }

}