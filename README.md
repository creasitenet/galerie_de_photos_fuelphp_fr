## galerie de photo fuelphp

Il s'agit d'un système basique de galerie photo.
Réalisé sous Fuelphp.

Il permet :
-l'ajout, la modification et la suppression d'albums photos (un titre, un slug automatique).
- l'ajout (via ajax en glisser déposer) et la suppression des photos de chaque album.

Peu de styles. Peu de javascripts. Juste le nécéssaire.

L'upload est géré via ajax.
Les suppressions sont réalisées via de simple get sans confirmation (au lieu de post certainement  plus adapté).

Installation
-------------
Manuelle
Cloner, 
Installer la base de donnée sql fournie, 
Modifier l fichier de config fuel/app/config/*/db.php avec vos données

Notes
-----

- Oil n'a pas été utilisé.
- Système non destiné à la production en l'état ou dérrière un espace memmbre sécurisé.

Tout retour est le bienvenue
