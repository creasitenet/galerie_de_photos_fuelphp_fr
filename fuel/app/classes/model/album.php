<?php
class Model_Album extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'titre',
		'slug',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_Slug' => array(
	        'events' => array('before_insert'),
	        'source' => 'titre',   
	        'property' => 'slug',  
	        'separator' => '-',  
    	),
	);

	public static function validate($factory) {
		$val = Validation::forge($factory);
		$val->add_field('titre', 'Titre', 'required|max_length[255]');
		return $val;
	}

	// has one
	protected static $_has_one = array(
	    'photo' => array(
	        'key_from' => 'id',
	        'model_to' => 'Model_Photo',
	        'key_to' => 'album_id',
	        'cascade_save' => false,
	        'cascade_delete' => true,
	    ),
	);

	// has many
	protected static $_has_many = array(
	    'photos' => array(
	        'key_from' => 'id',
	        'model_to' => 'Model_Photo',
	        'key_to' => 'album_id',
	        'cascade_save' => false,
	        'cascade_delete' => true,
	    )
	);

	// Url de la photo
	public function photo_url()	{
		if ($this->photo) {
			return $this->photo->url();
		} else {
			$img_url='assets/img/visuel-a-venir.jpg';
			return $img_url;
		}
	}
	
}
