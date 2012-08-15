<?php
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
    $allowedExts = array("jpg", "jpeg", "gif", "png");
    $extension = end(explode(".", $_FILES["file"]["name"]));
    $allowedTypes = array("image/gif", "image/jpeg", "image/pjpeg");
    $type = $_FILES["file"]["type"];

    if (in_array($type, $allowedTypes) && in_array($extension, $allowedExts)) {
        if ($_FILES["file"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
        } else {
            if (file_exists(PREVIOUS . $website['imageFolder'] . $_FILES["file"]["name"])) {
                echo $_FILES["file"]["name"] . " already exists. ";
            } else {
                move_uploaded_file($_FILES["file"]["tmp_name"], PREVIOUS . $website['imageFolder'] . $_FILES["file"]["name"]);
                echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
            }
        }
    } else {
        echo "Invalid file";
    }
}
?>
