
$(document).ready(function(){
});
  

// mise à jour du statut d'un todo
function mise_a_jour_partage(id,div) {
    $.post('albums/ajax_mise_a_jour_partage',{id:id},function(response){ 
        if ($('#partage_'+id).prop('checked')) {
            $('#partage_'+id).prop('checked', false);              
        } else {
            $('#partage_'+id).prop('checked', true);          
        }
        if (response.resultat==1) { 
            $('#partage_'+id).prop('checked', true); 
            montrer_notification('success', response.message);
        } else { 
            $('#partage_'+id).prop('checked', false); 
            montrer_notification('error', response.message);
        }
    },"json");
}

// notification
function montrer_notification(typo,texte){
  if (typo=='error') {
    $.growl.error({ message: texte});  
  }
  if (typo=='success') {
    $.growl.notice({ message: texte});
  }
}    
