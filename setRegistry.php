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

$page = array(
    'seiten' => 'seiten.php',
    'images' => 'images.php'
);

$registry = Registry::getInstance();
$registry->set('mysql', $mysql);
$registry->set('website', $website);
$registry->set('validPages', $page);
?>
