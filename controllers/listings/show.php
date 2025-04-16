<?php

$config = require basePath('/config/db.php');
$db = new Database($config);

$id = $_GET['id'] ?? '';
//inspect($id);

$params = ['id' => $id];

$listing = $db->query(
    "SELECT * FROM listings1 WHERE id = :id "
    ,$params
)->fetchAll();

//inspect($listing);

global $showData;
$showData = $listing[0];

loadView('listings/show');