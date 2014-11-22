$(function(){

	$("#fileupload_loader").hide();
	var dropbox = $('#fileupload'),
		message = $('.message', dropbox);
		
	// Detector demo
	if (!$.fileUploadSupported) {
		showMessage("Votre navigateur ne supporte pas l'upload de fichier via HTML5 !");
	} 

	// Enable plug-in
	$('.file-upload, #fileupload').fileUpload({
			url: 'upload/post_ajax_upload',
			type: 'POST',
			dataType: 'json',
			beforeSend: function () {
				montrer_div("#fileupload_loader");
				showMessage('Envoi en cours, veuillez patienter...');
			},
			complete: function () {				
				cacher_div("#fileupload_loader");
			},
			success: function (response, status, xhr) {
				if (!response) {
					showMessage("Erreur serveur.");
					montrer_notification('error', "Erreur serveur, contactez le webmaster");
					return;
				}
				if (response.message !== 0) {
					if (response.resultat == 1) {
						montrer_notification('success', response.message);
						refresh_liste_des_photos();
		    		} else {
						montrer_notification('error', response.message);
		    		}
					showMessage(response.message);
		    		return;
				}
			}

	});

	function showMessage(msg){
		message.html(msg);
	}

});

		
	function montrer_div(div){
	    $(div).fadeTo(500,0.6);
	}
	  
	function cacher_div(div){
	    $(div).fadeOut(500);
	}

	// Fonction d'ajout d'une photo a la liste via Ajax 
	function refresh_liste_des_photos() {
	    $.get('upload/get_ajax_refresh_liste_des_photos',function(response){ 
	        $('#photos').empty().append(response);
	      });
	}

	// Fonction de suppression d'une photo de la liste via Ajax 
	function supprimer_photo(id) {
	    $.post('upload/post_ajax_supprimer',{id:id},function(response){ 
	        $('#photo_'+id).animate({opacity: 0.30}, "slow");
	        if (response.resultat==1) {
				montrer_notification('success', response.message);
	        	$('#photo_'+id).slideUp("slow",function(){$('#photo_'+id).remove();});
	        } else { 
	        	montrer_notification('error', response.message);
	        	$('#photo_'+id).animate({opacity: 1}, "slow");
	        }
	      },"json");
	}
