//AJAX DO ENDERECO
//CRIADO POR PV EM 07/06/2011
//paulo.gomes@season.com.br

$(document).ready(function(){	
	
$('#confirmaEndereco').click(function(){

		if($('#conteudoEndereco1 #Logradouro').val() == "" || $('#conteudoEndereco1 #NumLogradouro').val()  == "" || $('#conteudoEndereco1 #Cidade').val() == "" || $('#conteudoEndereco1 #Bairro').val() == "" || $('#conteudoEndereco1 #CEP').val() == "" || $('#conteudoEndereco1 #endtipo').val() == "" ){
		
		$('#erroEndereco2').show('slow');
		
		 setTimeout(function(){
				$('#erroEndereco2').hide('slow');	  
			},4000);
			return;
			
		}else{
	
			$('#conteudoEndereco').addClass('carrega');
			
			var idBeneficiarioUnimed = $('#conteudoEndereco').find('#idBeneficiarioUnimed').val();
			var idEndereco = $('#conteudoEndereco').find('#idEndereco').val();

			var Endtipo = $('#conteudoEndereco').find('select option:selected').val();
			
			//PEGANDO O TIPO 
			if(Endtipo == 1){ var Endnome = "Comercial";}else{ var Endnome = "Residencial"; }
			
			
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
						
                                                $('#conteudoEndereco input').each(function(){ 
                                                    $(this).val(''); 
                                                });
                                                
						//SUBSTITUINDO VALORES DA TELA PELOS DIGITADOS PELO USU√?RIO
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
						*/
					
					}else{
						$('#conteudoEndereco').hide('slow');
						$('#conteudoEndereco').removeClass('carrega');
						alert("Ocorreu alguma falha no sistema, n√£o se preocupe estamos analisando o erro.");
					}
			
				}
			
			});
		
		}	
	});








});
/*ADICIONE SEU SCRIPT AQUI*/
/*ADICIONE SEU SCRIPT AQUI*/
