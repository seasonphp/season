//BOTÕES DA VIEW EXIBEALT
//CRIADO POR PV EM 06/06/2011
//paulo.gomes@season.com.br

$(document).ready(function(){	


$('#confirmaLotacao').click(function(){
	
	if($('#conteudoLotacao #inicioVigenciaLotacao').val() == "" || $('#conteudoLotacao #plotacao').val()  == "" ){
		
		$('#erroLotacao2').show('slow');
		
		 setTimeout(function(){
				$('#erroLotacao2').hide('slow');	  
			},4000);

		}else
	{
	
		var dia = $("#conteudoLotacao #inicioVigenciaLotacao").val().substring(0,2);
		var mes = $("#conteudoLotacao #inicioVigenciaLotacao").val().substring(3,5);
		var ano = $("#conteudoLotacao #inicioVigenciaLotacao").val().substring(6);
		
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
			$("#erroLotacao").show();
			$("#inicioVigenciaLotacao").val("");
			
			
			}else{
		
					if(ano >= anoHoje){
						if(mes == mesHoje){
							if(dia >= diaHoje){
								$('#erroLotacao').hide('slow');	
							}else{
								$('#erroLotacao').show('slow');
			
								 setTimeout(function(){
										$('#erroLotacao').hide('slow');	  
									},4000);
									return;								
							}
						}else if (mes < mesHoje && ano == anoHoje){
							$('#erroLotacao').show('slow');		
							 setTimeout(function(){
									$('#erroLotacao').hide('slow');	  
								},4000);
							 return;
						
						}else{
								$('#erroLotacao').hide('slow');	
						
						}				
					}else{
						$('#erroLotacao').show('slow');
						 setTimeout(function(){
								$('#erroLotacao').hide('slow');	  
							},4000);
							return;							
						 }

				  }	
	
	
		//CARREGANDO
		$('#carregaLotacao').show();
		
		var nome = $('#dadosLotacao').find('select option:selected').val();
		var texto = $('#dadosLotacao').find('select option:selected').text();
		var dataVig = $('#inicioVigenciaLotacao').val();
		var dados = $('#dadosLotacao').serialize();
		
		$.ajax({
		type:"POST",
		data: dados,
		url: $('#dadosLotacao').attr('action'),
		
		success: function(data){
		
				if(data != null){
				
				$('#conteudoLotacao').hide('fast');
				$('#carregaLotacao').hide();
				$('#altlotacao').find('table').hide('fast');
				
				//adiciona nova data 
				$('#altlotacao').find('table tr td:last').append(data);
				
				//ADICIONA NOVA LINHA E MOSTRA 
				$('#altlotacao').find('table').append('<tr><td>'+ texto +'</td><td>'+ dataVig +'</td></tr>');
				$('#altlotacao').find('table').show('fast');
                                
                                $('#dadosLotacao input').each(function(){ 
                                    $(this).val(''); 
                                });
				
				}else{
				$('#conteudoLotacao').hide('slow');
				$('#carregaLotacao').hide();
				alert("Você não pode adicionar nada!");
				
				}
		
			}
		
		});
	
	}
});




});
/*ADICIONE SEU SCRIPT AQUI*/
/*ADICIONE SEU SCRIPT AQUI*/
