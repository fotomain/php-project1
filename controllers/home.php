<?php

$config = require basePath('/config/db.php');
$db = new Database($config);
$listings=$db->query('SELECT * FROM listings1 LIMIT 6')->fetchAll();
inspect($listings);

loadView("home");