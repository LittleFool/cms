<?php
if( isset($_GET['action']) && $_GET['action'] == 'list' ) {
    $tpl = new Template();
    $tpl->load("seiten_head.html");
    $this->tpl.add($tpl);

    $mysql = Helper::getMysqlConfig();

    $db = new MySQLi($mysql['host'], $mysql['user'], $mysql['pw'], $mysql['database']);
    $sql = 'SELECT `id`, `name` FROM `?seiten`';
    $kommando = $db->prepare($sql);
    $kommando->bind_result($id, $name);
    $kommando->bind_param('s', $mysql['tablePrefix']);
    $kommando->execute();
    while($kommando->fetch()) {
        $tpl->load('seiten_body.html');
        $tpl->assign('name', $name);
        $tpl->assign('link', $name);
        $tpl->assign('bearbeiten', $id);
    }
    $db->close();
}
?>
