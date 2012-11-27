<?php
class View {
    protected $template_dir = '/ceri/homes1/f/fef/public_html/cs25010/template/';
    protected $vars = array();
    public function __construct() {
    }
    public function render($template_file) {
        if (file_exists($this->template_dir.$template_file)) {
            include $this->template_dir.$template_file;
        } else {
            throw new Exception('bugger');
        }
    }
    public function __set($name, $value) {
        $this->vars[$name] = $value;
    }
    public function __get($name) {
        return $this->vars[$name];
    }
}
?>
