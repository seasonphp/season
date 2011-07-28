//CRIADO POR PV 
$(document).ready(function() { 
	  $(".span-6 input").keyup(function(){ 
	  
		
		$(this).val($(this).val().toUpperCase()); 
		
		
	  }); 
	  
	  
	 $(".span-8 input").keyup(function(){ 
	  
		
		$(this).val($(this).val().toUpperCase()); 
		
		
	  }); 
	  
	  
	  $("#NomeConjuge").keyup(function(){ 
		$(this).val($(this).val().toUpperCase()); 
	  }); 	  
	  
	  $("#NomeLogradouro").keyup(function(){ 
		$(this).val($(this).val().toUpperCase()); 
	  }); 	  
	  
	  $("#Bairro").keyup(function(){ 
		$(this).val($(this).val().toUpperCase());
		
	  }); 	  
	  
	  $("#PontoReferencia").keyup(function(){ 
		$(this).val($(this).val().toUpperCase());
		
	  }); 
}); 