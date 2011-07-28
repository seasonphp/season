<?php

class XmlController extends Zend_Controller_Action {

    private function graudependencia($grau) {
       if ($grau == 0) {
            return 0;
        }
        if ($grau == 1) {
            return 1;
        }
        if ($grau == 2) {
            return 2;
        }
        if ($grau >= 10 and $grau <= 49) {
            return 10;
        }
        /*if ($grau >= 30 and $grau <= 49) {
            return 30;
        }*/
        if ($grau == 50) {
            return 50;
        }
        if ($grau == 51) {
            return 51;
        }
        if ($grau == 52) {
            return 52;
        }
        if ($grau == 53) {
            return 53;
        }
        if ($grau >= 60 and $grau <= 69) {
            return 60;
        }
        if ($grau >= 70 and $grau <= 79) {
            return 70;
        }
        if ($grau >= 80 and $grau <= 89) {
            return 80;
        }
        if ($grau >= 90 and $grau <= 99) {
            return 90;
        }
    }

    private function Mod11($NumDado, $NumDig, $LimMult) {

        $Dado = $NumDado;
        for ($n = 1; $n <= $NumDig; $n++) {
            $Soma = 0;
            $Mult = 2;
            for ($i = strlen($Dado) - 1; $i >= 0; $i--) {
                $Soma += $Mult * intval(substr($Dado, $i, 1));
                if (++$Mult > $LimMult)
                    $Mult = 2;
            }
            $Dado .= strval(fmod(fmod(($Soma * 10), 11), 10));
        }
        return substr($Dado, strlen($Dado) - $NumDig);
    }

    private function soNumero($str) {
        return preg_replace("/[^0-9]/", "", $str);
    }

    private function true_ou_false($vl) {
        if ($vl == 1 or $vl == "S") {
            return "true";
        } else {
            return "false";
        }
    }

    private function codcarteira($contrato, $familia, $dep) {
        $cod = "1" . substr($contrato, 1, 4) . substr('000000' . $familia, strlen('000000' . $familia) - 6, 6) . substr('00' . $dep, strlen('00' . $dep) - 2, 2);
        return $cod . $this->mod11($cod, 1, 9);
    }

    private function dataXml($data) {
        if ($data == "")
            return null;
        else {
            $date = DateTime::createFromFormat('Y-m-d', $data);
            return $date->format('d/m/Y 00:00:00');
        }
    }

    private function dataPhp($data) {
        if ($data != NULL) {
            return date('d/m/Y', strtotime($data));
        }
    }

    public function init() {
        /* Initialize action controller here */
    }

    // LISTA O XML 
    public function indexAction() {

        $xml = new Application_Model_DbTable_Lote();

        $select = $xml->select();
        $select->setIntegrityCheck(false);
        $select->from(array('l' => 'lote'), array('*'))
                ->join(array('e' => 'empresa'), 'l.idLogin = e.id', array('*'))
                ->where('status = ? ', 1);

        //$this->view->xml = $xml->fetchall($select);



        $tab = $xml->fetchall($select);

        //PEGANDO TODOS OS DADOS AQUI JA PASSO LINKS DE GERAR XML E PDF 
        if ($tab->count() == 0) {
            
        } else {

            foreach ($tab as $id => $row) {
                $rows[] = array(
                    $row['AutoId'],
                    $row['contrato'],
                    $row['status'],
                    $this->dataPhp($row['dt_lote']),
                    '/xml/gerar/lote/' . $row['AutoId'],
                    '/pdf/xml/lote/' . $row['AutoId'] . '/contrato/' . $row['contrato'],
                );
            }

            //ESCREVENDO JSON
            $this->view->json = json_encode($rows);

            //echo json_encode($rows);
            //exit;
        }
    }

    // GERA O XML
    public function gerarAction() {

        $request = $this->getRequest();
        $lote = $request->getParam('lote');

        $lote_obj = new Application_Model_DbTable_Lote();
        $lote_tab = $lote_obj->find($lote)->current();
        $contrato = $lote_tab['contrato'];

        //DADOS DO BENEFICIARIO
        $beneficiario = new Application_Model_DbTable_Beneficiario();

        $select = $beneficiario->select();
        $select->where('lote = ? ', $lote);

        $tab_beneficiario = $beneficiario->fetchall($select);
        //encoding='ISO-8859-1' 
        $dadosXml = "<?xml version='1.0' standalone='yes'?>\n";
        $dadosXml.= "<MovimentacaoCadastralAtualizacaoCompleta xmlns='MovimentacaoCadastralAtualizacaoCompleta.xsd'>\n"; //ABRE NÓ PAI PRINCIPAL


        $unicontrato = new Application_Model_DbTable_Unicontrato();


        foreach ($tab_beneficiario as $key => $row) {
            $dadosXml.= "<AtualizacaoCompleta>\n"; #CRIA O LOTE     
            //GERANDO XML  PARTIR DOS DADOS ACIMA
            $objcontrato = $unicontrato->find($row['Contrato'])->current();
            //TEM QUE PEGAR O CONTRATO
            $dadosXml.="<Contrato>" . $objcontrato['Codigo'] . "</Contrato>\n"; #CODIGO DO BENEFICIARIO 		 		
            $dadosXml.="<RDP>" . $row['RDP'] . "</RDP>\n "; #RDP
            $dadosXml.="<Familia>" . $row['Familia'] . "</Familia>\n "; #CODIGO DA FAMILIA
            if ($row['Matricula'] != null) {
                $dadosXml.="<Matricula>" . $row['Matricula'] . "</Matricula>\n "; #CODIGO DA FAMILIA 
            }


            //$dadosXml.="<IncluidoComoRN>".$this->true_ou_false($row['IncluidoComoRN'])."</IncluidoComoRN>\n"; #INCLUINDO COM RN
            $dadosXml.="<IncluidoComoRN>false</IncluidoComoRN>\n"; #INCLUINDO COM RN
            $dadosXml.="<GrauDependencia>" . $this->graudependencia($row['RDP']) . "</GrauDependencia>\n"; #GrauDependencia
            $dadosXml.="<InicioVigencia>" . $this->dataXml($row['InicioVigencia']) . "</InicioVigencia>\n "; #Inicio de vigencia 
            $dadosXml.="<FimVigencia>" . $this->dataXml($row['FimVigencia']) . "</FimVigencia>\n "; #Fim de vigencia 				
            $dadosXml.="<CodigoExterno>" . $this->codcarteira($objcontrato['Codigo'], $row['Familia'], $row['RDP']) . "</CodigoExterno>\n"; #NAO SABEMOS COMO PEGAR ESSE CODIGO

            $dadosXml.="<Pessoa>\n"; #INICIA PESSOA
            $dadosXml.="<Nome>" . $row['Nome'] . "</Nome>\n";
            $dadosXml.="<DataNascimento>" . $this->dataXml($row['DataNascimento']) . "</DataNascimento>\n";
            $dadosXml.="<Cnp>" . $this->soNumero($row['Cnp']) . "</Cnp>\n";
            $dadosXml.="<Tipo>2</Tipo>\n";
            $dadosXml.="<Sexo>" . strtolower($row['Sexo']) . "</Sexo>\n";
            $dadosXml.="<EstadoCivil>" . $row['EstadoCivil'] . "</EstadoCivil>\n";
            if ($row['Naturalidade'] != null and $row['Naturalidade'] != 0) {
                $dadosXml.="<Naturalidade>" . $row['Naturalidade'] . "</Naturalidade>\n";
            }

            if ($row['NomePai'] != null or $row['NomePai'] != '') {
                $dadosXml.="<NomePai>" . $row['NomePai'] . "</NomePai>\n";
            }else{
                $dadosXml.="<NomePai>NAO INFORMADO</NomePai>\n";
            }

            $dadosXml.="<NomeMae>" . $row['NomeMae'] . "</NomeMae>\n";

            if ($row['NomeConjuge'] != null and $row['NomeConjuge'] != '') {
                $dadosXml.="<NomeConjuge>" . $row['NomeConjuge'] . "</NomeConjuge>\n";
            }

            $dadosXml.="<Invalidez>false</Invalidez>\n";


            //Emails
            $beneficiarioEmail = new Application_Model_DbTable_Email();
            $select = $beneficiarioEmail->select()
                    ->where('lote = ? ', $lote)
                    ->where('idBeneficiario = ?', $row['idBeneficiario']);

            $tab_beneficiarioEmail = $beneficiarioEmail->fetchall($select);


            //VERIFICAR STATUS
            foreach ($tab_beneficiarioEmail as $k => $r) {
                if ($r['status'] == 1) {
                    if ($r['Email'] != '') {
                        $dadosXml.="<Emails>\n";
                        $dadosXml.="<Email>" . $r['Email'] . "</Email>\n";
                        $dadosXml.="<Seq>" . $r['Seq'] . "</Seq>\n";
                        $dadosXml.="<InicioVigencia>" . $this->dataXml($r['InicioVigencia']) . "</InicioVigencia>\n";
                        $dadosXml.="<FimVigencia>" . $this->dataXml($r['FimVigencia']) . "</FimVigencia>\n";
                        $dadosXml.="</Emails>\n";
                    }
                }
            }

            //Registros
            $beneficiarioRegistro = new Application_Model_DbTable_Registro();
            $select = $beneficiarioRegistro->select()
                    ->where('lote = ? ', $lote)
                    ->where('idBeneficiario = ?', $row['idBeneficiario']);

            $tab_beneficiarioRegistro = $beneficiarioRegistro->fetchall($select);

            if (count($tab_beneficiarioRegistro) == 1) {
                $rg = $tab_beneficiarioRegistro[0]['RG'];
                $pis = $tab_beneficiarioRegistro[0]['PIS'];
                if ($rg != '') {
                    $dadosXml.="<Registro>\n";
                    $dadosXml.="<Tipo>1</Tipo>\n";
                    $dadosXml.="<Numero>" . $rg . "</Numero>\n";
                    //OrgaoExp
                    //UFExp
                    //DataExp
                    $dadosXml.="</Registro>\n";
                }
                if ($pis != '') {
                    $dadosXml.="<Registro>\n";
                    $dadosXml.="<Tipo>9</Tipo>\n";
                    $dadosXml.="<Numero>" . $pis . "</Numero>\n";
                    $dadosXml.="</Registro>\n";
                }
            }

            //outro select aqui para pegar endereco desse BENEficiario
            $beneficiarioEnd = new Application_Model_DbTable_Endereco();


            $select = $beneficiarioEnd->select()
                    ->where('lote = ? ', $lote)
                    ->where('idBeneficiario = ?', $row['idBeneficiario']);

            $tab_beneficiarioEnd = $beneficiarioEnd->fetchall($select);

            //$dadosXml.="<enderecocount>".$tab_beneficiarioEnd->count()."</enderecocount>";
            //  FIM DA CONSULTA QUE PEGA ENDERECO 
            //
						
						
						foreach ($tab_beneficiarioEnd as $k => $r) {

                //VERIFICAR STATUS
              //  if ($r['status'] == 1) {
                    $dadosXml.="<Endereco>\n"; #INICIA ENDEREÇO DA PESSOA
                    $dadosXml.="<Seq>" . $r['Seq'] . "</Seq>\n";
                    if ($r['NumLogradouro'] != '')
                        $dadosXml.="<NumLogradouro>" . $r['NumLogradouro'] . "</NumLogradouro>\n";

                    $dadosXml.="<NomeLogradouro>" . $r['Logradouro'] . "</NomeLogradouro>\n";
                    
                    $dadosXml.="<ComplLogradouro>" . $r['ComplLogradouro'] . "</ComplLogradouro>\n";
                    $dadosXml.="<Bairro>" . $r['Bairro'] . "</Bairro>\n";
                    $dadosXml.="<Cidade>" . $r['Cidade'] . "</Cidade>\n";
                    $dadosXml.="<Cep>" . $this->soNumero($r['CEP']) . "</Cep>\n";

                    if ($r['PontoReferencia'] != null or $r['PontoReferencia'] != '') {
                        $dadosXml.="<PontoReferencia>" . $r['PontoReferencia'] . "</PontoReferencia>\n";
                    }

                    if ($r['CaixaPostal'] != '' or $r['CaixaPostal'] != null)
                        $dadosXml.="<CaixaPostal>" . $r['CaixaPostal'] . "</CaixaPostal>\n";

                    $dadosXml.="<Tipo>" . ($r['Tipo'] == "" ? "1" : $r['Tipo']) . "</Tipo>\n";
                    $dadosXml.="<ParaCorrespondencia>true</ParaCorrespondencia>\n";
                    $dadosXml.="<ParaCobranca>true</ParaCobranca>\n";
                    $dadosXml.="<ParaFaturamento>true</ParaFaturamento>\n";
                    $dadosXml.="<ParaPublicacao>true</ParaPublicacao>\n";
                    $dadosXml.="<InicioVigencia>" . $this->dataXml($r['InicioVigencia']) . "</InicioVigencia>\n";
                    $dadosXml.="<FimVigencia>" . $this->dataXml($r['FimVigencia']) . "</FimVigencia>\n";
                    //if ( $r['AutoId'] != '' )
                    //$dadosXml.="<CardioAutoId>".$r['AutoId']."</CardioAutoId>\n";
                    //$dadosXml.="<CardioAutoId>".$r['CardioAutoId']."</CardioAutoId>\n";
                    $dadosXml.="</Endereco>\n"; #FECHA ENDEREÇO DA PESSOA
               // }
            }

            $beneficiarioTel = new Application_Model_DbTable_Telefone();


            $select = $beneficiarioTel->select()
                    ->where('lote = ? ', $lote)
                    ->where('idBeneficiario = ?', $row['idBeneficiario']);

            $tab_beneficiarioTel = $beneficiarioTel->fetchall($select);

            //VERIFICAR STATUS
            foreach ($tab_beneficiarioTel as $k => $r) {
                if ($r['Numero'] != '') {
                    $dadosXml.="<Telefone>\n";
                    $dadosXml.="<Seq>" . ($r['Seq'] == '' ? '1' : $r['Seq']) . "</Seq>\n";
                    $dadosXml.="<Tipo>" . $r['Tipo'] . "</Tipo>\n";
                    $dadosXml.="<DDD>" . $r['DDD'] . "</DDD>\n";
                    $dadosXml.="<Numero>" . $this->soNumero($r['Numero']) . "</Numero>\n";
                    $dadosXml.="<InicioVigencia>" . $this->dataXml($r['InicioVigencia']) . "</InicioVigencia>\n";
                    $dadosXml.="<FimVigencia>" . $this->dataXml($r['FimVigencia']) . "</FimVigencia>\n";
                    if ($r['AutoId'] != '')
                    //$dadosXml.="<CardioAutoId>".$r['AutoId']."</CardioAutoId>\n";
                        $dadosXml.="<SeqEnd>" . ($r['SeqEnd'] == '' ? '1' : $r['SeqEnd']) . "</SeqEnd>\n";
                    $dadosXml.="</Telefone>\n";
                }
            }

            $dadosXml.="</Pessoa>\n "; #FECHA PESSOA

            $beneficiarioModulo = new Application_Model_DbTable_Modulo();


            $select = $beneficiarioModulo->select()
                    ->where('lote = ? ', $lote)
                    ->where('idBeneficiario = ?', $row['idBeneficiario']);

            $tab_beneficiarioModulo = $beneficiarioModulo->fetchall($select);

            foreach ($tab_beneficiarioModulo as $k => $r) {

                //PERGUNTA SE STATUS É 1, SE SIM INFORMA MODULO
                if ($r['status'] == 1) {

                    if ($r['FimVigencia'] != '' or $r['FimVigencia'] != null) {

                        //ENTÃO FECHA OS ACESSÓRIOS
                        $unibeneficiario = new Application_Model_DbTable_Unibeneficiario();
                        $select = $unibeneficiario->select();
                        $select->setIntegrityCheck(false);
                        $select->from(array('b' => 'Beneficiario'), array('*'))
                                ->joinLeft(array('m' => 'ModuloBeneficiario'), 'b.AutoId = m.Beneficiario', array('m.InicioVigencia'))
                                ->joinLeft(array('o' => 'ModuloOperadora'), 'm.Modulo = o.AutoId', array('o.Codigo'))
                                ->where('b.AutoId = ? and m.fimvigencia is null and o.tipo=9', $row['AutoId']);

                        $modulos = $unibeneficiario->fetchAll($select);


                        foreach ($modulos as $iModulo => $rModulo) {

                            $dadosXml.="<Modulos>\n"; #ABRE MODULO
                            $dadosXml.="<Codigo>" . $rModulo['Codigo'] . "</Codigo>\n";
                            $dadosXml.="<DataBaseCob>" . $this->dataPhp($rModulo['InicioVigencia']) . "</DataBaseCob>\n";
                            $dadosXml.="<InicioVigencia>" . $this->dataPhp($rModulo['InicioVigencia']) . "</InicioVigencia>\n";
                            $dadosXml.="<QteMensRetr>0</QteMensRetr>\n";
                            $dadosXml.="<FimVigencia>" . $this->dataPhp($r['FimVigencia']) . "</FimVigencia>\n";
                            $dadosXml.="</Modulos>\n"; #FECHA MODULO
                        }
                    }



                    $dadosXml.="<Modulos>\n"; #ABRE MODULO
                    $dadosXml.="<Codigo>" . $r['Codigo'] . "</Codigo>\n";
                    $dadosXml.="<DataBaseCob>" . $this->dataXml($r['InicioVigencia']) . "</DataBaseCob>\n";
                    $dadosXml.="<InicioVigencia>" . $this->dataXml($r['InicioVigencia']) . "</InicioVigencia>\n";
                    $dadosXml.="<QteMensRetr>0</QteMensRetr>\n";
                    if ($r['FimVigencia'] != '') {
                        $dadosXml.="<FimVigencia>" . $this->dataXml($r['FimVigencia']) . "</FimVigencia>\n";
                    }
                    $dadosXml.="</Modulos>\n"; #FECHA MODULO
                }
            }

            // SE FOR DEPENDENTE, PASSAR O TITULAR

            if ($row['RDP'] > 0) {
                $dadosXml.="<Titular>\n";
                $dadosXml.="<Codigo>" . $this->codcarteira($objcontrato['Codigo'], $row['Familia'], 0) . "</Codigo>\n";
                $dadosXml.="</Titular>\n";
            }


            //LOTACAO
            $lotacao = new Application_Model_DbTable_Lotacao();

            $select = $lotacao->select()
                    ->where('lote = ? ', $lote)
                    ->where('idBeneficiario = ?', $row['idBeneficiario']);

            $tab_lotacao = $lotacao->fetchall($select);

            $tabtemp = new Application_Model_DbTable_Unibeneficiario();

            foreach ($tab_lotacao as $local => $valores) {
                //VERIFICAR STATUS
                if ($valores['status'] == 1) {
                    // Troca o código autoid, pelo campo código		
                    /*
                      $select = $tabtemp->select();
                      $select ->setIntegrityCheck(false);
                      $select	->from(array('b' => 'lotacaocontrato'),array('Codigo'))
                      ->where('contrato = ?', $contrato )
                      ->where('AutoId = ?', $valores['Codigo'] );
                      $res_temp = $tabtemp->fetchAll($select);
                      if ( count($res_temp) == 1 ){
                     */
                    if ($valores['Codigo'] != null || $valores['Codigo'] != '') {
                        $dadosXml.="<Lotacao>\n"; #ABRE LOTACAO
                        $dadosXml.="<Codigo>" . $valores['Codigo'] . "</Codigo>\n";
                        $dadosXml.="<InicioVigencia>" . $this->dataXml($valores['InicioVigencia']) . "</InicioVigencia>\n";
                        if ($valores['FimVigencia'] != '' || $valores['FimVigencia'] != null)
                            $dadosXml.="<FimVigencia>" . $this->dataXml($valores['FimVigencia']) . "</FimVigencia>\n";
                        $dadosXml.="</Lotacao>\n"; #FECHA LOTACAO
                    }
                }
                //}
            }

            //LOCAL DE ATENDIMENTO DO BENEFICIARIO
            $LocalAtendimento = new Application_Model_DbTable_LocalAtendimento();

            $select = $LocalAtendimento->select()
                    ->where('lote = ? ', $lote)
                    ->where('idBeneficiario = ?', $row['idBeneficiario']);

            $tab_localAtendimento = $LocalAtendimento->fetchall($select);
            //VERIFICAR STATUS		
            foreach ($tab_localAtendimento as $local => $valores) {
                if ($valores['status'] == 1) {
                    if ($valores['Codigo'] != '') {
                        
                        $unipessoa = new application_model_DbTable_Unipessoa();
                        
                        $select = $unipessoa->select();
                        $select ->setIntegrityCheck(false);
                        $select ->from(array('pes' =>'Pessoa'),array())
                                ->join(array('pse' =>'PrestadorServico'), 'pes.autoid = pse.pessoa',array())
                                ->join(array('nre' =>'negociacaorepasse'), 'nre.lcat = pse.autoid',array('tipo'))
                                ->where('nre.contrato = ?', $row['Contrato'])
                                ->where('pse.codigo = ?', $valores['Codigo']);
                        
                        $resultado = $unipessoa->fetchAll($select)->current();
                        
                        $dadosXml.="<LocalAtendimento>\n"; #ABRE LOCAL ATENDIMENTO
                        $dadosXml.="<LcAt>" . $valores['Codigo'] . "</LcAt>\n";
                        $dadosXml.="<Tipo>". $resultado['tipo']."</Tipo>\n";
                        $dadosXml.="<InicioVigencia>" . $this->dataXml($valores['InicioVigencia']) . "</InicioVigencia>\n";
                        if ($valores['FimVigencia'] != '')
                            $dadosXml.="<FimVigencia>" . $this->dataXml($valores['FimVigencia']) . "</FimVigencia>\n";
                        $dadosXml.="</LocalAtendimento>\n"; #FECHA LOCAL ATENDIMENTO
                    }
                }
            }

            $dadosXml.= "</AtualizacaoCompleta> \n";  #FECHA O AtualizacaoCompleta
        }//FECHA LAÇO DO FOREACH




        $dadosXml.= "</MovimentacaoCadastralAtualizacaoCompleta>"; // FECHA NÓ PAI PRINCIPAL
        //GRAVA
        file_put_contents(APPLICATION_PATH . '/xml/uniweb_' . $lote . ".xml", $dadosXml);
        $this->view->nomeXml = APPLICATION_PATH . '/xml/uniweb_' . $lote . ".xml";

        $this->view->lote = $lote;

        // ALTERA STATUS DO LOTE PARA 0 
        $tab_lote = new Application_Model_DbTable_Lote();

        $atualizaLote = array("status" => 0);
        $where = "AutoId = " . $lote;

        $tab_lote->update($atualizaLote, $where);


        // ALTERA STATUS DO BENEFICIARIO PARA 0 
        $atualizaBeneficiario = array("status" => 0);
        $where = "lote = " . $lote;

        $beneficiario->update($atualizaBeneficiario, $where);
    }

    public function baixarAction() {

        $request = $this->getRequest();
        $lote = $request->getParam('lote');
        header("Content-Disposition:attachment;filename=uniweb_$lote.xml");
        header("Content-Type:text/xml");
        readfile(APPLICATION_PATH . '/xml/uniweb_' . $lote . ".xml");
        exit;
    }

    public function xmlantigoAction() {

        $xml = new Application_Model_DbTable_Lote();

        $select = $xml->select();
        $select->setIntegrityCheck(false);
        $select->from(array('l' => 'lote'), array('*'))
                ->join(array('e' => 'empresa'), 'l.idLogin = e.id', array('*'))
                ->where('status = ? ', 0);

        //$this->view->xml = $xml->fetchall($select);



        $tab = $xml->fetchall($select);

        if ($tab->count() == 0) {
            // $rows[] = array('sem xml');
            // $this->view->json = json_encode($rows);
        } else {
            //PEGANDO TODOS OS DADOS AQUI JA PASSO LINKS DE GERAR XML E PDF 
            foreach ($tab as $id => $row) {
                $rows[] = array(
                    $row['AutoId'],
                    $row['contrato'],
                    $row['status'],
                    $this->dataPhp($row['dt_lote']),
                    '/xml/gerar/lote/' . $row['AutoId'],
                    '/pdf/xml/lote/' . $row['AutoId'] . '/contrato/' . $row['contrato'],
                );
            }

            //ESCREVENDO JSON
            $this->view->json = json_encode($rows);

            //echo json_encode($rows);
            //exit;
        }
    }

    public function paginacaoAction() {

        $xml = new Application_Model_DbTable_Lote();

        $select = $xml->select();
        $select->setIntegrityCheck(false);
        $select->from(array('l' => 'lote'), array('*'))
                ->join(array('e' => 'empresa'), 'l.idLogin = e.id', array('*'))
                ->where('status = ? ', 1);

        //$this->view->xml = $xml->fetchall($select);



        $tab = $xml->fetchall($select);

        //PEGANDO TODOS OS DADOS AQUI JA PASSO LINKS DE GERAR XML E PDF 

        foreach ($tab as $id => $row) {
            $rows[] = array(
                $row['AutoId'],
                $row['contrato'],
                $row['status'],
                $this->dataPhp($row['dt_lote']),
                '/xml/gerar/' . $row['AutoId'],
                '/pdf/xml/lote/' . $row['AutoId'] . '/contrato/' . $row['contrato'],
            );
        }

        //ESCREVENDO JSON
        $this->view->json = json_encode($rows);

        //echo json_encode($rows);
        //exit;
    }

    public function logsAction() {
        //TELA PARA LIMPAR E VER LOGS NA BASE CARDIO NECESSÁRIO CRIAR O MODULO
        $logs = new Application_Model_DbTable_Unilogimportbenef();

        $select = $logs->select();
        $select->order('AutoId desc');

        $this->view->logs = $logs->fetchAll($select);
    }

    public function dellogAction() {
        $logs = new Application_Model_DbTable_Unilogimportbenef();

        $request = $this->getRequest();

        $id = $request->getParam('id');

        if ($id == "tudo") {
            // echo "VAMOS LIMPAR A BASE TODA";
            // exit;
            $logs->delete();
        } else {
            $where = "AutoId = " . $id;
            // echo "VAMOS EXECUTAR APENAS ESSE WHERE -> ". $where;
            // exit;

            $logs->delete($where);
        }

        $this->_redirect('/xml/logs');
    }

}

?>