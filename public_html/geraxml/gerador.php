<?php
#versao do encoding xml
$dom = new DOMDocument("1.0", "ISO-8859-1");

#retirar os espacos em branco
$dom->preserveWhiteSpace = false;

#gerar o codigo
$dom->formatOutput = true;

#criando o nó principal (root)
$root = $dom->createElement("MovimentacoesCadastrais");
 #nó filho (LOTE)
 $lote = $dom->createElement("lote");
  //codigo
  $codigo = $dom->createElement("Codigo","0010457000017306");
  //Inclusao
  $inclusao = $dom->createElement("Inclusao");
   //Beneficiario
   $beneficiario = $dom->createElement("Beneficiario");
    $codigoBene = $dom->createElement("Codigo","0018");
    $familia = $dom->createElement("Familia","000077");
    
    
    
    $inicioVigencia = $dom->createElement("InicioVigencia");
    $tipo = $dom->createElement("Tipo");
    
    
    $incluidoComoRn = $dom->createElement("IncluidoComoRn");
    $rdp = $dom->createElement("RDP");
    
    
    
    $grauDependencia = $dom->createElement("GrauDependencia");
    $Importado = $dom->createElement("Importado");
    $Contrato = $dom->createElement("Contrato");
    
    
    
    $Pessoa = $dom->createElement("Pessoa");
     
     //PERTENCEM A PESSOA 
     $Nome = $dom->createElement("Nome");
     $NomeReduzido = $dom->createElement("NomeReduzido");
     $DataNascimento = $dom->createElement("DataNascimento");
     $Sexo = $dom->createElement("Sexo");
     $Cnp= $dom->createElement("Cnp");
     $EstadoCivil= $dom->createElement("EstadoCivil");
     $NomeMae = $dom->createElement("NomeMae");
     $TipoPes = $dom->createElement("Tipo");
     //CADE NOME DO PAI? 
     
     $Endereco = $dom->createElement("Endereco");
      //PERTENCEM A ENDERECO
      $NomeLogradouro = $dom->createElement("NomeLogradouro");
      $Bairro = $dom->createElement("Bairro");
      $Cidade = $dom->createElement("Cidade");
      $CEP = $dom->createElement("CEP");
      $NumLogradouro = $dom->createElement("NumLogradouro");
      $UF = $dom->createElement("UF");
      $tipoEnd = $dom->createElement("Tipo");
      $InicioVigenciaEnd = $dom->createElement("InicioVigencia");
    
     $Registro = $dom->createElement("Registro");
      //PERTENCE AO REGISTRO 
      $Numero = $dom->createElement("Numero");
      $TipoRg = $dom->createElement("TipoRg");
      $UfRg = $dom->createElement("UfRg");
      
    $Modulo = $dom->createElement("Modulo");
     //PERTENCE A MODULO (PLANO)
     $CodigoModulo = $dom->createElement("Codigo");
     $InicioVigencia = $dom->createElement("InicioVigencia");
     $DataBaseCob = $dom->createElement("DataBaseCob");

    $Registro = $dom->createElement("Registro");
    
    $LotacaoBeneficiario = $dom->createElement("LotacaoBeneficiario");
    
     $CodigoLot = $dom->createElement("CodigoLot");
     $InicioVigenciLot = $dom->createElement("InicioVigenciLot");
     
    $AberturaRepasse = $dom->createElement("AberturaRepasse");
     $LcAt = $dom->createElement("LcAt");
     $InicioVigencia = $dom->createElement("InicioVigencia");
     $TipoAbert = $dom->createElement("TipoAbert");
    
   
   


#CRIANDO CAMADAS 
$dom->appendChild($root);
 $root->appendChild($lote);
  $lote->appendChild($codigo);
  $lote->appendChild($inclusao);
   $inclusao->appendChild($beneficiario);
    $beneficiario->appendChild($codigoBene);
    $beneficiario->appendChild($familia);
    $beneficiario->appendChild($inicioVigencia);
    $beneficiario->appendChild($tipo);
    $beneficiario->appendChild($incluidoComoRn);
    $beneficiario->appendChild($rdp);
    $beneficiario->appendChild($grauDependencia);
    //$beneficiario->appendChild($importado);
    $beneficiario->appendChild($Contrato);
    $beneficiario->appendChild($Pessoa);
     //PERTENCE A PESSOA
     $Pessoa->appendChild($Nome);
     $Pessoa->appendChild($NomeReduzido);
     $Pessoa->appendChild($DataNascimento);
     $Pessoa->appendChild($Sexo);
     $Pessoa->appendChild($Cnp);
     $Pessoa->appendChild($EstadoCivil);
     $Pessoa->appendChild($NomeMae);
     $Pessoa->appendChild($TipoPes);
     $Pessoa->appendChild($Endereco);
      //PERTENCE A ENDERECO
      $Endereco->appendChild($NomeLogradouro);
      $Endereco->appendChild($Bairro);
      $Endereco->appendChild($Cidade);
      $Endereco->appendChild($CEP);
      $Endereco->appendChild($NumLogradouro);
      $Endereco->appendChild($UF);
      $Endereco->appendChild($tipoEnd);
      $Endereco->appendChild($InicioVigenciaEnd);
     
     $Pessoa->appendChild($Registro);
      //Registro
      $Registro->appendChild($Numero);
      $Registro->appendChild($TipoRg);
      $Registro->appendChild($UfRg);
      
       
     
    $beneficiario->appendChild($Modulo);
     $Modulo->appendChild($CodigoModulo);
     $Modulo->appendChild($InicioVigencia);
     $Modulo->appendChild($DataBaseCob);
     
    $beneficiario->appendChild($Registro);
    $beneficiario->appendChild($LotacaoBeneficiario);
      //PERTENCE A LOTAÇÃO BENE
      $LotacaoBeneficiario->appendChild($CodigoLot);
      $LotacaoBeneficiario->appendChild($InicioVigenciLot);
     
    $beneficiario->appendChild($AberturaRepasse);
      //pertence a abertura repasse
      $AberturaRepasse->appendChild($LcAt);
      $AberturaRepasse->appendChild($InicioVigencia);
      $AberturaRepasse->appendChild($TipoAbert);
  

# Para salvar o arquivo, descomente a linha
$dom->save("unimed.xml");

#cabeçalho da página
header("Content-Type: text/xml");
# imprime o xml na tela
print $dom->saveXML();
?>