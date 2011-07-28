//BOTÕES DA VIEW EXIBEALT
//CRIADO POR PV EM 06/06/2011
//paulo.gomes@season.com.br

/* BOTÕES  */
$(document).ready(function(){
	$( "#tabs" ).tabs().find( ".ui-tabs-nav" ).sortable({ axis: "x" });
	$( ".botao" ).button({
		icons: {
			primary: "ui-icon-plus"
		}
	}),
	
	
	$( "#botao" ).button({
		icons: {
			primary: "ui-icon-plus"
		}
	}),

	$( ".modulo" ).button({
		icons: {
			primary: "ui-icon-wrench"
		}
	}),
	$( ".lotacao" ).button({
		icons: {
			primary: "ui-icon-wrench"
		}
	}),
	
	$( ".local" ).button({
		icons: {
			primary: "ui-icon-wrench"
		}
	});
	
	$( ".endereco" ).button({
		icons: {
			primary: "ui-icon-wrench"
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
   



/* EXIBIR E OCULTAR PAINEIS PARA AJAX */	
   
	$('#conteudoModulo').hide();	    
	$('#exibir').click(function(){
		$('#conteudoModulo').show('slow');
	});	
			
	$('#conteudoLcat').hide();
	$('#exibirLcat').click(function(){
		$('#conteudoLcat').show('slow');
	});	
			
	$('#conteudoLotacao').hide();	
	$('#exibirLotacao').click(function(){
		$('#conteudoLotacao').show('fast');
	});
	
	$('#conteudoEndereco').hide();
	$('#exibirEndereco').click(function(){
		$('#conteudoEndereco').show('fast');
	});	
	//CASO CLIQUE EM CANCELAR FECHA OU SEJA DA UM HIDE
	$('#cancelar').click(function(){
		$('#conteudoModulo').hide('slow');
		$('#conteudoLcat').hide('slow');
		$('#conteudoLotacao').hide('slow');
	});

/* TRATAMENTO DE ERROS */
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
		 CEP: {required: true},
		 RG:{minlength:6,maxlength:13}
      },
      messages: {
         Nome: {required: '<br> Informe o nome' },
         NomeMae: {required: 'Informe o nome da mãe' },
         NomePai: {required: '<br>Informe o nome do pai' },
		 Sexo: {required: 'Informe' },
		 EstadoCivil: {required: 'Informe' },
         email: {required: 'Informe o e-mail' },
		 Modulo: {required: 'Informe o plano'},
		 Endtipo: {required: 'Informe'},
		 NumLogradouro: {required: 'Informe o número'},
		 Cidade: {required: 'Informe a cidade'},
		 Bairro: {required: 'Informe o bairro'},
		 CEP: {required: 'Informe o CEP'},
		 RDP: {required: 'Informe o RDP'},
		 Logradouro: {required: 'Informe o endereço'},
         data: {required: 'Informe', dateBR: 'Data inválida'},
		 RG: {minlength:'deve ser maior que 6 caracteres',maxlength:'deve ser menor que 13 caracteres'}
		 
      }
	  //, 
          //submitHandler:function(form) {
            //    alert('ok');
             // }
   });
   $.fx.speeds._default = 1000;
	$( "#altmodulo" ).dialog({
		autoOpen: false,
		show: "blind",
		height: 550,
		width: 800,
		hide: "explode"
	});

	$( ".modulo" ).click(function() {
		$( "#altmodulo" ).dialog( "open" );
		return false;
	}),
	$( "#altlocal" ).dialog({
		autoOpen: false,
		show: "blind",
		height: 550,
		width: 700,
		hide: "explode"
	});

	$( ".local" ).click(function() {
		$( "#altlocal" ).dialog( "open" );
		return false;
	}),
		$( "#altlotacao" ).dialog({
		autoOpen: false,
		show: "blind",
		height: 550,
		width: 700,
		hide: "explode"
	});

	$( ".lotacao" ).click(function() {
		$( "#altlotacao" ).dialog( "open" );
		return false;
	});
	
	$( "#altendereco" ).dialog({
		autoOpen: false,
		show: "blind",
		height: 550,
		width: 950,
		hide: "explode"
	});

	$( ".endereco" ).click(function() {
		$( "#altendereco" ).dialog( "open" );
		return false;
	});


/* MASCARA DE FORMULARIO */
	$("#Cnp").mask("999.999.999-99");		
	$("#confirma").click(function(){
		if(verificarData($("#DataNascimento"),1)){
			//$("#Cnp").mask("999.999.999-99");
			$("#Cnp").addClass('cpf');
			$("#PIS").addClass('pis');
			$("#RG").addClass('rg');
			$("#dataExped").addClass('dateBR');
			$('#Cnp').next("label").show('fast');
			$('#PIS').next("label").show('fast');
			$('#RG').next("label").show('fast');
			$('#dataExped').next("label").show('fast');
		}else{
			$("#Cnp").unmask("999.999.999-99");
			$("#Cnp").removeClass();
			$("#PIS").removeClass();
			$("#RG").removeClass();			
			$("#dataExped").removeClass();
			$('#Cnp').next("label").hide('fast');
			$('#PIS').next("label").hide('fast');
			$('#RG').next("label").hide('fast');
			$('#dataExped').next("label").hide('fast');
		}			
	});	
	$(".telefone").mask("9999-9999");
	$(".dateBR").mask("99/99/9999");
	$(".numero").mask("999999999");
	$(".ddd").mask("99");
	$(".cep").mask("99999-999");
	//$(".pis").mask("999.99999.99-9");
	
        
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
        
        //DECLARACAO DE NASCIDO VIVO
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
	
/*	
	COMENTEI ESSA LINHA POIS ESTAMOS FAZENDO A CHAMADA DE UMA FUNÇÃO BLOBAL EM
	JS/AJAX/ENDERECO.JS
	
	Nome: Paulo Victor Gomes
	Data: 15/06/2011
	
	
	$('#confirmaEndereco').click(function(){	

		$('#conteudoEndereco').addClass('carrega');		
		var idBeneficiarioUnimed = $('#conteudoEndereco').find('#idBeneficiarioUnimed').val();
		var idEndereco = $('#conteudoEndereco').find('#idEndereco').val();
		var Endtipo = $('#conteudoEndereco').find('select option:selected').val();		
		//PEGANDO O TIPO 
		if(Endtipo == 1){ 
			var Endnome = "Comercial";
		}else{ 
			var Endnome = "Residencial"; 
		}				
		var endSeq = $('#conteudoEndereco').find('#endSeq').val();		
		var Logradouro = $('#conteudoEndereco').find('#Logradouro').val();
		var NumLogradouro = $('#conteudoEndereco').find('#NumLogradouro').val();
		var ComplLogradouro = $('#conteudoEndereco').find('#ComplLogradouro').val();
		var CaixaPostal = $('#conteudoEndereco').find('#CaixaPostal').val();
		var idCidade = $('#conteudoEndereco').find('#idCidade').val();
		var Cidade = $('#conteudoEndereco').find('#Cidade').val();
		var Bairro = $('#conteudoEndereco').find('#Bairro').val();
		var CEP = $('#conteudoEndereco').find('#CEP').val();
		var PontoReferencia = $('#conteudoEndereco').find('#PontoReferencia').val();
		var ParaCorrespondencia = $('#conteudoEndereco').find('#ParaCorrespondencia').val();
		var ParaFaturamento = $('#conteudoEndereco').find('#ParaFaturamento').val();
		var ParaCobranca = $('#conteudoEndereco').find('#ParaCobranca').val();
		var ParaPublicacao = $('#conteudoEndereco').find('#ParaPublicacao').val();		
		var dataInicio = $('#conteudoEndereco').find('#iniCaixaVig').val();		
		//alert(Cidade);		
		var dados = $('#conteudoEndereco').serialize();		
		$.ajax({
			type:"POST",
			data: dados,
			url: $('#conteudoEndereco').attr('action'),		
			success: function(data){
		
				if(data != null){
					$('#conteudoEndereco').hide('fast');
					$('#exibeTodosEnderecos').hide('fast');
					$('#conteudoEndereco').removeClass('carrega');					
					//ADICIONA DATA RECEBIDA PELO CONTROLLER
					$('#exibeTodosEnderecos').find('table tr td:last').append(data);					
					//$('#altmodulo').find('table tr td:last').append(dataFim);
					$('#exibeTodosEnderecos').find('table').append('<tr><td>'+ endSeq +'</td><td>'+ Logradouro +'</td><td>'+ Bairro +'</td><td>'+ Cidade +'</td><td>' + Endnome +'</td><td>' + dataInicio + '</td><td></td></tr>');
					$('#exibeTodosEnderecos').show('fast');					
					//SUBSTITUINDO VALORES DA TELA PELOS DIGITADOS PELO USU�?RIO
					/*
					$("#endseq").text(endSeq);
					$("#endlogradouro").text(Logradouro);
					$("#endnumero").text(NumLogradouro);
					$("#endcomplemento").text(ComplLogradouro);
					$("#endcaixapostal").text(CaixaPostal);
					$("#endcidade").text(Cidade);
					$("#endbairro").text(Bairro);
					$("#endcep").text(CEP);
					$("#endpontoref").text(PontoReferencia);
					$("#endnumero").text(NumLogradouro);
							
				}else{
					$('#conteudoEndereco').hide('slow');
					$('#conteudoEndereco').removeClass('carrega');
					alert("Ocorreu alguma falha no sistema, não se preocupe estamos analisando o erro.");
				}		
			}		
		});		
	});
*/	
	
	$( "#pesquisa_naturalidade" ).dialog({
		autoOpen: false,
		show: "blind",
		height: 450,
		width: 500,
		hide: "explode"
	});	
	
	$( "#pesquisa" ).dialog({
		autoOpen: false,
		show: "blind",
		height: 450,
		width: 500,
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
});



function pegaNome(select){
 
	$("#NomePlano").attr("value",$(select).find('option:selected').text());
	//alert($('#Nome').val());

 }
 
 function pegaNomeLcat(select){
	
	//conteudoLcat
	$("#NomeLcat").attr("value",$(select).find('option:selected').text());
	//alert($('#NomeLcat').val());

 }
 
 function pegaNomeLotacao(select){
	
	//conteudoLcat
	$("#NomeLotacao").attr("value",$(select).find('option:selected').text());
	//alert($('#NomeLcat').val());

 }
 
 
 
 function selLocalidade(cod,texto){
	   $( "#Naturalidade").val(texto);
	   $( "#idNaturalidade").val(cod);
	   $( "#pesquisa_naturalidade" ).dialog( "close" );
}

function selCidade(cod,texto){
   $( "#Cidade").val(texto);
   $( "#idCidade").val(cod);
   $( "#pesquisa" ).dialog( "close" );
}

 function selLocalidade(cod,texto){
	   $( "#Naturalidade").val(texto);
	   $( "#idNaturalidade").val(cod);
	   $( "#pesquisa_naturalidade" ).dialog( "close" );
}




/*ADICIONE SEU SCRIPT AQUI*/
/*ADICIONE SEU SCRIPT AQUI*/
/*ADICIONE SEU SCRIPT AQUI*/
/*ADICIONE SEU SCRIPT AQUI*/
/*ADICIONE SEU SCRIPT AQUI*/
/*ADICIONE SEU SCRIPT AQUI*/
