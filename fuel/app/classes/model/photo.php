<?php
class Model_Photo extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'album_id',
		'slug',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' =>  false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	// Belogns to Album
	protected static $_belongs_to = array(
	    'album' => array(
	        'key_from' => 'album_id',
	        'model_to' => 'Model_Album',
	        'key_to' => 'id',
	        'cascade_save' => false,
	        'cascade_delete' => false,
	    )
	);

	// Url de la photo
	public function url()	{
		if (file_exists('./serveur/photos/'.$this->id.'-'.$this->slug)) {
			$img_url='serveur/photos/'.$this->id.'-'.$this->slug;
			return $img_url;
		} else {
			$img_url='assets/img/visuel-a-venir.jpg';
			return $img_url;
		}
	}
	
}
