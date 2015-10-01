<?php
class Controller_Galerie extends Controller_Base {
   
    public function before() {
        parent::before(); 
    }
        
    public function after($response) {
        return parent::after($response);
    }

    // Accueil
    public function action_index() {  
        $data['pictures'] = Model_Picture::find('all', array(
            'order_by' => array('created_at' => 'asc')
        ));
        $this->template->content = View::forge('galerie/index', $data);
    }

}