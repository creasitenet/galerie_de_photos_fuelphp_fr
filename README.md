## galerie de photo fuelphp 1.7.3

Il s'agit d'un système basique de galerie photo.
Réalisé sous Fuelphp.

Version largement simplifié :
- la gestion des "albums" a été supprimée.
- le système d'ajout des photos se fait par glisser/déposer. 

Peu de styles. Peu de javascripts. Juste le nécéssaire.
L'upload géré via ajax. Suppression réalisées via un simple get sans confirmation (au lieu de post certainement  plus adapté).

## Installation

Manuelle
Cloner, 
Installer la base de donnée sql fournie, 
Modifier l fichier de config fuel/app/config/*/db.php avec vos données

## Notes

- Oil n'a pas été utilisé.
- Système non destiné à la production en l'état ou dérrière un espace memmbre sécurisé.
Tout retour est le bienvenue
