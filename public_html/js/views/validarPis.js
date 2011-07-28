/*
Validador PIS/PASEP
Por Douglas J. Paula
dougbr_4x4@hotmail.com
Este script foi criado utilizando como base
o Validador PIS/PASEP em ASP de Gabriel Fróes 
disponível em www.codigofonte.com.br
*/

var ftap="3298765432";






function ChecaPIS(pis)
{
	var ftap="3298765432";
	var total=0;
	var resto=0;
	var numPIS=0;
	var strResto="";
	numPIS=pis;			
	if (numPIS=="" || numPIS==null)	{
		return false;
	}	
	for(i=0;i<=9;i++)	{
		resultado = (numPIS.slice(i,i+1))*(ftap.slice(i,i+1));
		total=total+resultado;
	}	
	resto = (total % 11);	
	if (resto != 0)	{
		resto=11-resto;
	}	
	if (resto==10 || resto==11)	{
		strResto=resto+"";
		resto = strResto.slice(1,2);
	}	
	if (resto!=(numPIS.slice(10,11)))	{
		return false;
	}	
	return true;
}

function ValidaPis(){
	pis=document.form1.numPIS.value;	
	if (!ChecaPIS(pis))	{
		alert("PIS INVALIDO");
	} else {
		alert("PIS VALIDO");
	}
}