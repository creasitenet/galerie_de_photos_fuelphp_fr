<?php
class Controller_Albums extends Controller_Base {
   
    public function before() {
        parent::before(); 
    }
        
    public function after($response) {
        return parent::after($response);
    }

    // Accueil
    public function action_index() {  
        $data['albums'] = Model_Album::find('all', array(
            'order_by' => array('created_at' => 'asc')
        ));
        $this->template->content = View::forge('albums/index', $data);
    }

    // Album
    public function action_album($id) {  
        $data['album'] = Model_Album::find($id);
        $this->template->content = View::forge('albums/index', $data);
    }

    // Ajouter
    public function action_ajouter() {
        if (Input::method() == 'POST') {
            $val = Model_Album::validate('create');
            if ($val->run()) {
                $album = Model_Album::forge(array(
                    'titre' => Input::post('titre'),
                    'slug' => Inflector::friendly_title(Input::post('titre')),
                ));
                if ($album and $album->save())       {
                    Session::set_flash('success', e("L'album a été ajouté. vous pouvez y ajouter des photos."));
                    Response::redirect('albums');
                } else {
                    Session::set_flash('error', e("Impossible d'ajouter l'album, contactez le webmaster."));
                }
            } else {
                Session::set_flash('error', $val->error());
            }
        }
        $this->template->title = "Albums";
        $this->template->content = View::forge('albums/ajouter');
    }

    // Modifier
    public function action_modifier($id = null) {
        $album = Model_Album::find($id);
        if ($album) {
            $val = Model_Album::validate('edit');
            if ($val->run()) {
                $album->titre = Input::post('titre');
                $album->slug = Inflector::friendly_title(Input::post('titre'));
                if ($album->save()) {
                    Session::set_flash('success', e("L'album a été modifié."));
                    Response::redirect('albums');
                } else {
                    Session::set_flash('error', e("Impossible de modifier l'album, contactez le webmaster."));
                }
            } else {
                if (Input::method() == 'POST') {
                    $album->titre = $val->validated('titre');
                    Session::set_flash('error', $val->error());
                }
                $this->template->set_global('album', $album, false);
                $this->template->set_global('photos', $album->photos, false);
            }
            $this->template->title = "Albums";
            $this->template->content = View::forge('albums/modifier');
        } else {
            Session::set_flash('error', e("Impossible de trouver l'album #$id."));
            Response::redirect('albums');
        }
    }

    // Supprimer
    public function action_supprimer($id) { 
        if ($album = Model_Album::find($id)) {
            $album->delete();
            Session::set_flash('success', e("L'album a été supprimé."));
        } else {
            Session::set_flash('error', e("Impossible de supprimer l'album, contactez le webmaster."));
        }
        Response::redirect('albums');
    }

}