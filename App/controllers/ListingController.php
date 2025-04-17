<?php

namespace App\controllers;

use Framework\Database;
use Framework\Validation;

class ListingController {
    protected $db;
    public function __construct()
    {
        $config = require basePath('/config/db.php');
        $this->db = new Database($config);
    }

    public function index() {

//        inspectAndDie(Validation::string('aa'));

        $listings=$this->db->query('SELECT * FROM listings1 ')->fetchAll();

        global $modelJob;
        $modelJob->setDataList($listings);

        loadView("listings/index");

    }

    public function create() {
        loadView("listings/create");
    }
    public function show($params) {
        $id = $params['id'] ?? '';
//inspect($id);

        $params = ['id' => $id];

        $listing = $this->db->query(
            "SELECT * FROM listings1 WHERE id = :id "
            ,$params
        )->fetchAll();

//inspect($listing);

        if(!$listing){
            ErrorController::notFound('Listing not found');
            return;
        }

        global $modelJob;
        $modelJob->setCurrentElement($listing[0]);

//global $showData;
//$showData = $listing[0];


        loadView('listings/show');

    }

}