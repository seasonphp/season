/**
	OPÇÕES QUE DETERMINAM O COMPORTAMENTO DA FUNÇÃO
	
	VARIAVEL IDENTIFICADOR
	1 - IDADE MAIOR DE 18 ANOS
	2 - DATA MENOR/IGUAL QUE A DE HOJE - NASCIMENTO
	3 - DATA MAIOR/IGUAL QUE A DE HOJE - INICIO VIGENCIA
	4 - PODE SER ATÉ 1 MES RETROATIVO
	
*/
function verificarData(campoData,identificador){
	var retorno = false;
	var dia = $(campoData).val().substring(0,2);
	var mes = $(campoData).val().substring(3,5);
	var ano = $(campoData).val().substring(6);
	
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
	
	var anoIdade = anoHoje - ano;
	var mesIdade = mesHoje - mes;
	var diaIdade = diaHoje - dia;
	
	if(identificador == 1){
		retorno = isMaior18(diaIdade,mesIdade,anoIdade);
	}else{
		if(identificador == 2){
			retorno = isDataMenorIgualHoje(dia,mes,ano,diaHoje,mesHoje,anoHoje);
		}else{
			if(identificador == 3){
				retorno = isDataMaiorIgualHoje(dia,mes,ano,diaHoje,mesHoje,anoHoje);				
			}else if(identificador == 4){
				if(mesHoje == 1){ anoHoje = anoHoje - 1; mesHoje = 12;}else{mesHoje = mesHoje - 1;}
				retorno = isDataMaiorIgualHoje(dia,mes,ano,diaHoje,mesHoje,anoHoje);
			}
		}
	}
	return retorno;
}


function isMaior18(diaIdade,mesIdade,anoIdade){
	retorno = false;
	if(anoIdade >= 18){	
		if(anoIdade == 18){	
			if(mesIdade == 0){
				if(diaIdade >= 0){
					retorno = true;
				}
			}else {
				if (mesIdade > 0){
					retorno = true;
				}
			}
		}else{
			retorno = true;
		}
	}	
	return retorno;
}




/**FUNÇÃO PARA IMPEDIR DATAS MAIORES QUE HOJE - NASCIMENTO
*	
*/
function isDataMenorIgualHoje(dia,mes,ano,diaHoje,mesHoje,anoHoje){
	
	retorno = false;
	if(dia != 00){
		if(ano <= anoHoje){
			if(ano == anoHoje){
				if(mes == mesHoje){
					if(dia <= diaHoje){												
						retorno = true;
					}
				}else {
					if (mes < mesHoje){						
						retorno = true;
					}
				}
			}else{						
				retorno = true;
			}
		}
	}
	return retorno;
}

/**FUNÇÃO PARA IMPEDIR DATAS MENORES QUE HOJE - NASCIMENTO
*	
*/
function isDataMaiorIgualHoje(dia,mes,ano,diaHoje,mesHoje,anoHoje){

	retorno = false;
	if(dia != 00){	
		if(ano >= anoHoje){
			if(ano == anoHoje){
				if(mes == mesHoje){
					if(dia >= diaHoje){												
						retorno = true;
					}
				}else {
					if (mes > mesHoje){						
						retorno = true;
					}					
				}
			}else{						
				retorno = true;
			}	
		}
	}			
	return retorno;
}



/**VERIFICA SE DATA DE NASCIMENTO É MAIOR QUE JANEIRO/2009*/
function verificarDtNascimento(campoData){
	var retorno = false;
	var ano = $(campoData).val().substring(6);	
	if(ano >= 2009){
		retorno = true;
	}
	return retorno;
}