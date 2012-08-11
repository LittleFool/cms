<?php
// action == list
if( isset($_GET['action']) && $_GET['action'] == 'list' ) {
    $tpl = new Template();
    $tpl->load("seiten_head.html");
    $this->tpl .= $tpl->out();

    $mysql = Helper::getMysqlConfig();

    $db = new MySQLi($mysql['host'], $mysql['user'], $mysql['pw'], $mysql['database']);
    $sql = "SELECT `id`, `name`, `lastEdited` FROM `".$mysql['tablePrefix']."seiten`";
    $kommando = $db->prepare($sql);
    $kommando->execute();
    $kommando->bind_result($id, $name, $lastEdited);
    while($kommando->fetch()) {
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
if( isset($_GET['action']) && $_GET['action'] == 'edit' ) {
    $tpl = new Template();
    $tpl->load("seiten_edit.html");
    $this->tpl .= $tpl->out();
    
    $db = new MySQLi($mysql['host'], $mysql['user'], $mysql['pw'], $mysql['database']);
    $sql = "SELECT `id`, `name`, `content` FROM `".$mysql['tablePrefix']."seiten`";
    $kommando = $db->prepare($sql);
    $kommando->execute();
    $kommando->bind_result($id, $name, $content);
    $kommando->fetch();
    
    $tpl->assign('name', $name);
    $tpl->assign('content', $content);$tpl->load('seiten_body.html');
    $tpl->assign('id', $id);
    $this->tpl .= $tpl->out();
        
    $db->close();
}

// action == save
if( isset($_POST['action']) && isset($_POST['id']) && $_POST['action'] == 'save' && $_POST['id'] >= 0 ) {
    $skip_error = false;
    $tpl = new Template();
    
    if( isset($_POST['skip_error']) && $_POST['skip_error'] == 'yes' ) {
        $skip_error = true;
    }
    
    if( (!isset($_POST['content']) || $_POST['content'] == '') && $skip_error === false ) {
        $tpl->load("seiten_edit_error.html");
        $this->tpl .= $tpl->out();
    } else {
        $db = new MySQLi($mysql['host'], $mysql['user'], $mysql['pw'], $mysql['database']);
        $sql = "UPDATE `content` FROM `".$mysql['tablePrefix']."seiten` WHERE `id`=?";
        $kommando = $db->prepare($sql);
        $kommando->bind_param('si', $content, $id);
        $kommando->execute();
        $kommando->fetch();

        $db->close();
    }
}
?>
