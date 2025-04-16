<?php

namespace App\controllers;

use Framework\Database;

class ListingController {
    protected $db;
    public function __construct()
    {
        $config = require basePath('/config/db.php');
        $this->db = new Database($config);
    }

    public function index() {

        $listings=$this->db->query('SELECT * FROM listings1 ')->fetchAll();

        global $modelJob;
        $modelJob->setJobList($listings);

        loadView("listings/index");

    }

    public function create() {
        loadView("listings/create");
    }
    public function show() {
        $id = $_GET['id'] ?? '';
//inspect($id);

        $params = ['id' => $id];

        $listing = $this->db->query(
            "SELECT * FROM listings1 WHERE id = :id "
            ,$params
        )->fetchAll();

//inspect($listing);

        global $modelJob;
        $modelJob->setCurrentJob($listing[0]);

//global $showData;
//$showData = $listing[0];


        loadView('listings/show');

    }

}