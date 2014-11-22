<?php
class Controller_Upload extends Controller_Base {
    
    // Post Ajax Upload, retour json
	public function action_post_ajax_upload() {

		$d=array();
        $d['resultat'] = 0; 
		// get session
		$upload_id = Session::get('upload_id');

		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $erreur = "Seule la methode POST est autorisée ici.";
		}

		// Préparation
        if (!isset($erreur)) {
	        $fileup=$_FILES['Filedata'];
	        $fileup_name=$_FILES['Filedata']['name'];
	        $fileup_poids=$_FILES['Filedata']['size'];
	        $fileup_erreur=$_FILES['Filedata']['error'];
	        $fileup_type=$_FILES['Filedata']['type'];
	        $fileup_tmp_name=$_FILES['Filedata']['tmp_name'];
	        $fichier_erreurs = array(
	        0=>"Upload réussi..",
	        1=>"Le fichier dépasse le 'upload_max_filesize' de php.ini.",
	        2=>"Le fichier dépasse le 'MAX_FILE_SIZE' spécifiée dans le formulaire HTML.",
	        3=>"Le fichier n'a été que partiellement téléchargé.",
	        4=>"Aucun fichier n'a été uploadé.",
	        6=>"Pas de dossier temporaire, contactez le webmaster.",
	        7=>"Échec de l'écriture du fichier sur le disque."
	        );
	        if($fileup_erreur!=0) { // Erreur
	            $erreur = $fichier_erreurs[$fileup_erreur];
	        }
    	}

        // Extension 
        if (!isset($erreur)) {
        	$fileup_nom_lower = strtolower($fileup_name);
        	$fileup_extension = substr(strrchr($fileup_nom_lower, '.'),1); 
        	$fileup_base = basename($fileup_nom_lower,'.'.$fileup_extension); 
        	$fileup_nom_temp=Inflector::friendly_title($fileup_base, '_', true); 
        	$fileup_nom=$fileup_nom_temp.'.'.$fileup_extension;	     
	        $image_extensions_autorisees = array ('bmp', 'gif', 'iff', 'jp2', 'jpg', 'jpeg', 'png', 'psd', 'tiff', 'wbmp');
	        if (!in_array($fileup_extension, $image_extensions_autorisees)) {
	            $erreur = $fileup_name." : Extension de fichier non supportée !";
	        }
	    }

        // Poid maximum
        if (!isset($erreur)) {
	        if(($fileup_poids==0) OR ($fileup_poids > 1000000)) {
	            if($fileup_poids==0) {
	                 $erreur = 'Fichier de 0 ko !';
	            } elseif ($fileup_poids>1000000) {
	                $erreur = $fileup_name." : trop lourd : Max 1mo !"; 
	            }
	        }
	    }

        // Taille // Seulement pour les images
        if (!isset($erreur)) {
		        $fileup_taille = getimagesize($fileup_tmp_name);
		        if (($fileup_taille[0] > 1024) OR ($fileup_taille[1] > 1024)) {
		            $erreur = $fileup_name." trop grande : Max 1024 x 1024 pixels !";
		        }
	    }

        // Déplacement du dossier tmeporaire au dossier TEMP souhaité 
        if (!isset($erreur)) {
	        $fileup_temporaire=DOCROOT.'serveur/TEMP/'.$fileup_nom; //Chemin de l'image dans une variable.
	        if (!move_uploaded_file($fileup_tmp_name, $fileup_temporaire)) { //Déplacement du fichier avec le son nom d'origine
	            $erreur = $fileup_name." n'a pas été copié correctement !";
	        }
	    }

	    // imagecreatefrom // Seulement pour les images
        if (!isset($erreur)) {
				if ($fileup_extension=='jpg') { $fileup_extensionx='jpeg'; } else { $fileup_extensionx=$fileup_extension; }
				try {
				    @call_user_func('imagecreatefrom'.$fileup_extensionx,$fileup_temporaire);
				} catch (Exception $e) {
				    $erreur = $fileup_name." : Exception : ".$e->getMessage();
				}
		}

		// Enregistrement en base de donnée
        if (!isset($erreur)) {
				$e = Model_Photo::forge(array(
						'album_id' => $upload_id,
						'slug' => $fileup_nom,
					));
				if ($e and $e->save()) {
					if ($fileup_taille[0]>900) {
					    Image::load($fileup_temporaire)->resize(900);
					}
					$fileup_destination_finale=DOCROOT.'serveur/photos/'.$e->id.'-'.$fileup_nom; 
				    copy($fileup_temporaire, $fileup_destination_finale); 
				    unlink($fileup_temporaire); 
					$d['resultat'] = 1;
					$d['message'] = "Photo ajoutée.";				
				} else {
					$d['message'] = "Impossible d'ajouter le fichier, contactez le webmaster.";
				}
        } else { // Sinon erreur
            $d['message'] = $erreur;        	
        }

        // Retour json
        return json_encode($d);
        die;
	}
	
	// Get Ajax Refresh de la liste des photos, retour html
	public function action_get_ajax_refresh_liste_des_photos()	{
		$id = Session::get('upload_id');
		$data['photos'] = Model_Photo::find('all', array(
	        'where' => array(array('album_id', '=', $id)),
	        'order_by' => array('created_at' => 'desc')
	    ));
		$d = View::forge('albums/_modifier_photos', $data);
		return $d; // html
	}

	// Post Supprimer photo
	public function action_supprimer_photo($id)	{
		if ($photo = Model_Photo::find($id)) {
            $photo->delete();
            Session::set_flash('success', e("La photo a été supprimé."));
        } else {
            Session::set_flash('error', e("Impossible de supprimer la photo, contactez le webmaster."));
        }
        Response::redirect_back();
		
	}


}