<?php
if( isset($_GET['action']) && $_GET['action'] == 'list' ) {
    $tpl = new Template();
    $tpl->load("seiten_head.html");
    $this->tpl .= $tpl->out();

    $mysql = Helper::getMysqlConfig();

    $db = new MySQLi($mysql['host'], $mysql['user'], $mysql['pw'], $mysql['database']);
    $sql = "SELECT `id`, `name` FROM `".$mysql['tablePrefix']."seiten`";
    $kommando = $db->prepare($sql);
    $kommando->execute();
    $kommando->bind_result($id, $name);
    while($kommando->fetch()) {
        $tpl->load('seiten_body.html');
        $tpl->assign('name', $name);
        $tpl->assign('link', $name);
        $tpl->assign('bearbeiten', $id);
        $this->tpl .= $tpl->out();
    }
    $db->close();
}
?>
