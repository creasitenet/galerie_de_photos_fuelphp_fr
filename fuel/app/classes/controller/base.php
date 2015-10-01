<?php
class Controller_Base extends Controller_Template {

    public $template = 'template';

	public function before(){		
		parent::before();  

        // Title
        $this->title = "Galerie ";

        // Datas
        $this->data = array();
		
	}

    public function after($response) {
        // Title 
        $this->template->title = $this->title;
        // Response [OBLIGATOIRE]
        return parent::after($response);
    }

}