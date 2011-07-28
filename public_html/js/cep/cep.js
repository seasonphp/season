function getEndereco() {
	// Se o campo CEP não estiver vazio
	if($.trim($("#CEP").val()) != ""){
		//document.getElementById("load").style.display = 'block';
			/* 
					Para conectar no serviço e executar o json, precisamos usar a função
					getScript do jQuery, o getScript e o dataType:"jsonp" conseguem fazer o cross-domain, os outros
					dataTypes não possibilitam esta interação entre domínios diferentes
					Estou chamando a url do serviço passando o parâmetro "formato=javascript" e o CEP digitado no formulário
					http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cep").val()
			*/
			$.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#CEP").val(), function(){
					// o getScript dá um eval no script, então é só ler!
					//Se o resultado for igual a 1
					if(resultadoCEP["resultado"] && resultadoCEP["bairro"] != ""){
							// troca o valor dos elementos
							$("#Logradouro").val(unescape(resultadoCEP["tipo_logradouro"])+": "+unescape(resultadoCEP["logradouro"]));
							$("#Bairro").val(unescape(resultadoCEP["bairro"]));
							//$("#Cidade").val(unescape(resultadoCEP["cidade"]));
							//$("#estado").val(unescape(resultadoCEP["uf"]));
							//$("#enderecoCompleto").show("slow");
							$("#NumLogradouro").focus();
							//document.getElementById("load").style.display = 'none';
							//validate()
					}else{
							alert("Endereço não encontrado");
							//$("#enderecoCompleto").show("slow");
							return false;
					}
			});                             
	}
    else
    {
        alert('Antes, preencha o campo CEP!')
		//document.getElementById("load").style.display = 'none';
    }
	
}

