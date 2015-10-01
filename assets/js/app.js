
$(document).ready(function(){
   
});

	// Fonctions Ajax
  
 	// ADD
  	function ajax_add(url, data, div) {
   		$.post(url,{value:data},function(response) {
   			//console.log(response);
   			if (response.result==1) { 
   				show_notification('success', response.message);
   				ajax_refresh(response.url,response.data,response.div);
          		$(div).val("");
        	} else { 
          		show_notification('error', response.message);
        	}
      	},"json");
    }

	// REFRESH
	function ajax_refresh(url, data, div) {
		$.post(url,{value:data}, function(response) { 
	        //console.log(response);
	        $(div).append(response);
	        $(response.div).show('slow');
	    });
	}
	
	// MAJ
    function ajax_maj(url, data, div) {
    	$.post(url,{value:data},function(response){ 
	        //console.log(response);
     		if (response.result==1) { 
     			$(div).prop('checked', true); 
        		show_notification('success', response.message);
      		} else {
        		$(div).prop('checked', false); 
        		show_notification('error', response.message);
      		}
    	},"json");
  	}
  
  	// DELETE 
	function ajax_delete(url, data, div) {
	    $.post(url,{value:data},function(response){ 
	        //console.log(response);
	        $(div).animate({opacity: 0.30}, "slow");
	        if (response.result==1) { // L'élément a été supprimé
	        	show_notification('success', response.message);
	          	$(div).slideUp("slow",function(){$(div).remove();});
	        } else { // L'élément n'a pas été supprimé
	          	show_notification('error', response.message);
	          	$(div).animate({opacity: 1}, "slow");
	        }
	        $('#modal_delete_'+data).modal('toggle');
	    },"json");
	}
	
  	function show_div(div){
    	$(div).fadeTo(500,0.6);
  	}
  
  	function hide_div(div){
    	$(div).fadeOut(500);
  	}
  	
  	// Alertes du bootstrap
	function show_alert(type,message){
    	$('#alerts').slideUp().empty().hide().append("<div class='alert alert-"+type+"'><button class='close' data-dismiss='alert'>×</button><p>" + message + "</p></div>").slideDown(500);
    	//$('.alert').slideDown(500);
    	$('.alert').find('.close').click(function(e){
      		e.preventDefault();
      		$('.alert').slideUp(); 
    	})
  	}
    
	// JGrowl notification
	function show_notification(type,message){
		if (type=='error') {
	    	$.growl.error({ message: message});  
	  	}
	  	if (type=='success') {
	  		$.growl.notice({ message: message});
	  	}
	}    

  