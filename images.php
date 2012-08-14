<?php
// action == list
if(isset($_GET['action']) && $_GET['action'] == 'list') {
    $registry = Registry::getInstance();
    $dir = $registry['website']['imagesFolder'];
    $tpl = new Template();
    $tpl->load("images_head.html");
    
    if(is_dir($dir)) {
        if($dirHandle = opendir($dir)) {
            while( ($file = readdir($dirHandle)) !== false ) {
               if($file != '.' && $file != '..') {
                   
               } 
            }
            closedir($dirHandle);
        }
    }
}
?>
