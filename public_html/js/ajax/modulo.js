//BOTÕES DA VIEW EXIBEALT
//CRIADO POR PV EM 06/06/2011
//paulo.gomes@season.com.br

$(document).ready(function(){	

	//vai ajax é o id do botão 
$('#vaiajax').click(function(){
	
	if($('#conteudoModulo #inicioVigencia').val() == "" || $('#conteudoModulo #pmodulo').val()  == "" ){
		
		$('#erroModulo2').show('slow');
		
		 setTimeout(function(){
				$('#erroModulo2').hide('slow');	  
			},4000);

	}else
	{	
		var dia = $("#conteudoModulo #inicioVigencia").val().substring(0,2);
		var mes = $("#conteudoModulo #inicioVigencia").val().substring(3,5);
		var ano = $("#conteudoModulo #inicioVigencia").val().substring(6);
		
		hoje = new Date()
		diaHoje = hoje.getDate()
		mesHoje = hoje.getMonth()
		anoHoje = hoje.getFullYear()
	
		if (dia < 10)
			diaHoje = diaHoje
		if (ano < 2000)
			anoHoje = anoHoje

		//O MES COMEÇA EM ZERO 
		mesHoje = mesHoje + 1

		if (mes < 10)
		mesHoje = ("0" + mesHoje);
		
		if(dia == 00){
			//alert('TA PENSANDO Q É MALANDRO?'); 
			$("#msgErro").show();
			$("#InicioVigencia").val("");
			
			
			}else{
		
					if(ano >= anoHoje){
						if(mes == mesHoje){
							if(dia >= diaHoje){
								$('#erroModulo').hide('slow');	
							}else{
								$('#erroModulo').show('slow');
			
								 setTimeout(function(){
										$('#erroModulo').hide('slow');	  
									},4000);
									return;								
							}
						}else if (mes < mesHoje && ano == anoHoje){
							$('#erroModulo').show('slow');		
							 setTimeout(function(){
									$('#erroModulo').hide('slow');	  
								},4000);
							 return;
						
						}else{
								$('#erroModulo').hide('slow');	
						
						}				
					}else{
						$('#erroModulo').show('slow');
						 setTimeout(function(){
								$('#erroModulo').hide('slow');	  
							},4000);
							return;							
						 }

				  }	
		
		
		//MOSTRA CARREGANDO 
		$('#carregaModulo').show('fast');
		
		var nome = $('#alteraModulo').find('select option:selected').val();
		var texto = $('#alteraModulo').find('select option:selected').text();
		var dataVig = $('#inicioVigencia').val();
		var dados = $('#alteraModulo').serialize();
		
		$.ajax({
		type:"POST",
		data: dados,
		url: $('#alteraModulo').attr('action'),
		
		success: function(data){
				//alert(data);
				if(data != null){
								
					$('#conteudoModulo').hide('slow');
					$('#carregaModulo').hide('fast');
					
					//SUMINDO COM A TABLE
					$('#altmodulo').find('table').hide('slow');
					
					$('#altmodulo').find('table tr td:last').append(data);
					
					// ADICIONANDO NOVA LINHA E EXIBINDO
					$('#altmodulo').find('table').append('<tr><td>'+ texto +'</td><td>'+ dataVig +'</td><td></td></tr>');
					$('#altmodulo').find('table').show('slow');
                                        
                                        $('#alteraModulo input').each(function(){ 
                                            $(this).val(''); 
                                        });         
				
				}else{
					alert(data);
				}
		
			}
		
		});
		
	}
	
});








});
/*ADICIONE SEU SCRIPT AQUI*/
/*ADICIONE SEU SCRIPT AQUI*/
