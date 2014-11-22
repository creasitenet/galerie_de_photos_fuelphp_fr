<?php
return array(
	'_root_'  => 'albums/index',  // The default route
	'_404_'   => 'erreurs/404',    // The main 404 route
	
    // Albums
    'albums'  => 'albums/index', 
    'albums/(:num)' => 'albums/index/$1', // Pagination des albums
    'album/(:segment)/(:num)' => 'albums/album/$2', // Album / slug / id
    'album/(:segment)/(:num)/(:num)' => 'albums/album/$2/$3', // Pagination des photos
   
);