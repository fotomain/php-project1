<?php

use Framework\Database;

$config = require basePath('/config/db.php');
$db = new Database($config);
$listings=$db->query('SELECT * FROM listings1 LIMIT 6')->fetchAll();

//inspect($listings);

global $jobArray;
$jobArray=$listings;

loadView("listings/index",array(
    'listings' => $listings
));

