<?php

// action == list
if (isset($_GET['action']) && $_GET['action'] == 'list') {
    $tpl = new Template();
    $tpl->load("seiten_head.html");
    $this->tpl .= $tpl->out();

    $mysql = Helper::getMysqlConfig();

    // list all websites
    $db = new MySQLi($mysql['host'], $mysql['user'], $mysql['pw'], $mysql['database']);
    $sql = "SELECT `id`, `name`, `lastEdited` FROM `" . $mysql['tablePrefix'] . "seiten`";
    $kommando = $db->prepare($sql);
    $kommando->execute();
    $kommando->bind_result($id, $name, $lastEdited);
    while ($kommando->fetch()) {
        $tpl->load('seiten_body.html');
        $tpl->assign('name', $name);
        $tpl->assign('link', $name);
        $tpl->assign('changed', $lastEdited);
        $tpl->assign('id', $id);
        $this->tpl .= $tpl->out();
    }
    $db->close();

    $tpl->load("seiten_footer.html");
    $this->tpl .= $tpl->out();
}

// action == edit
if (isset($_GET['action']) && $_GET['action'] == 'edit') {
    $tpl = new Template();
    $tpl->load("seiten_edit.html");

    $mysql = Helper::getMysqlConfig();

    // get the current website
    $db = new MySQLi($mysql['host'], $mysql['user'], $mysql['pw'], $mysql['database']);
    $sql = "SELECT `id`, `name`, `content` FROM `" . $mysql['tablePrefix'] . "seiten`";
    $kommando = $db->prepare($sql);
    $kommando->execute();
    $kommando->bind_result($id, $name, $content);
    $kommando->fetch();

    // show the editor with the content
    $tpl->assign('name', $name);
    $tpl->assign('content', $content);
    $tpl->assign('id', $id);
    $this->tpl .= $tpl->out();

    $db->close();
}

// action == save
if (isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] == 'save' && $_GET['id'] >= 0) {
    $tpl = new Template();

    $mysql = Helper::getMysqlConfig();
    $content = stripslashes($_POST['content']);
    $id = $_GET['id'];

    // update the website
    $db = new MySQLi($mysql['host'], $mysql['user'], $mysql['pw'], $mysql['database']);
    $sql = "UPDATE `" . $mysql['tablePrefix'] . "seiten` SET `content`=? WHERE `id`=?";
    $kommando = $db->prepare($sql);
    $kommando->bind_param('si', $content, $id);
    $kommando->execute();
    $kommando->fetch();
    $db->close();

    // show the user the overview
    header('Location: http://admin.laufschule-dortmund.de/index.php?page=seiten&amp;action=list');
}
?>
