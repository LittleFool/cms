<?php
$mysql = array(
    'host' => 'localhost',
    'user' => 'webserver',
    'pw' => 'Pgliymv9cJTDSPEDz0QV',
    'database' => 'cms',
    'tablePrefix' => 'cms_'
);

$website = array(
    'name' => 'laufschule-dortmund.de',
    'imagesFolder' => 'images/'
);

$registry = Registry::getInstance();
$registry->set('mysql', $mysql);
$registry->set('website', $website);
?>
