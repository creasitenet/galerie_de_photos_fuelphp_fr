<?php
class Controller_Erreurs extends Controller_Base {
    
	public function action_404() {
        $this->template->content = Response::forge(View::forge('erreurs/404'),404);
	}
	
    public function action_500() {
        $this->template->content = Response::forge(View::forge('erreurs/500'),500);
    }
        
}