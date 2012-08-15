<?php
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
//    $dir = '../'.$website['imageFolder'];
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
//                    $preview = '../'.$website['imagesFolder'].$file;
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
?>
