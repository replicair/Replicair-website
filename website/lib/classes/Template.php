<?php
class Template {
    protected $template_dir = "lib/templates/";
    protected $template_dir_alt = '../lib/templates/';
    protected $vars = array();
    public function __construct($template_dir = null) {
    	
    	$this->root = SITE_ROOT;
    	$this->path = SITE_PATH;
    	if ($template_dir !== null) {
            // Check here whether this directory really exists
            $this->template_dir = $template_dir;
        }
        
    }
    public function render($template_file) {
    	if ($template_file == NULL or $template_file == '') {
    		throw new Exception('no template file given.');
    	}
    	if (file_exists($this->template_dir.$template_file)) {
            include $this->template_dir.$template_file;
        } else if (file_exists($this->template_dir_alt.$template_file)) {
        	include $this->template_dir_alt.$template_file;
        } else {
        	
            throw new Exception('no template file ' . $template_file . ' present in directory ' . $this->template_dir);
        }
    }
    public function __set($name, $value) {
        $this->vars[$name] = $value;
    }
    public function __get($name) {
        if (isset($this->vars[$name])) {
        	return $this->vars[$name];
        }
    	return NULL;
    }
}
?>