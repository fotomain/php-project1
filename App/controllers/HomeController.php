<?php

namespace App\Controllers;

use Framework\Database;

class HomeController {
    protected $db;
    public function __construct()
    {
        $config = require basePath('/config/db.php');
        $this->db = new Database($config);
    }

    public function index() {

        global $modelJob;

        $listings=$modelJob::readFavorites($this->db);

        $modelJob->setDataList($listings);

        loadView("home");

    }

}