<?php
class Controller_Base extends Controller_Template {

    public $template = 'template';

	public function before(){		
		parent::before(); 
	}

    public function after($response) {
        return parent::after($response);
    }

}