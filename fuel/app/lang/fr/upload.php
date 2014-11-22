<?php

return array(
	'error_'.\Upload::UPLOAD_ERR_OK						=> "Fichier uploadé avec succés",
	'error_'.\Upload::UPLOAD_ERR_INI_SIZE				=> "Le fichier dépasse la directive 'upload_max_filesize' de php.ini.",
	'error_'.\Upload::UPLOAD_ERR_FORM_SIZE				=> "Le fichier dépasse la directive  'MAX_FILE_SIZE' spécifiée dans le formulaire HTML.",
	'error_'.\Upload::UPLOAD_ERR_PARTIAL				=> "Le fichier n'a été que partiellement téléchargé.",
	'error_'.\Upload::UPLOAD_ERR_NO_FILE				=> "Aucun fichier n'a été uploadé.",
	'error_'.\Upload::UPLOAD_ERR_NO_TMP_DIR				=> "Le dossier temporaire configuré est manquant, contactez le webmaster.",
	'error_'.\Upload::UPLOAD_ERR_CANT_WRITE				=> "Échec de l'écriture du fichier sur le disque.",
	'error_'.\Upload::UPLOAD_ERR_EXTENSION				=> "Upload bloqué par un extension de PHP intallée",
	'error_'.\Upload::UPLOAD_ERR_MAX_SIZE				=> "Le fichier dépasse la taille maximum définie",
	'error_'.\Upload::UPLOAD_ERR_EXT_BLACKLISTED		=> "L'upload de fichiers avec cette extension n'est pas autorisé",
	'error_'.\Upload::UPLOAD_ERR_EXT_NOT_WHITELISTED	=> "L'upload de fichiers avec cette extension n'est pas autorisé",
	'error_'.\Upload::UPLOAD_ERR_TYPE_BLACKLISTED		=> "L'upload de fichiers de ce type n'est pas autorisé",
	'error_'.\Upload::UPLOAD_ERR_TYPE_NOT_WHITELISTED	=> "L'upload de fichiers de ce type n'est pas autorisé",
	'error_'.\Upload::UPLOAD_ERR_MIME_BLACKLISTED		=> "L'upload de fichiers de ce mime type n'est pas autorisé",
	'error_'.\Upload::UPLOAD_ERR_MIME_NOT_WHITELISTED	=> "L'upload de fichiers de ce mime type n'est pas autorisé",
	'error_'.\Upload::UPLOAD_ERR_MAX_FILENAME_LENGTH	=> "Le nom du fichier uploadé dépasse la longueur maximum définie",
	'error_'.\Upload::UPLOAD_ERR_MOVE_FAILED			=> "Impossible de déplacer le fichier à se destination finale",
	'error_'.\Upload::UPLOAD_ERR_DUPLICATE_FILE 		=> "Un fichier avec le même nom éxiste déjà",
	'error_'.\Upload::UPLOAD_ERR_MKDIR_FAILED			=> "Impossible de créer le répertoire de destination du fichier",
);
