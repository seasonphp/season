$(document).ready(function(){
	$( "#tabs" ).tabs().find( ".ui-tabs-nav" ).sortable({ axis: "x" });
	$('#Cnp').blur(function(){
	
	
		if($('#Cnp').hasClass('cpf error')){
				$('#okimg').hide('fast');
				$('#erroimg').hide('fast');	
		}else{
			
			
			
			var cpf = $('#Cnp').val();	
				//cpf = cpf.replace('.','');		
				//cpf = cpf.replace('-','');
				//cpf = cpf.replace('_','');
				
				

			if(cpf == "" || cpf == null || cpf =="___.___.___-__"){
				$('#okimg').hide('fast');
				$('#erroimg').hide('fast');
				//alert('CPF VAZIO');
			
			}else{
				cpf = cpf.replace('.','');		
				cpf = cpf.replace('.','');		
				cpf = cpf.replace('-','');
			
				$('#okimg').hide('fast');
				$('#erroimg').hide('fast');
				$('#carregardp').show('fast');
				
				$('#bloqueia').val("");
				$('#bloqueia').next("label").show('fast');
				
				var cpf = $('#Cnp').val();
				var dados = $('#Cnp').serialize();
				
				$.ajax({
				type:"POST",
				data: dados,
				url: '/ajax/testacpf',
				
				success: function(data){
				
						if(data == true){
						
							$('#carregardp').hide('fast');
							$('#erroimg').hide('fast');
							$('#okimg').show('fast');
							$('#bloqueia').val("1");
							$('#bloqueia').next("label").hide('fast');
						
						
						}else{
				
							$('#carregardp').hide('fast');
							$('#okimg').hide('fast');
							$('#erroimg').show('fast');
							$('#bloqueia').next("label").show('fast');
						
						
						}
				
					}
				
				});
			
			}
		}
	});
	$("#Cnp").mask("999.999.999-99");
	$(".telefone").mask("9999-9999");
	$(".dateBR").mask("99/99/9999");
	$(".numero").mask("999999999");
	$(".ddd").mask("99");
	$(".cep").mask("99999-999");
	//$(".pis").mask("999.99999.99-9");
	
	
	// CONFIGURA A VALIDACAO DO FORMULARIO
   $("#novobeneficiario").validate({
      rules: {
         Nome: {required: true},
		 NomeMae: {required: true},
                 NomePai: {required: true},
		 Sexo: {required: true},
		 EstadoCivil: {required: true},
         data: {required: true, dateBR: true},
		 email: {required: true},
		 PIS: {required: true},
		 RG: { required: true, minlength: 8, maxlength: 17},
		 Logradouro: {required: true},
		 Endtipo: {required: true},
		 Modulo: {required: true},
		 bloqueia: {required: true},
		 NumLogradouro: {required: true},
		 Cidade: {required: true},
		 Bairro: {required: true},
		 RDP: {required: true},
		 CEP: {required: true},
		 RG:{minlength:6,maxlength:13}
      },
      messages: {
         Nome: {required: '<br>Informe o nome' },
         NomeMae: {required: '<br>Informe o nome da mãe' },
         NomePai: {required: '<br>Informe o nome do pai' },
         Sexo: {required: 'Informe o sexo' },
         EstadoCivil: {required: 'Informe o estado civil' },
         email: {required: 'Informe o e-mail' },
         PIS: {required: '<br>Informe o PIS'},
         RG: {required: '<br>Informe o RG', minlength: '<br> RG invalido', maxlength: '<br> RG invalido' },
         Modulo: {required: '<br>Informe o plano'},
         bloqueia: {required: '<br>verifique CPF'},
         Endtipo: {required: 'Informe'},
         NumLogradouro: {required: '<br> Informe'},
         Cidade: {required: '<br>Informe a cidade'},
         Bairro: {required: 'Informe o bairro'},
         CEP: {required: 'Informe o CEP'},
         RDP: {required: 'Informe o RDP'},
         Logradouro: {required: 'Informe o endereço'},
         data: {required: 'Informe a data', dateBR: 'Digite uma data válida'},
         RG: {minlength:'deve ser maior que 6 caracteres',maxlength:'deve ser menor que 13 caracteres'}
		 
      }
      ,
	  //submitHandler:function(form) {
     //    alert('ok');
     // }
   });
   
   
   
   $( ".submit" ).button({
		icons: {
			primary: "ui-icon-plus"
		}
	});
	
	$( ".naturalidade" ).button({
		icons: {
			primary: "ui-icon-search"
		}
	});
	$( ".cidade" ).button({
		icons: {
			primary: "ui-icon-search"
		}
	});
	
	$( ".pesquisa" ).button({
		icons: {
			primary: "ui-icon-search"
		}
	});
	
	$( ".baixar" ).button({
		icons: {
			primary: "ui-icon-script"
		}
	});
	
	
	
	
	$.fx.speeds._default = 1000;	
	$( "#pesquisa" ).dialog({
		autoOpen: false,
		show: "blind",
		height: 450,
		width: 500,
		hide: "explode"
	});
	$( "#pesquisa_naturalidade" ).dialog({
		autoOpen: false,
		show: "blind",
		height: 450,
		width: 500,
		hide: "explode"
	});		
	$( "#altmodulo" ).dialog({
		autoOpen: false,
		show: "blind",
		height: 550,
		width: 800,
		hide: "explode"
	});

	$( ".cidade" ).click(function() {
		//alert('Cidade');
		$( "#pesquisa" ).dialog( "open" );
		return false;
	});

	$( ".naturalidade" ).click(function() {
		$( "#pesquisa_naturalidade" ).dialog( "open" );
		return false;
	});
	
	
	/*
	$("#InicioVigencia").blur(function(){
		if(verificarData(this,3)){
			$("#msgErro").hide();
		}else{
			$("#msgErro").show();
			$("#InicioVigencia").val("");
		}		
	});
	*/	
	
	$("#InicioVigencia").blur(function(){
		if(verificarData(this,4)){
			$("#msgErro").hide();
		}else{
			$("#msgErro").show();
			$("#InicioVigencia").val("");
		}		
	});
	
	
	
	
	
	$("#DataNascimento").blur(function(){
		if(verificarData(this,2)){
			$('#erroNasc').hide();
		}else{
			$('#erroNasc').show();
			$("#data").val("");
		}
		if(verificarDtNascimento(this) == true){
			$(".DecNascidoVivo").removeClass("hide");
                        $("#DecNascidoVivo").addClass("declaracao");
		}else{
			$(".DecNascidoVivo").addClass("hide");
                        $("#DecNascidoVivo").removeClass("declaracao");
		}			
	});
	
	
	$("#dataExped").blur(function(){
		if(verificarData(this,2)){
			$('#erroExped').hide();
		}else{
			$('#erroExped').show();
			$("#dataExped").val("");
		}
		
	});
	
	
	
	
	$("#DataAdmissao").blur(function(){
		if(verificarData(this,2)){
			$('#erroAdmissao').hide();
		}else{
			$('#erroAdmissao').show();
			$("#DataAdmissao").val("");
		}				
	});

});


function selLocalidade(cod,texto){
	   $( "#Naturalidade").val(texto);
	   $( "#idNaturalidade").val(cod);
	   $( "#pesquisa_naturalidade" ).dialog( "close" );
}
function selCidade(cod,texto){
   $( "#Cidade").val(texto);
   $( "#idCidade").val(cod);
   $( "#pesquisa" ).dialog( "close" );
   $('#Cidade').next("label").hide('fast');
   $('#Cidade').removeClass("error");
   
}	