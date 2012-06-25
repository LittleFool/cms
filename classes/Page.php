<?php
/**
 * Description of Page
 *
 * @author LittleFool
 */
class Page {
    private $tpl = null;
    private $contentFile = '';
    
    public function __construct() {
	$this->tpl = new Template();
	$this->contentFile = Helper::content();
    }
    
    public function getTpl() {
	return $this->tpl;
    }
    
    public function loadPage() {
	require '_mysql.php';
	if($this->contentFile != '') {
	    include $this->contentFile;
	}
    }
}
?>
