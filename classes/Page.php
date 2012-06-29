<?php
/**
 * Loads the PHP file that serves this website.
 *
 * @author LittleFool
 */
class Page {
    /**
     * Get's set by the loaded PHP file and contains the website content.
     * 
     * @var String 
     */
    private $tpl = '';
    
    /**
     * Filename of the PHP file that we need to load.
     * 
     * @var String 
     */
    private $contentFile = '';
    
    public function __construct() {
	$this->contentFile = Helper::content();
    }
    
    /**
     * Returns the Templat, that got set from the loaded PHP file.
     * 
     * @return Template 
     */
    public function getTpl() {
	return $this->tpl;
    }
    
    /**
     * Includes the neede PHP file.
     *  
     */
    public function loadPage() {
	require '_mysql.php';
	if($this->contentFile != '') {
	    include_once $this->contentFile;
	}
    }
}
?>
