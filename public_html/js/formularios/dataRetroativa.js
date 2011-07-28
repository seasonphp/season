<!-- FUNÇÃO PARA IMPEDIR DATAS RETROATIVAS -->

$(document).ready(function(){
	$("#InicioVigencia").blur(function(){
		//alert('SAIMOS DA DATA');
		var dia = $("#InicioVigencia").val().substring(0,2);
		var mes = $("#InicioVigencia").val().substring(3,5);
		var ano = $("#InicioVigencia").val().substring(6);
		
		//PEGANDO E ARRUMANDO A DATA ATUAL 
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
			$("#InicioVigencia").focus();
			
			}else{
		
					if(ano >= anoHoje){
						if(mes == mesHoje){
							if(dia >= diaHoje){
								//alert('AQUI PODI 1');
								$("#msgErro").hide();
							}else{
								$("#msgErro").show();
								$("#InicioVigencia").val("");
							
							}
						}else if (mes < mesHoje && ano == anoHoje){
							$("#msgErro").show();
							$("#InicioVigencia").val("");
						
						}else{
							//alert('AQUI PODI 2');
							$("#msgErro").hide();
						}				
					}else{
						$("#msgErro").show();
						$("#InicioVigencia").val("");
					}

				  }			
	});
	});


	$("#data").blur(function(){
		//alert('SAIMOS DA DATA');
		var dia = $("#data").val().substring(0,2);
		var mes = $("#data").val().substring(3,5);
		var ano = $("#data").val().substring(6);
		
		//PEGANDO E ARRUMANDO A DATA ATUAL 
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
			$('#erroNasc').show();
			$("#data").val("");
			
			
			}else{
		
					if(ano <= anoHoje){
						if(mes == mesHoje){
							if(dia <= diaHoje){
								//alert('AQUI PODI 1');
								$('#erroNasc').hide();
								
							}else{
								$('#erroNasc').show();
								$("#data").val("");
							
							}
						}else if (mes > mesHoje && ano == anoHoje){
							$('#erroNasc').show();
							$("#data").val("");
						
						}else{
							//alert('AQUI PODI 2');
							$('#erroNasc').hide();
							
						}				
					}else{
						$('#erroNasc').show();
						$("#data").val("");
					}

				  }			
	});
	});



	$("#dataExped").blur(function(){
		//alert('SAIMOS DA DATA');
		var dia = $("#dataExped").val().substring(0,2);
		var mes = $("#dataExped").val().substring(3,5);
		var ano = $("#dataExped").val().substring(6);
		
		//PEGANDO E ARRUMANDO A DATA ATUAL 
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
			$('#erroExped').show();
			$("#dataExped").val("");
			
			}else{
		
					if(ano <= anoHoje){
						if(mes == mesHoje){
							if(dia <= diaHoje){
								$('#erroExped').hide();
								
							}else{
								$('#erroExped').show();
								$("#dataExped").val("");
								
							
							}
						}else if (mes > mesHoje && ano == anoHoje){
							$('#erroExped').show();
							$("#dataExped").val("");
							
						
						}else{
							$('#erroExped').hide();
							
						}				
					}else{
							$('#erroExped').show();
							$("#dataExped").val("");
							
					}

				  }			
	});
	});



	$("#DataAdmissao").blur(function(){
		//alert('SAIMOS DA DATA');
		var dia = $("#DataAdmissao").val().substring(0,2);
		var mes = $("#DataAdmissao").val().substring(3,5);
		var ano = $("#DataAdmissao").val().substring(6);
		
		//PEGANDO E ARRUMANDO A DATA ATUAL 
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
			$('#erroAdmissao').show();
			$("#DataAdmissao").val("");
			
			
			}else{
		
					if(ano <= anoHoje){
						if(mes == mesHoje){
							if(dia <= diaHoje){
								$('#erroAdmissao').hide();
								
							}else{
								$('#erroAdmissao').show();
								$("#DataAdmissao").val("");
							
							
							}
						}else if (mes > mesHoje && ano == anoHoje){
							$('#erroAdmissao').show();
							$("#DataAdmissao").val("");
						
						
						}else{
							$('#erroAdmissao').hide();
							
						}				
					}else{
							$('#erroAdmissao').show();
							$("#DataAdmissao").val("");
						
					}

				  }			
	});

