<?php

class XmlController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    
    // LISTA O XML 
	public function indexAction(){	

	$xml = new Application_Model_DbTable_Lote();

	$select = $xml->select();
	$select ->where('status = ? ', 1 );
			
	$this->view->xml = $xml->fetchall($select);

		
    }
    
    
    // GERA O XML
    public function gerarAction(){   
  	
    $request = $this->getRequest();
    $lote = $request->getParam('lote');
    
    $lote_obj = new Application_Model_DbTable_Lote();
    $lote_tab = $lote_obj->find($lote)->current();
    $contrato = $lote_tab['contrato'];
    
    //DADOS DO BENEFICIARIO
    $beneficiario = new Application_Model_DbTable_Beneficiario();
    
    	$select = $beneficiario->select();
		$select ->where('lote = ? ', $lote );
    
	$tab_beneficiario = $beneficiario->fetchall($select);
	
	$dadosXml = "<?xml version='1.0' encoding='ISO-8859-1' standalone='yes'?>\n";
	$dadosXml.= "<MovimentacoesCadastrais xmlns='MovimentacoesCadastrais.xsd'>\n"; //ABRE NÓ PAI PRINCIPAL
   	$dadosXml.= "<Lote>\n"; #CRIA O LOTE
	
	
   foreach($tab_beneficiario as $key=>$row) {
         
	//GERANDO XML  PARTIR DOS DADOS ACIMA
	
	    
		 $dadosXml.=$row['AutoId']!=""?"<Alteracao>\n":"<Inclusao>\n"; #TIPO ALTERACAO
		 	$dadosXml.="<Beneficiario>\n"; #BENEFICIARIO
		 	
		 		$dadosXml.="<Codigo>".$row['idBeneficiario']."</Codigo>\n "; #CODIGO DO BENEFICIARIO 		 		
		 		$dadosXml.="<Familia>".$row['Familia']."</Familia>\n "; #CODIGO DA FAMILIA 
		 		$dadosXml.="<InicioVigencia>".$row['InicioVigencia']."</InicioVigencia>\n "; #Inicio de vigencia 
		 		$dadosXml.="<Tipo>1</Tipo>\n "; #TIPO
		 		$dadosXml.="<IncluidoComoRn>FALSE</IncluidoComoRn>\n "; #INCLUIDO COMO RN
		 		$dadosXml.="<RDP>".$row['RDP']."</RDP>\n "; #RDP
		 		$dadosXml.="<GrauDependencia>00</GrauDependencia>\n "; #GrauDependencia
		 		$dadosXml.="<Importado>TRUE</Importado>\n "; #Importado
		 		$dadosXml.="<Pessoa>\n "; #INICIA PESSOA
		 			$dadosXml.="<Nome>".$row['Nome']."</Nome>\n";
		 			$dadosXml.="<NomeReduzido>".$row['Nome']."</NomeReduzido>\n";
		 			$dadosXml.="<DataNascimento>".$row['DataNascimento']."</DataNascimento>\n";
		 			$dadosXml.="<Sexo>".$row['Sexo']."</Sexo>\n";
		 			$dadosXml.="<Cnp>".$row['Cnp']."</Cnp>\n";
		 			$dadosXml.="<EstadoCivil>".$row['EstadoCivil']."</EstadoCivil>\n"; #O CERTO DO ESTADO CIVIL É EXIBIR LETRA
		 			$dadosXml.="<NomeMae>".$row['NomeMae']."</NomeMae>\n";
		 			$dadosXml.="<Tipo>2</Tipo>\n";
		 			
		 			
		 			//outro select aqui para pegar endereco desse BENEficiario
		 				$beneficiarioEnd = new Application_Model_DbTable_Endereco();
		 				
		 				
		 				$select = $beneficiarioEnd->select()
						->where('lote = ? ', $lote )
						->where('idBeneficiario = ?', $row['idBeneficiario']);
				    
						$tab_beneficiarioEnd = $beneficiarioEnd->fetchall($select);
						
						//$dadosXml.="<enderecocount>".$tab_beneficiarioEnd->count()."</enderecocount>";
						//  FIM DA CONSULTA QUE PEGA ENDERECO 
						//
						
						
						foreach($tab_beneficiarioEnd as $k=>$r){
						
		 			
		 			$dadosXml.="<Endereco>\n"; #INICIA ENDEREÇO DA PESSOA
		 				$dadosXml.="<NomeLogradouro>".$r['Logradouro']."</NomeLogradouro>\n";
		 				$dadosXml.="<Bairro>".$r['Bairro']."</Bairro>\n";
		 				$dadosXml.="<Cidade>".$r['Cidade']."</Cidade>\n";
		 				$dadosXml.="<CEP>".$r['CEP']."</CEP>\n";
		 				$dadosXml.="<NumLogradouro>".$r['NumLogradouro']."</NumLogradouro>\n";
		 				$dadosXml.="<UF>SP</UF>\n"; /*** CRIAR NO BD ***/
		 				$dadosXml.="<Tipo>1</Tipo>\n";/*** CRIAR NO BD ***/
		 				$dadosXml.="<InicioVigencia>".$r['inicioVigencia']."</InicioVigencia>\n";
		 			$dadosXml.="</Endereco>\n"; #FECHA ENDEREÇO DA PESSOA
		 			
						}
		 			
		 			/* ESSE REGISTRO TEM TIPO Q EH PARA SABER Q TIPO DE REGISTRO
		 			 * 
		 			 * POR EXEMPLO: O REGISTRO TIPO 9 É O PIS O 11 É O INSS
		 			 * SABEMOS O TIPO PELO CARDIO NA TABELA 'TipoRegPessoa'
		 			 * 
		 			 */
		 			$dadosXml.="<Registro>\n"; # INICIA REGISTRO
		 				$dadosXml.="<Numero>12779406242</Numero>\n";
		 				$dadosXml.="<Tipo>9</Tipo>\n";
		 			$dadosXml.="</Registro>\n"; # FECHA REGISTRO
		 			
		 			$dadosXml.="<Registro>\n"; # INICIA REGISTRO2
		 				$dadosXml.=" <Numero>48649209-6</Numero>\n";
		 				$dadosXml.="<Tipo>1</Tipo>\n";
		 				$dadosXml.="<UfRg>SP</UfRg>\n";	
		 			$dadosXml.="</Registro>\n"; # FECHA REGISTRO2
		 		$dadosXml.="</Pessoa>\n "; #FECHA PESSOA
		 		
		 		
		 		$dadosXml.="<Modulo>\n"; #ABRE MODULO
		 			$dadosXml.="<Codigo>001314410</Codigo>\n";
		 			$dadosXml.="<InicioVigencia>01/03/2010</InicioVigencia>\n";
		 			$dadosXml.="<DataBaseCob>01/03/2010</DataBaseCob>\n";
		 		$dadosXml.="</Modulo>\n"; #FECHA MODULO
		 		
		 		
		 		$dadosXml.="<LotacaoBeneficiario>\n"; #INICIA LOTAÇÃO DO BENEFICIARIO
		 			$dadosXml.="<Codigo>31440001</Codigo>\n";
		 			$dadosXml.="<InicioVigenciLot>01/03/2010</InicioVigenciLot>\n";
		 		$dadosXml.="</LotacaoBeneficiario>\n";# FECHA LOTAÇÃO DO BENEFICIARIO

		 		
		 		
		 		//LOCAL DE ATENDIMENTO DO BENEFICIARIO
		 		$LocalAtendimento = new Application_Model_DbTable_LocalAtendimento();
		 			
		 		$select = $LocalAtendimento->select()
		 		->where('lote = ? ', $lote )
		 		->where('idBeneficiario = ?', $row['idBeneficiario']);
		 			
		 		$tab_localAtendimento = $LocalAtendimento->fetchall($select);
						

		 		$dadosXml.="<AberturaRepasse>\n"; #INICIA ABERTURA REPASSE
		 		foreach($tab_localAtendimento as $local=>$valores){
		 		
		 			$dadosXml.="<LcAt>".$valores['AutoId']."</LcAt>\n";
		 			$dadosXml.="<InicioVigencia>".$valores['inicioVigencia']."</InicioVigencia>\n";
		 			$dadosXml.="<Tipo>TIPOOO</Tipo>\n";
		 		}
		 		$dadosXml.=" </AberturaRepasse>\n"; #FECHA ABERTURA REPASSE
		 	$dadosXml.="</Beneficiario>\n"; #FECHA BENEFICIARIO		 		
		 $dadosXml.=$row['AutoId']!=""?"</Alteracao>\n":"</Inclusao>\n";;  #FECHA TIPO ALTERACAO
		 		


	
   	}//FECHA LAÇO DO FOREACH

    $dadosXml.= "</Lote> ";  #FECHA O LOTE
		
	
	$dadosXml.= "</MovimentacoesCadastrais>"; // FECHA NÓ PAI PRINCIPAL
		
	
	//GRAVA
	file_put_contents($contrato.".xml", $dadosXml);	
	
    }
    
    
	
}



?>