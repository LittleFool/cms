<?php
session_start();

$mysql = array(
    'host' => 'localhost',
    'user' => 'webserver',
    'pw' => 'USC8sbaKz6Y6yjHP',
    'database' => 'cms'
);

$registry = Registry::getInstance();
$registry->set('mysql', $mysql);

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
                <a href="#">Seiten</a>
                <a href="#">Newsletter</a>
            </nav>
        </div>
        <div id="content">
             
        </div>
    </body>
</html>
