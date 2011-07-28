//BOTÕES DA VIEW EXIBEALT
//CRIADO POR PV EM 06/06/2011
//paulo.gomes@season.com.br

$(document).ready(function(){	

$('#altLcat').click(function(){

	
		if($('#conteudoLcat #inicioVigenciaLcat').val() == "" || $('#conteudoLcat #plocal').val()  == "" ){
		
		$('#erroLcat2').show('slow');
		
		 setTimeout(function(){
				$('#erroLcat2').hide('slow');	  
			},4000);

		}else
		{	
		
		var dia = $("#conteudoLcat #inicioVigenciaLcat").val().substring(0,2);
		var mes = $("#conteudoLcat #inicioVigenciaLcat").val().substring(3,5);
		var ano = $("#conteudoLcat #inicioVigenciaLcat").val().substring(6);
		
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
			$("#erroLcat").show();
			$("#inicioVigenciaLcat").val("");
			
			
			}else{
		
					if(ano >= anoHoje){
						if(mes == mesHoje){
							if(dia >= diaHoje){
								$('#erroLcat').hide('slow');	
							}else{
								$('#erroLcat').show('slow');
			
								 setTimeout(function(){
										$('#erroLcat').hide('slow');	  
									},4000);
									return;								
							}
						}else if (mes < mesHoje && ano == anoHoje){
							$('#erroLcat').show('slow');		
							 setTimeout(function(){
									$('#erroLcat').hide('slow');	  
								},4000);
							 return;
						
						}else{
								$('#erroLcat').hide('slow');	
						
						}				
					}else{
						$('#erroLcat').show('slow');
						 setTimeout(function(){
								$('#erroLcat').hide('slow');	  
							},4000);
							return;							
						 }

				  }	
	
			//CARREGA LCAT 
			$('#carregaLcat').show();
			
			var nome = $('#alteraLcat').find('select option:selected').val();
			var texto = $('#alteraLcat').find('select option:selected').text();
			var dataVig = $('#inicioVigenciaLcat').val();
			var dados = $('#alteraLcat').serialize();
			
			$.ajax({
			type:"POST",
			data: dados,
			url: $('#alteraLcat').attr('action'),
			
			success: function(data){
			
					if(data != null){
					
					$('#conteudoLcat').hide('slow');
					$('#carregaLcat').hide();
					$('#altlocal').find('table').hide('slow');
					
					//ADICIONA A DATA VINDA DO CONTROLLER DATA FIM 
                                            if($('#altlocal table tr td:last').hasClass('limpo')){
                                                    
                                            }else{

                                                $('#altlocal').find('table tr td:last').append(data);
                                             }
                                        
					// ADICIONANDO NOVA LINHA E EXIBINDO
					$('#altlocal').find('table').append('<tr><td>'+ texto +'</td><td>'+ dataVig +'</td></tr>');
					$('#altlocal').find('table').show('slow');
                                        
                                        $('#alteraLcat input').each(function(){ 
                                            $(this).val(''); 
                                        });
					
					}else{
					$('#conteudoLcat').hide('slow');
					$('#carregaLcat').hide();
					alert("Ocorreu uma falha no sistema. =>" + data + " tente novamente mais tarde.");
					
					}
			
				}
			
			});
		
		}
});

});
/*ADICIONE SEU SCRIPT AQUI*/
/*ADICIONE SEU SCRIPT AQUI*/
