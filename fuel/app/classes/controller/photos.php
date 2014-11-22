<?php
class Controller_Admin_Photos extends Controller_Admin 
{

    // Index : toutes le sphotos (inutile)
	public function action_index()
	{
		$data['elements'] = Model_Photo::find('all');
		$this->template->title = "Photos";
		$this->template->content = View::forge('admin\photos/index', $data);

	}

    // Upload Ajax (ajax_filedrop_album_photos), retour json
    // A refaire avec l'Upload class de Fuel php
	public function action_ajax_filedrop_album()
	{
		$demo_mode = false;   
		$d=array();
        $d['resultat'] = "non"; 
		// get l'album_id enregistré en session
		$element_id = Session::get('element_id');

        $fileup=$_FILES['fileup'];
        $fileup_name=$_FILES['fileup']['name'];
        $fileup_nom=Inflector::underscore($_FILES['fileup']['name']);
        $fileup_poids=$_FILES['fileup']['size'];
        $fileup_erreur=$_FILES['fileup']['error'];
        $fileup_type=$_FILES['fileup']['type'];
        $fileup_tmp_name=$_FILES['fileup']['tmp_name'];

        $fichier_erreurs = array(
        0=>"Upload réussi..",
        1=>"Le fichier dépasse le 'upload_max_filesize' de php.ini.",
        2=>"Le fichier dépasse le 'MAX_FILE_SIZE' spécifiée dans le formulaire HTML.",
        3=>"Le fichier n'a été que partiellement téléchargé.",
        4=>"Aucun fichier n'a été uploadé.",
        6=>"Pas de dossier temporaire, contactez le webmaster.",
        7=>"Échec de l'écriture du fichier sur le disque.");

        if($fileup_erreur!=0) { // Erreur
            $erreur = $fichier_erreurs[$fileup_erreur];
        }

        // Extension 
        if (!isset($erreur)) {
	        $ext = explode('.', $fileup_name);
	        $fileup_extension = array_pop($ext);
	        $image_extensions_autorisees = array ('bmp', 'gif', 'iff', 'jp2', 'jpg', 'jpeg', 'png', 'psd', 'tiff', 'wbmp');
	        if (!in_array($fileup_extension, $image_extensions_autorisees)) {
	            $erreur = $fileup_name." : Extension de fichier non supportée !";
	        }
	    }

        // Poid maximum
        if (!isset($erreur)) {
	        if(($fileup_poids==0) OR ($fileup_poids > 2000000)) {
	            if($fileup_poids==0) {
	                 $erreur = 'Fichier de 0 ko !';
	            } elseif ($fileup_poids>2000000) {
	                $erreur = $fileup_name." : trop lourd : Max 2mo !"; 
	            }
	        }
	    }

        // Taille
        if (!isset($erreur)) {
	        $fileup_taille = getimagesize($fileup_tmp_name);
	        if (($fileup_taille[0] > 2048) OR ($fileup_taille[1] > 2048)) {
	            $erreur = $fileup_name." trop grande : Max 2048 x 2048 pixels !";
	        }
	    }

        // Déplacement du dossier tmeporaire au dossier TEMP souhaité 
        if (!isset($erreur)) {
	        $fileup_temporaire=DOCROOT.'serveur/TEMP/'.$fileup_nom; //Chemin de l'image dans une variable.
	        if (!move_uploaded_file($fileup_tmp_name, $fileup_temporaire)) { //Déplacement du fichier avec le son nom d'origine
	            $erreur = $fileup_name." n'a pas été copié correctement !";
	        }
	    }

        if (!isset($erreur)) {
			if ($fileup_extension=='jpg') { $fileup_extensionx='jpeg'; } else { $fileup_extensionx=$fileup_extension; }
			try {
			    @call_user_func('imagecreatefrom'.$fileup_extensionx,$fileup_temporaire);
			} catch (Exception $e) {
			    $erreur = $fileup_name." : Exception : ".$e->getMessage();
			}
		}

        if (!isset($erreur)) {
	        	$max = Model_Photo::find('last', array('order_by' => array('position' => 'desc')));
				$max_position= $max->position+1;
				$e = Model_Photo::forge(array(
					'album_id' => $element_id,
					'position' => $max_position,
					'url' => $fileup_nom,
				));
				if ($e and $e->save())
				{
				    if ($fileup_taille[0]>900) { // Redimentionnement si necessaire
				        Image::load($fileup_temporaire)->resize(900);
				    }
				    $fileup_destination_finale=DOCROOT.'serveur/photos/'.$e->id.'_'.$fileup_nom; //Chemin de l'image dans une variable.
				    copy($fileup_temporaire, $fileup_destination_finale); // Déplacement du fichier 
				    unlink($fileup_temporaire);  // on supprime l'image 00 
					$d['resultat'] = "ok";
					$d['message'] = "Photo [#$e->id] $e->url ajoutée.";
				}
				else
				{
					$d['message'] = "Impossible d'ajouter la photo, contactez le webmaster.";
				}
        } else {
            $d['message'] = $erreur;        	
        }

        return json_encode($d);
        die;
	}

	// Refresh de la liste des photos suite à l'ajout réussi d'une photo // retour html
	public function action_ajax_liste_ajout()
	{
		// On récupère la dernière photo ajoutée.
		$data['e'] = Model_Photo::find('last', array('order_by' => array('position' => 'desc')));
		$d = View::forge('admin\photos/_liste_ajout', $data);
		return $d; // html
	}

	// Maj position des photos. Ajax. Retour Json.
	public function action_ajax_maj_positions()
	{
		$d=array();
		if (Input::method() == 'POST')
		{
			$sortlist = $_POST['photo'];
		    for ($i = 0 ; $i < count ( $sortlist ) ; $i++) {
		       $position=$i+1;
		       $element_id=$sortlist[$i];
		       $up=DB::update('photos')
		       ->value("position", $position)
		       ->where('id', '=', $element_id)
		       ->execute();
		    }
		    $d["message"] =  "L'ordre des photos de l'album a été mis à jour."; // Un petit message pour dire que tout c'est bien passé
		} else {
			// Ne rien faire nothing // $d['message']="Rien à mettre à jour";
		}
		return json_encode($d);
	}

	// Modal Supprimer via ajax
	public function action_ajax_modal_supprimer($id=null)
	{
		// On récupère la photo concernée.
		$data['e'] = Model_Photo::find($id);
		$d = View::forge('admin\photos/ajax_modal_supprimer', $data);
		//$d = View::forge('admin\photos/ajax_modal_supprimer_test');
		return $d; // html
	}

	// Supprimer via ajax
	public function action_ajax_supprimer()
	{
		$d=array();
		if (Input::method() == 'POST')
		{
		    $id = $_POST['id'];
		    if ($e = Model_Photo::find($id))
		    {
		    	unlink('serveur/photos/'.$e->id.'_'.$e->url);
		    	$d["resultat"] =  "ok";
		    	$d["message"] =  "La photo [#$e->id] $e->url a été supprimée.";
		    	$e->delete();
			}
			else
			{
		    	$d["resultat"] =  "non";
		        $d["message"] = "Impossible de supprimer la photo, contactez le webmaster.";
			}
		} else {
			// Ne rien faire nothing // $d['message']="Rien à mettre à jour";
		}
		return json_encode($d);
	}

}