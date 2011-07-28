$(document).ready(function(){
    

    
	$( "#tabs" ).tabs().find( ".ui-tabs-nav" ).sortable({ axis: "x" });
	//$("#Cnp").mask("999.999.999-99");
	//$(".pis").mask("999.99999.99-9");
	$("#DataNascimento").blur(function(){
		if(verificarData(this,2)){
			$('#erroNasc').hide();
			if(verificarData(this,1)){
                            $("#Cnp").mask("999.999.999-99");
                            $("#Cnp").addClass('cpf');
                            $("#PIS").addClass('pis');
                            $("#RG").addClass('rg');
                            $("#dataExped").addClass('dateBR');
                            $('#Cnp').next("label").show('fast');
                            $('#PIS').next("label").show('fast');
                            $('#RG').next("label").show('fast');
                            $('#dataExped').next("label").show('fast');

                            if($('#RDP').val() != 0){
                                //TIRA A CLASSE
                                $("#Cnp").removeClass();
                                $("#PIS").removeClass();
                                $("#RG").removeClass();
                                $("#dataExped").removeClass();
                             }
                
                                
			}else{
				$("#Cnp").unmask("999.999.999-99");
						
				//TIRA A CLASSE
				$("#Cnp").removeClass();
				$("#PIS").removeClass();
				$("#RG").removeClass();
				$("#dataExped").removeClass();
				
				//LIMPA MSG DE ERRO 
				$('#Cnp').next("label").hide('fast');
				$('#PIS').next("label").hide('fast');
				$('#RG').next("label").hide('fast');
				$('#dataExped').next("label").hide('fast');
			}
		}else{
			$('#erroNasc').show();
			$("#DataNascimento").val("");
		}		
		if(verificarDtNascimento(this) == true){
			$(".DecNascidoVivo").removeClass("hide");
                        $("#DecNascidoVivo").addClass("declaracao");
		}else{
			$(".DecNascidoVivo").addClass("hide");
                        $("#DecNascidoVivo").removeClass("declaracao");
		}			
	});	
	$(".telefone").mask("9999-9999");
	$(".dateBR").mask("99/99/9999");
	$("#dataCasamento").mask("99/99/9999");
	$(".numero").mask("999999999");
	$(".ddd").mask("99");
	$(".cep").mask("99999-999");
	
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
		 Logradouro: {required: true},
		 Endtipo: {required: true},
		 Modulo: {required: true},
		 NumLogradouro: {required: true},
		 Cidade: {required: true},
		 Bairro: {required: true},
		 RDP: {required: true},
		 bloqueia: {required: true},
		 CEP: {required: true},
		 RG:{minlength:6,maxlength:13}
      },
      messages: {
         Nome: {required: '<br>Informe o nome' },
         NomeMae: {required: '<br>Informe o nome da mãe' },
         NomePai: {required: '<br>Informe o nome do pai' },
		 Sexo: {required: '<br>Informe o sexo' },
		 EstadoCivil: {required: '<br>Informe o estado civil' },
         email: {required: '<br>Informe o e-mail' },
		 Modulo: {required: '<br>Informe o plano'},
		 Endtipo: {required: '<br>Informe*'},
		 NumLogradouro: {required: '<br>Informe o número'},
		 Cidade: {required: '<br>Informe a cidade'},
		 Bairro: {required: '<br>Informe o bairro'},
		 CEP: {required: '<br>Informe o CEP'},
		 RDP: {required: '<br>Informe o RDP'},
		 bloqueia: {required: '<br>RDP INVALIDO'},
		 Logradouro: {required: '<br>Informe o endereço'},
         data: {required: '<br>Informe a data', dateBR: '<br>Digite uma data válida'},
		 RG: {minlength:'deve ser maior que 6 caracteres',maxlength:'deve ser menor que 13 caracteres'}
		 
      },
	
   });
   
   $('.incorpora').click(function(){ 
		//PEGA OS DADOS DA #titularendereco				
		$('#Endtipo').val($('#hide_tipo').val());		
		$('#Logradouro').val($('#hide_logradouro').val());		
		$('#NumLogradouro').val($('#hide_numero').val());			
		$('#ComplLogradouro').val($('#hide_complemento').val());		
		$('#CaixaPostal').val($('#hide_caixapostal').val());		
		$('#idCidade').val($('#hide_idcidade').val());		
		$('#Cidade').val($('#hide_cidade').val());			 
		$('#Bairro').val($('#hide_bairro').val());			
		$('#CEP').val($('#hide_cep').val());		
		$('#PontoReferencia').val($('#hide_pontoreferencia').val());	
	});
        
$('.btntel').click(function(){ 
		//PEGA OS DADOS DA #titularendereco				
		$('#Tipo').val($('#tel_tipo').val());		
		$('#DDD').val($('#tel_ddd').val());		
		$('#Numero').val($('#tel_numero').val());			
	});       
	
	$(".submit").button({
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
	
	$( ".incorpora" ).button({
		icons: {
			primary: "ui-icon-plus"
		}
	});
        
        $( ".btntel" ).button({
		icons: {
			primary: "ui-icon-plus"
		}
	});
        
        
		
	$( ".baixar" ).button({
		icons: {
			primary: "ui-icon-script"
		}
	});
	
	// increase the default animation speed to exaggerate the effect
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
	
	$("#InicioVigencia").blur(function(){		
		if(verificarData(this,4)){
			$("#msgErro").hide();
		}else{
			$("#msgErro").show();
			$("#InicioVigencia").val("");
		}		
	});
        
    
    //VAMOS TESTAR PARA RDP  
    $('#RDP').change(function(){
     
        
        if($('#RDP').val() == 0){
           
        }else{
                    //TIRA A CLASSE
                    $("#Cnp").removeClass();
                    $("#PIS").removeClass();
                    $("#RG").removeClass();
                    $("#dataExped").removeClass();
        }
    })
    
});

 function pegaRDP(select){ 
	var rdp = $('#RDP').val();	
	$('#bloqueia').val("");	
	//alert($('#RDP').val());
	$('#okimg').hide('fast');
	$('#erroimg').hide('fast');
	$('#carregardp').show();	
	//var rdp = $('#RDP').val();
	var dados = $('#novobeneficiario').serialize();	
	$.ajax({
	type:"POST",
	data: dados,
	//url: "<?php echo $this->baseUrl().'ajax/testardp'?>",
	url: $('#novobeneficiario').attr('action'),	
	success: function(data){		
		if(data == true){		
			$('#okimg').hide('fast');
			$('#erroimg').show('fast');			
			$('#carregardp').hide();
			$('#bloqueia').next("label").show('fast');			
			$('#mostracasamento').slideUp();
			$('#mostrainput').slideUp(); 		
		}else{
			$('#erroimg').hide('fast');
			$('#okimg').show('fast');			
			$('#carregardp').hide();
			$('#bloqueia').val("1");
			$('#bloqueia').next("label").hide('fast');				
			//ABRE CAIXA SE RDP == 1
			if(rdp == 1){			
				$('#mostracasamento').slideDown('fast');
				$('#mostrainput').slideDown('fast');
				//adiciona classe dateBR
				$('#dataCasamento').addClass("dateBR");
				//var titular = $('#titular').val();
				$('#NomeConjuge').val($('#titular').val());
				}else{ 
					$('#mostracasamento').slideUp();
					$('#mostrainput').slideUp();
					$('#NomeConjuge').val('');					
				} 			
			}	
		}	
	});
 }

function selLocalidade(cod,texto){
   $("#carregaNat").hide()
   $( "#Naturalidade").val(texto);
   $( "#idNaturalidade").val(cod); 
   $( "#pesquisa_naturalidade" ).dialog( "close" );
}
function selCidade(cod,texto){
   $( "#Cidade").val(texto);
   $( "#idCidade").val(cod);
   $( "#pesquisa" ).dialog( "close" );
}	