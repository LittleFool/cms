<?php
session_start();

function __autoload($className) {
      $fileName = __DIR__.'/classes/'.$className.'.php';
      
      if(!file_exists($fileName)) {
            throw new Exception($fileName.' not found!');
      }
      
      require_once "$fileName";
}
require_once 'setRegistry.php';

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
                <a href="index.php?page=seiten&amp;action=list"><?php Helper::naviDown('seiten'); ?>Seiten</a>
                <a href="index.php?page=images"><?php Helper::naviDown('images'); ?>Bilder</a>
            </nav>
        </div>
        <div id="content">
             <?php
                echo $page->getTpl();
             ?>
        </div>
    </body>
</html>
