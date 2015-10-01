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
			url: 'upload/postAjaxUpload', //url: urlmaj,
			type: 'POST',
			dataType: 'json',
			beforeSend: function () {
				show_div("#fileupload_loader");
				showMessage('Envoi en cours, veuillez patienter...');
				//$('#fileupload').addClass('uploading');
			},
			complete: function () {				
				//console.log('complete1');
				hide_div("#fileupload_loader");
				//$('#fileupload').removeClass('uploading');
				//showMessage('Envoi terminé');
			},
			success: function (response, status, xhr) {
				//console.log('succes1');
				if (!response) {
					showMessage("Erreur serveur.");
					show_notification('error', "Erreur serveur, contactez le webmaster");
					return;
				}
				if (response.message !== 0) {
					if (response.result == 1) {
						//$.data(file).addClass('done');
						show_notification('success', response.message);
						refresh_pictures_list("upload/getAjaxRefresh","#pictures");
		    		} else {
						show_notification('error', response.message);
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

	// Fonction d'ajout d'un element a une liste via Ajax 
	function refresh_pictures_list(url, div) {
	    $.get(url,function(response){ 
	        //console.log(response);
	        $(div).empty().append(response);
	      });
	}
	
	/*
	// Fonction de suppression d'un element d'une liste via Ajax 
	function delete_picture(id) {
	    $.post('upload/postAjaxDelete',{id:id},function(response){ 
	        $('#picture_'+id).animate({opacity: 0.30}, "slow");
	        if (response.result==1) {
				show_notification('success', response.message);
	        	$('#picture_'+id).slideUp("slow",function(){$('#picture_'+id).remove();});
	        } else { 
	        	show_notification('error', response.message);
	        	$('#picture_'+id).animate({opacity: 1}, "slow");
	        }
	      },"json");
	}
	*/