<?php

// Helper functions
function exit_status($str) {
    echo json_encode(array('status' => $str));
    exit;
}

function get_extension($file_name) {
    $ext = explode('.', $file_name);
    $ext = array_pop($ext);
    return strtolower($ext);
}

define('PREVIOUS', '../');
$registry = Registry::getInstance();
try {
    $website = $registry->get('website');
} catch (Exception $e) {
    echo $e->getMessage();
}

// action == list
if (isset($_GET['action']) && $_GET['action'] == 'list') {
    $tpl = new Template();
    $tpl->load("images_head.html");
    $this->tpl .= $tpl->out();
//    $dir = PREVIOUS.$website['imageFolder'];
    $dir = '../BookTo/images/navis';
    $i = 0;

    if (is_dir($dir)) {
        $files = scandir($dir);
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                switch ($i % 2) {
                    case 0: $line = 'even';
                        break;
                    case 1: $line = 'odd';
                        break;
                }
                $i++;
//                    $preview = PREVIOUS.$website['imagesFolder'].$file;
                $preview = '../BookTo/images/navis/' . $file;
                $link = $website['imagesFolder'] . $file;


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
    foreach ($_POST['delete'] as $file) {
        if (!unlink('../BookTo/images/navis/' . $file)) {
            die("Keine Schreibrechte f&uuml;r das Verzeichnis!");
        }
    }
    header('Location: http://192.168.201.3/cms/index.php?page=images&action=list');
}

// action == save
if (isset($_GET['action']) && $_GET['action'] == 'save') {
    $upload_dir = PREVIOUS.$website['imagesFolder'];
    $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');

    if (strtolower($_SERVER['REQUEST_METHOD']) != 'post') {
        exit_status('Error! Wrong HTTP method!');
    }

    if (array_key_exists('pic', $_FILES) && $_FILES['pic']['error'] == 0) {
        $pic = $_FILES['pic'];

        if (!in_array(get_extension($pic['name']), $allowed_ext)) {
            exit_status('Only ' . implode(',', $allowed_ext) . ' files are allowed!');
        }
        
        // Move the uploaded file from the temporary 
        // directory to the uploads folder:
        if (move_uploaded_file($pic['tmp_name'], $upload_dir . $pic['name'])) {
            exit_status('File was uploaded successfuly!');
        }
    }
}
?>
