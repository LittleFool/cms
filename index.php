<?php
session_start();

$mysql = array(
    'host' => 'localhost',
    'user' => 'webserver',
    'pw' => 'USC8sbaKz6Y6yjHP',
    'database' => 'cms',
    'tablePrefix' => 'cms_'
);

$registry = Registry::getInstance();

try {
    $registry->set('mysql', $mysql);
} catch (Exception $e) {
    //TODO handle the exception
}

function __autoload($className) {
      $fileName = __DIR__.'/classes/'.$className.'.php';
      
      if(!file_exists($fileName)) {
            throw new Exception($fileName.' not found!');
      }
      
      require_once "$fileName";
}

$page = new Page();
$page->loadPage();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Adminbereich</title>
    <link href="css/styles.css" rel="stylesheet" type="text/css">
    </head>
    <body>
    	<div id="leisteOben">
            <nav>
                <a href="index.php?page=seiten&amp;action=list">Seiten</a>
                <a href="index.php?page=newsletter">Newsletter</a>
            </nav>
        </div>
        <div id="content">
             <?php
             echo $page->getTpl();
             ?>
        </div>
    </body>
</html>
