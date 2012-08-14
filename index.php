<?php
session_start();

$mysql = array(
    'host' => 'localhost',
    'user' => 'webserver',
    'pw' => 'Pgliymv9cJTDSPEDz0QV',
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
        <script language="javascript" type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
        <script language="javascript" type="text/javascript" src="js/tiny_mce/jquery.tinymce.js"></script>
        <script language="javascript" type="text/javascript" src="js/functions.js"></script>
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
