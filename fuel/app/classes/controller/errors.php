<?php
class Controller_Errors extends Controller_Base {
    
	public function action_404() {
        $this->template->content = Response::forge(View::forge('errors/404'),404);
	}
	
    public function action_500() {
        $this->template->content = Response::forge(View::forge('errors/500'),500);
    }
        
}