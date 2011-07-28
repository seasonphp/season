/***É só chamar com  o evento onKeyup="verificarRg(this)"*/

function verificaRg(campo){
	var checado = false;
	var valor = $(campo).val()
	var tamanho = valor.length;
	var k;
	var cont = 0;
	var ocorrencias = 1;	
	if(tamanho >= 4 ){		
		for(var i = tamanho-1; (tamanho - (i+1)) < 4; i--){			
			if(cont == 0){
				k = valor.substr(i,1);				
				cont = 1;
			}else{
				if(k == valor.substr(i,1)){
					ocorrencias++;
				}else{
					k = valor.substr(i,1);
					ocorrencias = 0;
				}			
			}		
		}
		if(ocorrencias < 4){
			checado = true;			
		}else{			
			$(campo).attr("value","") ;
		}                          		
	}
}