<?php
// view.php - Author Felix Farquharson (fef)
// This class defines a simple view mangement
// class, which is basicly only used to facilitate
// templating, but also means that I can seperate
// the HTML from the PHP logic. (which helps me 
// think)

class View {
    protected $template_dir = 
        '/ceri/homes1/f/fef/public_html/cs25010/template/';
    protected $vars = array();

    public function __construct() {
    }

    //when the render function is called we get the template
    //and include it into the page (the template file will 
    //then return all the HTML)
    public function render($template_file) {
        include $this->template_dir.$template_file;
    }

    public function __set($name, $value) {
        $this->vars[$name] = $value;
    }

    public function __get($name) {
        return $this->vars[$name];
    }
}
?>
