
hoje = new Date()
dia = hoje.getDate()
mes = hoje.getMonth()
ano = hoje.getFullYear()
if (dia < 10)
dia = "0" + dia
if (ano < 2000)
ano = "19" + ano

//O MES COMEÇA EM ZERO 
mes = mes + 1

if (mes < 10)
mes = ("0" + mes)

diahoje = (dia+"/"+(mes)+"/"+ano);

return diahoje;


//O mes começa em Zero, então soma-se 1
//alert(dia+"/"+(mes)+"/"+ano) 


