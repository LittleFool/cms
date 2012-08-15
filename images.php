<?php
define('PREVIOUS', '../');

// action == list
if (isset($_GET['action']) && $_GET['action'] == 'list') {
    $registry = Registry::getInstance();
    $tpl = new Template();
    $tpl->load("images_head.html");
    $this->tpl .= $tpl->out();
    try {
        $website = $registry->get('website');
    } catch (Exception $e) {
        echo $e->getMessage();
    }
//    $dir = PREVIOUS.$website['imageFolder'];
    $dir = '../BookTo/images/navis';
    $i = 0;

    if(is_dir($dir)) {
        $files = scandir($dir);
        foreach($files as $file) {
            if ($file != '.' && $file != '..') {
                switch($i%2) {
                        case 0: $line = 'even'; break;
                        case 1: $line = 'odd'; break;
                    }
                    $i++;
//                    $preview = PREVIOUS.$website['imagesFolder'].$file;
                    $preview = '../BookTo/images/navis/'.$file;
                    $link = $website['imagesFolder'].$file;
                    

                    $tpl->load("images_body.html");
                    $tpl->assign('name', $file);
                    $tpl->assign('link', $link);
                    $tpl->assign('preview', $preview);
                    $tpl->assign('line', $line);
                    $this->tpl .= $tpl->out();
            }
        }
    }
    
    $tpl->load("images_footer.html");
    $this->tpl .= $tpl->out();
}

// action == delete
if (isset($_GET['action']) && isset($_POST['delete']) && is_array($_POST['delete']) && $_GET['action'] == 'delete') {
    foreach($_POST['delete'] as $file) {
        if(!unlink('../BookTo/images/navis/'.$file)) {
            die("Keine Schreibrechte f&uuml;r das Verzeichnis!");
        }
    }
    header('Location: http://192.168.201.3/cms/index.php?page=images&action=list');
}
?>
