<?php

/**

 * BeneficiarioController

 * @version 

 */
require_once 'Zend/Controller/Action.php';

class BeneficiarioController extends Zend_Controller_Action {

    private function soNumero($str) {
        return preg_replace("/[^0-9]/", "", $str);
    }
    
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
    
    /* 0010362000717006,
      0010362000844008,
     */
    public function unimedAction(){
        
        $sql="SELECT  
CTR.Codigo                      AS Codigo,
BNF.RDP                         AS RDP,
BNF.Familia                     AS Familia,
BNF.AutoId                      AS AutoId,
BNF.Codigo                      AS Codcarteira,
convert(varchar,BNF.InicioVigencia,103) + ' 00:00:00'              AS InicioVigencia,
'N'                             AS IncluidoComoRN,   
ISNULL(BNF.GrauDependencia,'0') AS GrauDependencia,
PES.Nome                        AS Nome,
PES.Tipo                        AS TipoPessoa,
convert(varchar,PES.DataNascimento,103) + ' 00:00:00'              AS DataNascimento,
PES.Sexo                        AS Sexo,
PES.Cnp                         as Cnp,
PES.EstadoCivil                 AS EstadoCivil,
PES.NomePai                     AS NomePai,
PES.NomeMae                     AS NomeMae,
REP.Numero                      AS Registro,
REP.Tipo                        AS TipoRegistro,
ENP.Seq                         AS SeqEnd,
ENP.NumLogradouro               AS NumLogradouro,
ENP.Logradouro                  AS NomeLogradouro,
ENP.ComplLogradouro             AS ComplLogradouro,
ENP.Bairro                      AS Bairro,
ENP.Cidade                      AS Cidade,
ENP.CEP                         AS CEP,
ENP.Tipo                        AS TipoEndereco,
convert(varchar,ENP.InicioVigencia,103) + ' 00:00:00'              AS InicioVigenciaEnd,
convert(varchar,ENP.FimVigencia,103)   + ' 00:00:00'               AS FimVigenciaEnd,

TEP.Seq                         AS SeqTel,
TEP.Tipo                        AS TipoTel,
TEP.DDD                         AS DDD,
TEP.Numero                      AS Numero,
convert(varchar,TEP.InicioVigencia,103) + ' 00:00:00'              AS InicioVigenciaTel,
convert(varchar,TEP.FimVigencia,103) + ' 00:00:00'                 AS FimVIgenciaTel,

convert(varchar,MOB.DataBaseCob,103) + ' 00:00:00'       AS DataBaseCobO,
convert(varchar,MOB.InicioVigencia,103) + ' 00:00:00'    AS InicioVigenciaO,
'11/07/2011 00:00:00'           AS FimVigenciaO,

MOP.Codigo                      AS CodigoModulo,

'0010362FN'                     AS ModuloD,
'12/07/2011 00:00:00'           AS DataBaseCobD,
'12/07/2011 00:00:00'           AS InicioVigenciaD,
NULL                            AS FimVigenciaD

FROM       Beneficiario       AS BNF  WITH (NOLOCK)
INNER JOIN Contrato           AS CTR  WITH (NOLOCK) ON CTR.AutoId = BNF.Contrato
INNER JOIN Pessoa             AS PES  WITH (NOLOCK) ON PES.AutoId = BNF.Pessoa
INNER JOIN ModuloBeneficiario AS MOB  WITH (NOLOCK) ON MOB.Beneficiario = BNF.AutoId AND MOB.Modulo = 379
INNER JOIN ModuloOperadora    AS MOP  WITH (NOLOCK) ON MOP.AUTOID = MOB.MODULO
INNER JOIN RegistroPessoa     AS REP  WITH (NOLOCK) ON REP.Pessoa = PES.AutoId AND REP.Tipo = 1
AND REP.TelosRgDt = (SELECT MAX(REP2.TelosRgDt) 
                     FROM RegistroPessoa AS REP2 WITH (NOLOCK) 
                     WHERE REP.Pessoa = REP2.Pessoa
                     AND   REP2.Tipo = 1)
LEFT  JOIN EnderecoPessoa     AS ENP  WITH (NOLOCK) ON ENP.Pessoa = PES.AutoId AND ENP.Tipo = 1
AND ENP.FimVigencia is null AND ENP.InicioVigencia = 
(SELECT MAX(ENP2.InicioVigencia) 
FROM EnderecoPessoa AS ENP2 WITH (NOLOCK)
WHERE ENP2.Pessoa = PES.AutoId
AND ENP2.Tipo = 1
AND ENP2.FimVigencia IS NULL)
LEFT  JOIN TelefonePessoa     AS TEP WITH (NOLOCK) ON TEP.Endereco = ENP.AutoId 
WHERE BNF.Codigo IN
(
0010362000718002,
0010362000719009,
0010362000720007,
0010362000721003,
0010362000722000,
0010362000723006,
0010362000724002,
0010362000725009,
0010362000726005,
0010362000727001,
0010362000728008,
0010362000729004,
0010362000730002,
0010362000731009,
0010362000732005,
0010362000733001,
0010362000734008,
0010362000735004,
0010362000736000,
0010362000737007,
0010362000738003,
0010362000739000,
0010362000740008,
0010362000741004,
0010362000742000,
0010362000743007,
0010362000744003,
0010362000745000,
0010362000746006,
0010362000747002,
0010362000748009,
0010362000749005,
0010362000750003,
0010362000751000,
0010362000752006,
0010362000753002,
0010362000754009,
0010362000755005,
0010362000756001,
0010362000757008,
0010362000758004,
0010362000759000,
0010362000760009,
0010362000761005,
0010362000762001,
0010362000763008,
0010362000764004,
0010362000765000,
0010362000766007,
0010362000767003,
0010362000768000,
0010362000769006,
0010362000770004,
0010362000771000,
0010362000772007,
0010362000773003,
0010362000774000,
0010362000775006,
0010362000776002,
0010362000777009,
0010362000778005,
0010362000779001,
0010362000780000,
0010362000781006,
0010362000782002,
0010362000783009,
0010362000784005,
0010362000785001,
0010362000786008,
0010362000787004,
0010362000788000,
0010362000789007,
0010362000790005,
0010362000791001,
0010362000792008,
0010362000793004,
0010362000794000,
0010362000795007,
0010362000796003,
0010362000797000,
0010362000798006,
0010362000799002,
0010362000800000,
0010362000801007,
0010362000802003,
0010362000803000,
0010362000804006,
0010362000805002,
0010362000806009,
0010362000807005,
0010362000808001,
0010362000809008,
0010362000810006,
0010362000811002,
0010362000812009,
0010362000813005,
0010362000814001,
0010362000815008,
0010362000816004,
0010362000817000,
0010362000818007,
0010362000819003,
0010362000820001,
0010362000821008,
0010362000822004,
0010362000823000,
0010362000824007,
0010362000825003,
0010362000826000,
0010362000827006,
0010362000828002,
0010362000829009,
0010362000830007,
0010362000831003,
0010362000832000,
0010362000833006,
0010362000834002,
0010362000835009,
0010362000836005,
0010362000837001,
0010362000838008,
0010362000839004,
0010362000840002,
0010362000841009,
0010362000842005,
0010362000843001,
0010362000717006,
0010362000844008,
0010362000845004,
0010362000846000,
0010362000847007,
0010362000848003,
0010362000849000,
0010362000850008,
0010362000851004,
0010362000852000,
0010362000853007,
0010362000854003,
0010362000855000,
0010362000856006,
0010362000857002,
0010362000858009,
0010362000859005,
0010362000860003,
0010362000861000,
0010362000862006,
0010362000863002,
0010362000864009,
0010362000865005,
0010362000866001,
0010362000867008,
0010362000868004,
0010362000869000,
0010362000870009,
0010362000871005,
0010362000872001,
0010362000873008,
0010362000874004,
0010362000875000,
0010362000876007,
0010362000877003,
0010362000878000,
0010362000879006,
0010362000880004,
0010362000881000,
0010362000882007,
0010362000883003,
0010362000884000,
0010362000885006,
0010362000886002,
0010362000887009,
0010362000888005,
0010362000889001,
0010362000890000,
0010362000891006,
0010362000892002,
0010362000893009,
0010362000894005,
0010362000895001,
0010362000896008,
0010362000897004,
0010362000898000,
0010362000899007,
0010362000900005,
0010362000901001,
0010362000902008,
0010362000903004,
0010362000904000,
0010362000905007,
0010362000906003,
0010362000907000,
0010362000908006,
0010362000909002,
0010362000910000,
0010362000911007,
0010362000912003,
0010362000913000,
0010362000914006,
0010362000915002,
0010362000916009,
0010362000917005,
0010362000918001,
0010362000919008,
0010362000920006,
0010362000921002,
0010362000922009,
0010362000923005,
0010362000924001,
0010362000925008,
0010362000926004,
0010362000927000,
0010362000928007,
0010362000929003,
0010362000930001,
0010362000931008,
0010362000932004,
0010362000933000,
0010362000934007,
0010362000935003,
0010362000936000,
0010362000937006,
0010362000938002,
0010362000939009,
0010362000940007,
0010362000941003,
0010362000942000,
0010362000943006)
";
        
        $this->_db = Zend_Registry::get('dbcardio');
        $result = $this->_db->fetchAll($sql);
        
        $dadosXml = "<?xml version='1.0' standalone='yes'?>\n";
        $dadosXml.= "<MovimentacaoCadastralAtualizacaoCompleta xmlns='MovimentacaoCadastralAtualizacaoCompleta.xsd'>\n"; //ABRE NÓ PAI PRINCIPAL
        
        foreach ($result as $key => $row) {
            $dadosXml.= "<AtualizacaoCompleta>\n"; #CRIA O LOTE     
            //GERANDO XML  PARTIR DOS DADOS ACIMA
            //TEM QUE PEGAR O CONTRATO
            $dadosXml.="<Contrato>" . $row['Codigo'] . "</Contrato>\n"; #CODIGO DO BENEFICIARIO 		 		
            $dadosXml.="<RDP>" . $row['RDP'] . "</RDP>\n "; #RDP
            $dadosXml.="<Familia>" . $row['Familia'] . "</Familia>\n "; #CODIGO DA FAMILIA

            //$dadosXml.="<IncluidoComoRN>".$this->true_ou_false($row['IncluidoComoRN'])."</IncluidoComoRN>\n"; #INCLUINDO COM RN
            $dadosXml.="<IncluidoComoRN>false</IncluidoComoRN>\n"; #INCLUINDO COM RN
            $dadosXml.="<GrauDependencia>" . $this->graudependencia($row['RDP']) . "</GrauDependencia>\n"; #GrauDependencia
            $dadosXml.="<InicioVigencia>" . $row['InicioVigencia'] . "</InicioVigencia>\n "; #Inicio de vigencia 
            $dadosXml.="<CodigoExterno>" . $row['Codcarteira']. "</CodigoExterno>\n"; #NAO SABEMOS COMO PEGAR ESSE CODIGO

            $dadosXml.="<Pessoa>\n"; #INICIA PESSOA
            $dadosXml.="<Nome>" . $row['Nome'] . "</Nome>\n";
            $dadosXml.="<DataNascimento>" . $row['DataNascimento'] . "</DataNascimento>\n";
            $dadosXml.="<Cnp>" . $row['Cnp'] . "</Cnp>\n";
            $dadosXml.="<Tipo>2</Tipo>\n";
            $dadosXml.="<Sexo>" . strtolower($row['Sexo']) . "</Sexo>\n";
            $dadosXml.="<EstadoCivil>" . $row['EstadoCivil'] . "</EstadoCivil>\n";
            $dadosXml.="<NomePai>Nao Informado</NomePai>\n";
            $dadosXml.="<NomeMae>" . $row['NomeMae'] . "</NomeMae>\n";

            $dadosXml.="<Invalidez>false</Invalidez>\n";
						
                    $dadosXml.="<Endereco>\n"; #INICIA ENDEREÇO DA PESSOA
                    $dadosXml.="<Seq>" . $row['SeqEnd'] . "</Seq>\n";
                    if ($row['NumLogradouro'] != '')
                        $dadosXml.="<NumLogradouro>" . $row['NumLogradouro'] . "</NumLogradouro>\n";

                    $dadosXml.="<NomeLogradouro>" . $row['NomeLogradouro'] . "</NomeLogradouro>\n";
                    $dadosXml.="<Bairro>" . $row['Bairro'] . "</Bairro>\n";
                    $dadosXml.="<Cidade>" . $row['Cidade'] . "</Cidade>\n";
                    $dadosXml.="<Cep>" . $this->soNumero($row['CEP']) . "</Cep>\n";

                    $dadosXml.="<Tipo>" . ($row['TipoEndereco'] == "" ? "1" : $row['TipoEndereco']) . "</Tipo>\n";
                    $dadosXml.="<ParaCorrespondencia>true</ParaCorrespondencia>\n";
                    $dadosXml.="<ParaCobranca>true</ParaCobranca>\n";
                    $dadosXml.="<ParaFaturamento>true</ParaFaturamento>\n";
                    $dadosXml.="<ParaPublicacao>true</ParaPublicacao>\n";
                    $dadosXml.="<InicioVigencia>" . $row['InicioVigenciaEnd'] . "</InicioVigencia>\n";
                    $dadosXml.="<FimVigencia>" . $row['FimVigenciaEnd'] . "</FimVigencia>\n";
                    $dadosXml.="</Endereco>\n"; #FECHA ENDEREÇO DA PESSOA
            $dadosXml.="</Pessoa>\n "; #FECHA PESSOA

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
                            $dadosXml.="<DataBaseCob>" . $this->dataPhp($rModulo['InicioVigencia'])." 00:00:00" . "</DataBaseCob>\n";
                            $dadosXml.="<InicioVigencia>" . $this->dataPhp($rModulo['InicioVigencia'])." 00:00:00" . "</InicioVigencia>\n";
                            $dadosXml.="<QteMensRetr>0</QteMensRetr>\n";
                            $dadosXml.="<FimVigencia>" . $row['FimVigenciaO'] . "</FimVigencia>\n";
                            $dadosXml.="</Modulos>\n"; #FECHA MODULO
                        }



                    $dadosXml.="<Modulos>\n"; #ABRE MODULO
                    $dadosXml.="<Codigo>" . $row['CodigoModulo'] . "</Codigo>\n";
                    $dadosXml.="<DataBaseCob>" . $row['InicioVigenciaO'] . "</DataBaseCob>\n";
                    $dadosXml.="<InicioVigencia>" . $row['InicioVigenciaO'] . "</InicioVigencia>\n";
                    $dadosXml.="<QteMensRetr>0</QteMensRetr>\n";
                    if ($row['FimVigenciaO'] != '') {
                        $dadosXml.="<FimVigencia>" . $row['FimVigenciaO'] . "</FimVigencia>\n";
                    }
                    $dadosXml.="</Modulos>\n"; #FECHA MODULO
                    
                    $dadosXml.="<Modulos>\n"; #ABRE MODULO
                    $dadosXml.="<Codigo>" . $row['ModuloD'] . "</Codigo>\n";
                    $dadosXml.="<DataBaseCob>" . $row['InicioVigenciaD'] . "</DataBaseCob>\n";
                    $dadosXml.="<InicioVigencia>" . $row['InicioVigenciaD'] . "</InicioVigencia>\n";
                    $dadosXml.="<QteMensRetr>0</QteMensRetr>\n";
                    $dadosXml.="</Modulos>\n"; #FECHA MODULO
                    
            $dadosXml.= "</AtualizacaoCompleta> \n";  #FECHA O AtualizacaoCompleta
        }//FECHA LAÇO DO FOREACH
        
        $dadosXml.= "</MovimentacaoCadastralAtualizacaoCompleta>"; // FECHA NÓ PAI PRINCIPAL
        
        file_put_contents(APPLICATION_PATH . '/xml/uniweb_alteracaoModulo.xml', $dadosXml);
        header("Content-Disposition:attachment;filename=uniweb_alteracaoModulo.xml");
        header("Content-Type:text/xml");
        readfile(APPLICATION_PATH . '/xml/uniweb_alteracaoModulo.xml');
        exit;
        
    }
    var $vRdp = array("1" => "1 - Conjuge",
        "2" => "2 - Companheiro(a)",
        "10" => "10 - Filho",
        "11" => "11 - Filho",
        "12" => "12 - Filho",
        "13" => "13 - Filho",
        "14" => "14 - Filho",
        "15" => "15 - Filho",
        "16" => "16 - Filho",
        "17" => "17 - Filho",
        "18" => "18 - Filho",
        "19" => "19 - Filho",
        "20" => "20 - Filho",
        "21" => "21 - Filho",
        "22" => "22 - Filho",
        "23" => "23 - Filho",
        "24" => "24 - Filho",
        "25" => "25 - Filho",
        "26" => "26 - Filho",
        "27" => "27 - Filho",
        "28" => "28 - Filho",
        "29" => "29 - Filho",
        "30" => "30 - Filha",
        "31" => "31 - Filha",
        "32" => "32 - Filha",
        "33" => "33 - Filha",
        "34" => "34 - Filha",
        "35" => "35 - Filha",
        "36" => "36 - Filha",
        "37" => "37 - Filha",
        "38" => "38 - Filha",
        "39" => "39 - Filha",
        "40" => "40 - Filha",
        "41" => "41 - Filha",
        "42" => "42 - Filha",
        "43" => "43 - Filha",
        "44" => "44 - Filha",
        "45" => "45 - Filha",
        "46" => "46 - Filha",
        "47" => "47 - Filha",
        "48" => "48 - Filha",
        "49" => "49 - Filha",
        "50" => "50 - Pai",
        "51" => "51 - Mãe",
        "52" => "52 - Sogro",
        "53" => "53 - Sogra",
        "60" => "60 - Outra dependência",
        "61" => "61 - Outra dependência",
        "62" => "62 - Outra dependência",
        "63" => "63 - Outra dependência",
        "64" => "64 - Outra dependência",
        "65" => "65 - Outra dependência",
        "66" => "66 - Outra dependência",
        "67" => "67 - Outra dependência",
        "68" => "68 - Outra dependência",
        "69" => "69 - Outra dependência",
        "70" => "70 - Filho adotivo",
        "71" => "71 - Filho adotivo",
        "72" => "72 - Filho adotivo",
        "73" => "73 - Filho adotivo",
        "74" => "74 - Filho adotivo",
        "75" => "75 - Filho adotiva",
        "76" => "76 - Filho adotiva",
        "77" => "77 - Filho adotiva",
        "78" => "78 - Filho adotiva",
        "79" => "79 - Filho adotiva",
        "80" => "80 - Irmão(ã)",
        "81" => "81 - Irmão(ã)",
        "82" => "82 - Irmão(ã)",
        "83" => "83 - Irmão(ã)",
        "84" => "84 - Irmão(ã)",
        "85" => "85 - Irmão(ã)",
        "86" => "86 - Irmão(ã)",
        "87" => "87 - Irmão(ã)",
        "88" => "88 - Irmão(ã)",
        "89" => "89 - Irmão(ã)",
        "90" => "90 - Agregado",
        "91" => "91 - Agregado",
        "92" => "92 - Agregado",
        "93" => "93 - Agregado",
        "94" => "94 - Agregado",
        "95" => "95 - Agregado",
        "96" => "96 - Agregado",
        "97" => "97 - Agregado",
        "98" => "98 - Agregado",
        "99" => "99 - Agregado");

    private function verificaContrato($contratoBene, $contrato) {
        /* PARA VERIFICAR ESSE O ID QUE A PESSOA DIGITOU É VALIDO PARA ESSE CONTRATO */
        if ($contratoBene == null or $contratoBene['Contrato'] != $contrato) {
            $this->_redirect('/principal');
            exit;
        }
    }

    private function verificaId($id) {
        if (!is_numeric($id) or trim($id) == '' or strlen($id) > 10) {
            $this->_redirect('/principal');
            exit;
        }
    }

    private function nomeRDP($rdp) {

        if ($rdp == 0) {
            return "Titular";
        }
        if ($rdp == 1) {
            return "Conjuge";
        }
        if ($rdp == 2) {
            return "Companheiro(a)";
        }
        if ($rdp >= 10 and $rdp <= 29) {
            return "Filho";
        }
        if ($rdp >= 30 and $rdp <= 49) {
            return "Filha";
        }
        if ($rdp == 50) {
            return "Pai";
        }
        if ($rdp == 51) {
            return "Mae";
        }
        if ($rdp == 52) {
            return "Sogro";
        }
        if ($rdp == 53) {
            return "Sogra";
        }
        if ($rdp >= 60 and $rdp <= 69) {
            return "Outra Dependencia";
        }
        if ($rdp >= 70 and $rdp <= 74) {
            return "Filho Adotivo";
        }
        if ($rdp >= 75 and $rdp <= 79) {
            return "Filho Adotiva";
        }
        if ($rdp >= 80 and $rdp <= 89) {
            return "Irmao(a)";
        }
        if ($rdp >= 90 and $rdp <= 99) {
            return "Agregado";
        }
    }

    private function removeAcento($string) {
        $return = strtr($string, "ŠŒŽšœžŸ¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ?!:;,/#$%¨&*(){}[]<>~º|\" \\", "SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy                            "
        );

        return $return;
    }

    private function removePonto($string) {
        $a = array('.', '-');
        return str_replace($a, '', $string);
        //return preg_replace( '#[^0-9]#', '', $string );
    }

    private function codigoDependencia($grau) {
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

    private function formataData($data) {

        if ($data == "") {
            return null;
        } else {

            $ano = substr($data, 6, 4);
            $mes = substr($data, 3, 2);
            $dia = substr($data, 0, 2);
            return ($ano . "-" . $mes . "-" . $dia);
        }
    }

    private function subDayIntoDate($date, $days) {
        $thisyear = substr($date, 6, 4);
        $thismonth = substr($date, 3, 2);
        $thisday = substr($date, 0, 2);
        $nextdate = mktime(0, 0, 0, $thismonth, $thisday - $days, $thisyear);
        return strftime("%Y%m%d", $nextdate);
    }

    private function dataSql($data) {
        if ($data == "")
            return null;
        else {
            $date = DateTime::createFromFormat('d/m/Y', $data);
            return $date->format('Y-m-d');
        }
    }

    private function dataPhp($data) {
        if ($data != NULL) {
            return date('d/m/Y', strtotime($data));
        }
    }

    private function pegaDepe($contrato, $familia) {
        $beneficiarioCardio = new Application_Model_DbTable_Unibeneficiario();

        /* SELECT PARA PEGAR TODOS OS DEPENDETES DO TITULAR */
        $select = $beneficiarioCardio->select();
        $select->setIntegrityCheck(false);
        $select->from(array('b' => 'beneficiario'), array('*'))
                ->join(array('c' => 'contrato'), 'b.contrato = c.autoid', array())
                ->where('c.autoid = ?', $contrato)
                ->where('b.familia = ?', $familia)
                ->where('b.rdp <> 0');

        return $depe = $beneficiarioCardio->fetchall($select);
    }

    private function novaFamilia($contrato) {
        // Tabela Unimed
        $beneficiarioCardio = new Application_Model_DbTable_Unibeneficiario();
        $select = $beneficiarioCardio->select();

        $select->from(array('b' => 'Beneficiario'), array('max(familia) as familia'))
                ->where('b.contrato = ? and familia<>999999', $contrato);

        $tab = $beneficiarioCardio->fetchAll($select);
        $tab = $tab->current();

        $familia = $tab['familia'];

        // Tabela Local 
        $beneficiario = new Application_Model_DbTable_Beneficiario();
        $select = $beneficiario->select();

        $select->from(array('b' => 'beneficiario'), array('max(familia) as familia'))
                ->where('b.contrato = ? and familia<>999999', $contrato);

        $tab = $beneficiario->fetchAll($select);
        $tab = $tab->current();

        $familia = $familia >= $tab['familia'] ? $familia : $tab['familia'];

        $familia++;


        return $familia;
    }

    private function carregaEnderecoBenef($benef) {
        $tab = new Application_Model_DbTable_Unibeneficiario();
        $select = $tab->select();
        $select->setIntegrityCheck(false);
        $select->from(array('b' => 'Beneficiario'), array('*'))
                ->joinLeft(array('p' => 'Pessoa'), 'b.Pessoa = p.AutoId', array('*'))
                ->joinLeft(array('e' => 'EnderecoPessoa'), 'p.AutoId = e.Pessoa', array('*'))
                ->joinLeft(array('c' => 'CidadePais'), 'e.cidade = c.Codigo', array('Nome as NomeCidade', 'UF'))
                ->where('b.AutoId = ? ', $benef)
                ->where('e.FimVigencia is null');
        return $tab->fetchAll($select);
    }

    private function carregaModuloBenef($benef) {
        $tab = new Application_Model_DbTable_Unibeneficiario();
        $select = $tab->select();
        $select->setIntegrityCheck(false);
        $select->from(array('m' => 'ModuloBeneficiario'), array('InicioVigencia', 'FimVigencia', 'AutoId'))
                ->joinLeft(array('o' => 'ModuloOperadora'), 'm.modulo = o.AutoId', array('Nome', 'Codigo'))
                ->where('m.beneficiario = ? and m.fimvigencia is null and o.tipo=1', $benef);

        return $tab->fetchAll($select);
    }

    private function carregaModuloContrato($contrato) {
        $tab = new Application_Model_DbTable_Unibeneficiario();
        $select = $tab->select();
        $select->setIntegrityCheck(false);
        $select->from(array('b' => 'NegociacaoAqModulo'), array('*'))
                ->join(array('o' => 'ModuloOperadora'), 'b.modulo = o.AutoId', array('Nome', 'Codigo'))
                ->where('b.contrato = ? and b.fimvigencia is null and o.tipo=1', $contrato)
                ->where('b.fimvigencia is null');
        return $tab->fetchAll($select);
    }

    private function carregaDependentes($familia, $contrato) {
        $tab = new Application_Model_DbTable_Unibeneficiario();
        $select = $tab->select();
        $select->setIntegrityCheck(false);
        $select->from(array('b' => 'beneficiario'), array('*'))
                ->joinLeft(array('p' => 'pessoa'), 'b.Pessoa = p.AutoId', array('Nome'))
                ->where('Familia = ?', $familia)
                ->where('Contrato = ?', $contrato)
                ->where('RDP <> 0');

        return $tab->fetchall($select);
    }

    private function carregaLotacaoBenef($benef) {
        $tab = new Application_Model_DbTable_Unibeneficiario();
        $select = $tab->select();
        $select->setIntegrityCheck(false);
        $select->from(array('l' => 'LotacaoBeneficiario'), array('InicioVigencia', 'FimVigencia', 'AutoId'))
                ->joinLeft(array('c' => 'LotacaoContrato'), 'l.Lotacao = c.AutoId', array('Nome', 'Codigo'))
                ->where('l.beneficiario = ? and l.fimvigencia is null', $benef);

        return $tab->fetchAll($select);
    }

    private function carregaLotacaoContrato($contrato) {
        $tab = new Application_Model_DbTable_Unibeneficiario();
        $select = $tab->select();
        $select->setIntegrityCheck(false);
        $select->from(array('c' => 'LotacaoContrato'), array('*'))
                ->where('contrato = ?', $contrato)
                ->order('Nome');

        return $tab->fetchAll($select);
    }

    private function carregaLocalAtendimentoBene($benef) {
        $tab = new Application_Model_DbTable_Unibeneficiario();
        $select = $tab->select();
        $select->setIntegrityCheck(false);
        $select->from(array('n' => 'RepasseBeneficiario'), array('InicioVigencia', 'FimVigencia'))
                ->joinLeft(array('p' => 'PrestadorServico'), 'n.lcat = p.AutoId', array('Codigo'))
                ->joinLeft(array('s' => 'Pessoa'), 'p.Pessoa = s.AutoId', array('AutoId', 'NomeReduzido'))
                ->where('n.Beneficiario = ? and n.fimvigencia is null', $benef);

        return $tab->fetchAll($select);
    }

    private function carregaLocalAtendimentoContrato($contrato) {

        $tab = new Application_Model_DbTable_Unibeneficiario();
        $select = $tab->select();
        $select->setIntegrityCheck(false);
        $select->from(array('n' => 'NegociacaoRepasse'), array())
                ->join(array('p' => 'PrestadorServico'), 'n.lcat = p.AutoId', array('*'))
                ->join(array('s' => 'Pessoa'), 'p.Pessoa = s.AutoId', array('NomeReduzido'))
                ->where('n.contrato = ? ', $contrato)
                ->order('Nome');

        //echo $select; exit;
        return $tab->fetchAll($select);
    }

    private function carregaEmail() {

        $tab = new Application_Model_DbTable_Unibeneficiario();
        $select = $tab->select();
        $select->setIntegrityCheck(false);
        $select->from(array('n' => 'NegociacaoRepasse'), array())
                ->join(array('p' => 'PrestadorServico'), 'n.lcat = p.AutoId', array('*'))
                ->join(array('s' => 'Pessoa'), 'p.Pessoa = s.AutoId', array('NomeReduzido'))
                ->where('n.contrato = ? ', $contrato)
                ->order('Nome');

        return $tab->fetchAll($select);
    }

    private function carregaTelefone() {
        $tab = new Application_Model_DbTable_Unibeneficiario();
        $select = $tab->select();
        $select->setIntegrityCheck(false);
        $select->from(array('n' => 'NegociacaoRepasse'), array())
                ->join(array('p' => 'PrestadorServico'), 'n.lcat = p.AutoId', array('*'))
                ->join(array('s' => 'Pessoa'), 'p.Pessoa = s.AutoId', array('NomeReduzido'))
                ->where('n.contrato = ? ', $contrato)
                ->order('Nome');

        return $tab->fetchAll($select);
    }

    private function carregaBenef($autoId) {
        $benef = new Application_Model_DbTable_Beneficiario();
        $registro = new Application_Model_DbTable_Registro();
        $select = $benef->select()->where('lote is null and AutoId=?', $autoId);
        $lista = $benef->fetchAll($select);
        if ($lista->count() > 0) {
            $reg = $lista->current();
            /* REGISTRO */
            $select = $registro->select();
            $select->setIntegrityCheck(false);
            $select->where('idBeneficiario = ?', $reg['idBeneficiario']);

            $registro = $registro->fetchAll($select)->current();

            return array('Nome' => $reg['Nome'],
                'Contrato' => $reg['Contrato'],
                'Familia' => $reg['Familia'],
                'RDP' => $reg['RDP'],
                'InicioVigencia' => $reg['InicioVigencia'],
                'Sexo' => $reg['Sexo'],
                'DataNascimento' => $reg['DataNascimento'],
                'DataAdmissao' => $reg['DataAdmissao'],
                'EstadoCivil' => $reg['EstadoCivil'],
                'Naturalidade' => $reg['Naturalidade'],
                'Cnp' => $reg['Cnp'],
                'NomeMae' => $reg['NomeMae'],
                'NomePai' => $reg['NomePai'],
                'NomeConjuge' => $reg['NomeConjuge'],
                'NomeCidade' => $reg['NomeCidade'],
                'UF' => $reg['UF'],
                'Matricula' => $reg['Matricula'],
                'RG' => $registro['RG'],
                'PIS' => $registro['PIS'],
            // 'Titular'=>$reg['Titular']);
            );
        } else {
            $beneficiario = new Application_Model_DbTable_Unibeneficiario();
            $select = $beneficiario->select();
            $select->setIntegrityCheck(false);
            $select->from(array('b' => 'Beneficiario'), array('*'))
                    ->join(array('p' => 'Pessoa'), 'b.Pessoa = p.AutoId', array('p.DataNascimento', 'p.Cnp', 'p.Naturalidade', 'p.EstadoCivil', 'p.Nome', 'p.Sexo', 'p.NomeMae', 'p.NomePai', 'p.NomeConjuge'))
                    ->joinLeft(array('c' => 'CidadePais'), 'p.Naturalidade = c.Codigo', array('Nome as NomeCidade', 'UF'))
                    ->where('b.AutoId = ? ', $autoId);
            $tab = $beneficiario->fetchAll($select);
            $reg = $tab->current();

            /* PEGA O RG */
            $beneficiario = new Application_Model_DbTable_Unibeneficiario();
            $select = $beneficiario->select();
            $select->setIntegrityCheck(false);
            $select->from(array('b' => 'Beneficiario'), array())
                    ->join(array('p' => 'Pessoa'), 'b.Pessoa = p.AutoId', array())
                    ->joinLeft(array('r' => 'RegistroPessoa'), 'p.AutoId = r.pessoa', array('Tipo', 'Numero'))
                    ->where('b.AutoId = ? ', $autoId)
                    ->where('r.Tipo = 1');

            $tab = $beneficiario->fetchAll($select);
            $rg = $tab->current();

            /* PEGA O PIS */
            $beneficiario = new Application_Model_DbTable_Unibeneficiario();
            $select = $beneficiario->select();
            $select->setIntegrityCheck(false);
            $select->from(array('b' => 'Beneficiario'), array())
                    ->join(array('p' => 'Pessoa'), 'b.Pessoa = p.AutoId', array())
                    ->joinLeft(array('r' => 'RegistroPessoa'), 'p.AutoId = r.pessoa', array('Tipo', 'Numero'))
                    ->where('b.AutoId = ? ', $autoId)
                    ->where('r.Tipo = 9');

            $tab = $beneficiario->fetchAll($select);
            $pis = $tab->current();


            return array('Nome' => $reg['Nome'],
                'Contrato' => $reg['Contrato'],
                'Familia' => $reg['Familia'],
                'RDP' => $reg['RDP'],
                'InicioVigencia' => $reg['InicioVigencia'],
                'Sexo' => $reg['Sexo'],
                'DataNascimento' => $reg['DataNascimento'],
                'DataAdmissao' => $reg['DataAdmissao'],
                'EstadoCivil' => $reg['EstadoCivil'],
                'Naturalidade' => $reg['Naturalidade'],
                'Cnp' => $reg['Cnp'],
                'NomeMae' => $reg['NomeMae'],
                'NomePai' => $reg['NomePai'],
                'NomeConjuge' => $reg['NomeConjuge'],
                'Matricula' => $reg['Matricula'],
                'Titular' => $reg['Titular'],
                'NomeCidade' => $reg['NomeCidade'],
                'UF' => $reg['UF'],
                'RG' => $rg['Numero'],
                'PIS' => $pis['Numero'],
            );
        }
    }

    private function puxaBenef($autoId) {

        $benef = new Application_Model_DbTable_Beneficiario();
        $telefone = new Application_Model_DbTable_Telefone();
        $endereco = new Application_Model_DbTable_Endereco();
        $email = new Application_Model_DbTable_Email();
        $modulo = new Application_Model_DbTable_Modulo();
        $local = new Application_Model_DbTable_LocalAtendimento();
        $lotacao = new Application_Model_DbTable_Lotacao();
        $registro = new Application_Model_DbTable_Registro();

        $select = $benef->select()->where('lote is null and AutoId=?', $autoId);
        $lista = $benef->fetchAll($select);


        if ($lista->count() == 0) {
            /* SELECT NO BANCO DA UNIMED PARA PEGAR OS DADOS E COLOCAR NO NOSSO BANCO */
            $unibenef = new Application_Model_DbTable_Unibeneficiario();
            $select = $unibenef->select();
            $select->setIntegrityCheck(false);
            $select->from(array('b' => 'Beneficiario'), array('*'))
                    ->joinleft(array('p' => 'Pessoa'), 'b.Pessoa = p.AutoId', array('p.DataNascimento', 'p.Cnp', 'p.Naturalidade', 'p.EstadoCivil', 'p.Nome', 'p.Sexo', 'p.NomeMae', 'p.NomePai', 'p.NomeConjuge'))
                    ->joinleft(array('c' => 'CidadePais'), 'p.naturalidade = c.Codigo', array('Nome as NomeCidade', 'UF'))
                    ->where('b.AutoId = ? ', $autoId);

            $unibenef_tab = $unibenef->fetchAll($select);

            /* PEGA O RG */
            $beneficiario = new Application_Model_DbTable_Unibeneficiario();
            $select = $beneficiario->select();
            $select->setIntegrityCheck(false);
            $select->from(array('b' => 'Beneficiario'), array())
                    ->join(array('p' => 'Pessoa'), 'b.Pessoa = p.AutoId', array())
                    ->joinLeft(array('r' => 'RegistroPessoa'), 'p.AutoId = r.pessoa', array('Tipo', 'Numero'))
                    ->where('b.AutoId = ? ', $autoId)
                    ->where('r.Tipo = 1');

            $tab = $beneficiario->fetchAll($select);
            $rg = $tab->current();

            /* PEGA O PIS */
            $beneficiario = new Application_Model_DbTable_Unibeneficiario();
            $select = $beneficiario->select();
            $select->setIntegrityCheck(false);
            $select->from(array('b' => 'Beneficiario'), array())
                    ->join(array('p' => 'Pessoa'), 'b.Pessoa = p.AutoId', array())
                    ->joinLeft(array('r' => 'RegistroPessoa'), 'p.AutoId = r.pessoa', array('Tipo', 'Numero'))
                    ->where('b.AutoId = ? ', $autoId)
                    ->where('r.Tipo = 9');

            $tab = $beneficiario->fetchAll($select);
            $pis = $tab->current();

            /* SELECT NO BANCO DA UNIMED PARA PEGAR O TELEFONE */
            $unibenef = new Application_Model_DbTable_Unibeneficiario();
            $select = $unibenef->select();
            $select->setIntegrityCheck(false);
            $select->from(array('b' => 'Beneficiario'), array())
                    ->joinleft(array('p' => 'Pessoa'), 'b.Pessoa = p.AutoId', array())
                    ->joinleft(array('t' => 'TelefonePessoa'), 't.pessoa = p.autoid', array('*'))
                    ->joinleft(array('e' => 'EnderecoPessoa'), 't.endereco = e.autoid', array('seq as SeqEnd'))
                    ->where('b.AutoId = ? ', $autoId);

            $telefoneUni = $unibenef->fetchAll($select);

            /* SELECT NO BANCO DA UNIMED PARA PEGAR O ENDERECO */
            $unibenef = new Application_Model_DbTable_Unibeneficiario();
            $select = $unibenef->select();
            $select->setIntegrityCheck(false);
            $select->from(array('b' => 'Beneficiario'), array())
                    ->join(array('p' => 'Pessoa'), 'b.Pessoa = p.AutoId', array())
                    ->joinleft(array('e' => 'EnderecoPessoa'), 'e.pessoa = p.autoid', array('*'))
                    ->joinleft(array('c' => 'CidadePais'), 'e.cidade = c.Codigo', array('Nome as NomeCidade', 'UF'))
                    ->where('b.AutoId = ? ', $autoId);

            $enderecoUni = $unibenef->fetchAll($select);

            /* SELECT NO BANCO DA UNIMED PARA PEGAR O EMAIL */
            $unibenef = new Application_Model_DbTable_Unibeneficiario();
            $select = $unibenef->select();
            $select->setIntegrityCheck(false);
            $select->from(array('b' => 'Beneficiario'), array())
                    ->joinleft(array('p' => 'Pessoa'), 'b.Pessoa = p.AutoId', array())
                    ->joinleft(array('m' => 'EmailPessoa'), 'm.pessoa = p.autoid', array('*'))
                    ->where('b.AutoId = ? ', $autoId);

            $emailUni = $unibenef->fetchAll($select);

            /* SELECT DO MODULO */
            $tab = new Application_Model_DbTable_Unibeneficiario();
            $select = $tab->select();
            $select->setIntegrityCheck(false);
            $select->from(array('m' => 'ModuloBeneficiario'), array('*'))
                    ->joinLeft(array('o' => 'ModuloOperadora'), 'm.modulo = o.AutoId', array('*'))
                    ->where('m.beneficiario = ? and m.fimvigencia is null and o.tipo=1', $autoId);

            $moduloUni = $tab->fetchAll($select);

            /* SELECT DO LOCAL DE ATENDIMENTO */
            $tab = new Application_Model_DbTable_Unibeneficiario();
            $select = $tab->select();
            $select->setIntegrityCheck(false);
            $select->from(array('b' => 'Beneficiario'), array())
                    ->joinLeft(array('n' => 'RepasseBeneficiario'), 'b.autoId = n.beneficiario', array('InicioVigencia', 'FimVigencia'))
                    ->joinLeft(array('p' => 'PrestadorServico'), 'n.lcat = p.AutoId', array('Codigo'))
                    ->joinLeft(array('s' => 'Pessoa'), 'p.Pessoa = s.AutoId', array('AutoId', 'NomeReduzido'))
                    ->where('b.autoid = ? and n.fimvigencia is null', $autoId);

            //echo $select; exit;
            $localUni = $tab->fetchAll($select);



            /* SELECT DA LOTACAO */
            $tab = new Application_Model_DbTable_Unibeneficiario();
            $select = $tab->select();
            $select->setIntegrityCheck(false);
            $select->from(array('b' => 'Beneficiario'), array())
                    ->joinLeft(array('l' => 'LotacaoBeneficiario'), 'b.autoid = l.beneficiario', array('InicioVigencia', 'FimVigencia', 'AutoId'))
                    ->joinLeft(array('c' => 'LotacaoContrato'), 'l.Lotacao = c.AutoId', array('Nome', 'Codigo'))
                    ->where('b.autoid = ? and l.fimvigencia is null', $autoId);

            $lotacaoUni = $tab->fetchAll($select);

            $reg = $unibenef_tab->current();

            $inserir = array("AutoId" => $reg['AutoId'],
                "contrato" => $reg['Contrato'],
                "familia" => $reg['Familia'],
                "rdp" => $reg['RDP'],
                "GrauDependencia" => $reg['GrauDependencia'],
                "InicioVigencia" => $this->dataSql($this->dataPhp($reg['InicioVigencia'])),
                //"fimContratoVig"	=> $reg['fimContratoVig'],
                "Nome" => $reg['Nome'],
                "Sexo" => $reg['Sexo'],
                "EstadoCivil" => $reg['EstadoCivil'],
                "Naturalidade" => $reg['Naturalidade'],
                "Cnp" => $reg['Cnp'],
                //"pis"				=> $reg['pis'],
                "NomeMae" => $reg['NomeMae'],
                "DataNascimento" => $this->dataSql($this->dataPhp($reg['DataNascimento'])),
                "NomePai" => $reg['NomePai'],
                "NomeConjuge" => $reg['NomeConjuge'],
                "NomeCidade" => $reg['NomeCidade'],
                "UF" => $reg['UF'],
                "DataAdmissao" => $this->dataSql($this->dataPhp($reg['DataAdmissao'])),
                "Matricula" => $reg['Matricula'],
                    //"Titular"			=> $reg['Titular']);
                    //"email"			=> $reg['email'],
                    //"telefone"		=> $reg['telefone']);
            );
            //var_dump($inserir); exit;
            $idBeneficiario = $benef->insert($inserir);

            /* SELECT PARA PEGAR O ULTIMO BENEFICIARIO INSERIDO		
              $select=$benef->select();
              $select ->setIntegrityCheck(false);
              $select	->from(array('b' => 'Beneficiario'), array('max(idBeneficiario) as beneficiario'));

              $reg = $benef->fetchAll($select);
              $reg = $reg->current();

              $idBeneficiario = $reg['beneficiario'];
             */
            foreach ($telefoneUni as $tel) {
                if ($tel['DDD'] == 0) {
                    $ddd = null;
                } else {
                    $ddd = $tel['DDD'];
                }
                $varTelefone = array("idBeneficiario" => $idBeneficiario,
                    "Seq" => $tel['Seq'],
                    "Tipo" => $tel['Tipo'],
                    "DDD" => $ddd,
                    "Numero" => $tel['Numero'],
                    "InicioVigencia" => $this->dataSql($this->dataPhp($tel['InicioVigencia'])),
                    "FimVigencia" => $this->dataSql($this->dataPhp($tel['FimVigencia'])),
                    "SeqEnd" => $tel['SeqEnd'],
                    "AutoId" => $tel['AutoId'],
                );
                $telefone->insert($varTelefone);
            }

            foreach ($enderecoUni as $end) {
                $varEndereco = array("idBeneficiario" => $idBeneficiario,
                    "Seq" => $end['Seq'],
                    "NumLogradouro" => $end['NumLogradouro'],
                    "Logradouro" => $end['Logradouro'],
                    "ComplLogradouro" => $end['ComplLogradouro'],
                    "Bairro" => $end['Bairro'],
                    "Cidade" => $end['Cidade'],
                    "CEP" => $end['CEP'],
                    "CaixaPostal" => $end['CaixaPostal'],
                    "Tipo" => $end['Tipo'],
                    "ParaCorrespondencia" => $end['ParaCorrespondencia'],
                    "ParaCobranca" => $end['ParaCobranca'],
                    "ParaFaturamento" => $end['ParaFaturamento'],
                    "ParaPublicacao" => $end['ParaPublicacao'],
                    "InicioVigencia" => $this->dataSql($this->dataPhp($end['InicioVigencia'])),
                    "FimVigencia" => $this->dataSql($this->dataPhp($end['FimVigencia'])),
                    "NomeCidade" => $end['NomeCidade'],
                    "UF" => $end['UF'],
                    "AutoId" => $end['AutoId'],
                );
                $endereco->insert($varEndereco);
            }

            foreach ($emailUni as $ema) {
                $varEmail = array("idBeneficiario" => $idBeneficiario,
                    "Seq" => $ema['Seq'],
                    "Email" => $ema['Email'],
                    "InicioVigencia" => $this->dataSql($this->dataPhp($ema['InicioVigencia'])),
                    "FimVigencia" => $this->dataSql($this->dataPhp($ema['FimVigencia'])),
                );
                $email->insert($varEmail);
            }
            foreach ($moduloUni as $mod) {
                $varModulo = array("idBeneficiario" => $idBeneficiario,
                    "Nome" => $mod['Nome'],
                    "Codigo" => $mod['Codigo'],
                    "Nome" => $mod['Nome'],
                    //"NomeModulo"	=> $mod['NomeModulo'],
                    "InicioVigencia" => $this->dataSql($this->dataPhp($mod['InicioVigencia'])),
                    "FimVigencia" => $this->dataSql($this->dataPhp($mod['FimVigencia'])),
                        //"MotivoRecisao"	=> $mod['MotivoRecisao'],
                        //"Participativo"	=> $mod['Participativo'],
                        //"AutoId"		=> $mod['AutoId'],
                );
                $modulo->insert($varModulo);
            }

            foreach ($localUni as $loc) {
                $varLocal = array("idBeneficiario" => $idBeneficiario,
                    "Codigo" => $loc['Codigo'],
                    "Nome" => $loc['NomeReduzido'],
                    //"tipo"					=> $loc['tipo'],
                    "InicioVigencia" => $this->dataSql($this->dataPhp($loc['InicioVigencia'])),
                    //"ClassifDestino"		=> $loc['ClassifDestino'],
                    //"MovCadAbertura"		=> $loc['MovCadAbertura'],
                    //"MovCadFechamento"		=> $loc['MovCadFechamento'],
                    //"DataRegistroFechamento"=> $loc['DataRegistroFechamento'],
                    "AutoId" => $loc['AutoId'],
                );

                //var_dump($varLocal); exit;
                $local->insert($varLocal);
            }

            foreach ($lotacaoUni as $lot) {
                $varLotacao = array("idBeneficiario" => $idBeneficiario,
                    "Nome" => $lot['Nome'],
                    "Codigo" => $lot['Codigo'],
                    "Nome" => $lot['Nome'],
                    "InicioVigencia" => $this->dataSql($this->dataPhp($lot['InicioVigencia'])),
                    "FimVigencia" => $this->dataSql($this->dataPhp($lot['FimVigencia'])),
                    "AutoId" => $lot['AutoId'],
                );
                $lotacao->insert($varLotacao);
            }

            $varRegistro = array("idBeneficiario" => $idBeneficiario,
                "RG" => $rg['Numero'],
                "PIS" => $pis['Numero'],
            );
            $registro->insert($varRegistro);
        }
    }

    public function indexAction() {

        // TODO Auto-generated RelatoriosController::indexAction() default action
        //PESQUISAR
    }

    public function novoAction() {

        $user = Zend_Registry::get('zend_auth_user');
        if ($user == null or @$user->contrato == null)
            exit;


        $beneficiarioCardio = new Application_Model_DbTable_Unibeneficiario();
        $pessoaCardio = new Application_Model_DbTable_Unipessoa();
        $enderecoCardio = new Application_Model_DbTable_Uniendereco();

        $empresas = Zend_Auth::getInstance()->getStorage()->read()->contratante;

        $this->view->nrfamilia = $this->novaFamilia($user->contrato);

        $select = $beneficiarioCardio->select();
        $select->setIntegrityCheck(false);
        $select->from(array('b' => 'NegociacaoAqModulo'), array())
                ->join(array('o' => 'ModuloOperadora'), 'b.modulo = o.AutoId', array('Nome', 'Codigo'))
                ->where('b.contrato = ? and b.fimvigencia is null and o.tipo=1', $user->contrato)
                ->order('NomeReduzido');
        $this->view->dadosModulo = $beneficiarioCardio->fetchAll($select);



        $select = $beneficiarioCardio->select();
        $select->setIntegrityCheck(false);
        $select->from(array('n' => 'NegociacaoRepasse'), array())
                ->join(array('p' => 'PrestadorServico'), 'n.lcat = p.AutoId', array('Codigo'))
                ->join(array('s' => 'Pessoa'), 'p.Pessoa = s.AutoId', array('AutoId', 'NomeReduzido'))
                ->where('n.contrato = ? and n.fimvigencia is null', $user->contrato)
                ->order('NomeReduzido');

        $this->view->dadosLocalAtendimento = $beneficiarioCardio->fetchAll($select);



        $this->view->dadosLotacao = $this->carregaLotacaoContrato($user->contrato);
        /*

          $select = $beneficiarioCardio->select();
          $select ->setIntegrityCheck(false);
          $select	->from(array('b' => 'Beneficiario'),array('*'))
          ->joinLeft(array('n' => 'NegociacaoRepasse'),	'n.contrato = b.contrato', array('*'))
          ->joinLeft(array('p' => 'PrestadorServico'),	'n.lcat = p.AutoId', array('*'))
          ->joinLeft(array('s' => 'Pessoa'),				'p.Pessoa = s.AutoId',array('*'));

          $this->view->dadosAtendimento = $beneficiarioCardio->fetchAll($select);



         */
    }

    public function altmoduloAction() {

        $beneficiario = new Application_Model_DbTable_Beneficiario();
        $modulo = new Application_Model_DbTable_Modulo();

        $request = $this->getRequest();
        //$this->puxaBenef($request->getParam('id'));

        /* $moduloDesc = $request->getParam('modulo');

          if($moduloDesc == null){
          $NomeModulo['Nome'] = '';
          }else{
          //PEGA A Nome DO MODULO NO BANCO DA UNIMED
          $tab = new Application_Model_DbTable_Unibeneficiario();
          $select = $tab->select();
          $select ->setIntegrityCheck(false);
          $select	->from(array('o' => 'ModuloOperadora'),array('*'))
          ->where('Codigo = ?', $moduloDesc );

          $NomeModulo =  $tab->fetchAll($select)->current();
          } */


        //PEGA O IDBENEFICIARIO
        $select = $beneficiario->select();
        $select->setIntegrityCheck(false);
        $select->where('AutoId = ?', $request->getParam('idBeneficiarioUnimed'))
                ->where('status is null and lote is null');

        $idBeneficiario = $beneficiario->fetchAll($select)->current();

        //pega a data inicio vigencia e converte para o formato do MySQL
        //$fimVigencia = date('Y-m-d',strtotime($request->getParam('inicioVigencia'))-60*60*24);
        /* FIM VIGENCIA PARA INSERIR NO BANCO */
        $iniVigencia = date('Y-m-d', strtotime($request->getParam('inicioVigencia')));
        $fimVigencia = date('Y-m-d', strtotime($this->subDayIntoDate($request->getParam('inicioVigencia'), 1)));


        //pega os dados e faz o insert
        $dados = array(
            "idBeneficiario" => $idBeneficiario['idBeneficiario'],
            "InicioVigencia" => $this->dataSql($request->getParam('inicioVigencia')),
            "Codigo" => $request->getParam('modulo'),
            "Nome" => $request->getParam('NomePlano'),
            "status" => 1,
        );

        $modulo->insert($dados);

        //faz o update
        $dadosUpdate = array(   "FimVigencia" => $fimVigencia,
                                "status" => 1,
        );

        $where = "idModulo = " . $request->getParam('idModulo');

        $modulo->update($dadosUpdate, $where);
        $where = null;
        
        //VAI DAR UPDATE NO TITULAR PARA MANDAR ELE NO XML
        $dadosBene = array("status" => 1);
        $where = "status is null and lote is null and AutoId = ". $request->getParam('idBeneficiarioUnimed');
        $beneficiario->update($dadosBene,$where);
        
        //FUNCAO QUE RETORNA OS DEPENDETES
        if ($idBeneficiario['RDP'] == 0) {

            $depe = $this->pegaDepe($request->getParam('contrato'), $request->getParam('familia'));
            /* var_dump($depe);
              exit; */

            /* PARA FAZER O UPDATE DE TODOS OS DEPENDENTES DO TITULAR */
            foreach ($depe as $i => $v) {
                $this->puxaBenef($v['AutoId']);

                //PEGA O IDBENEFICIARIO
                $select = $beneficiario->select();
                $select->setIntegrityCheck(false);
                $select->where('AutoId = ?', $v['AutoId'])
                        ->where('status is null and lote is null');

                $idBeneficiario = $beneficiario->fetchAll($select)->current();

                //faz o update
                $dadosUpdate = array("FimVigencia"  => $fimVigencia,
                                     "status"       => 1,
                );

                $where = "fimvigencia is null and idBeneficiario = " . $idBeneficiario['idBeneficiario'];

                $modulo->update($dadosUpdate, $where);
                $where = null;
                
                //faz o insert
                $dados = array(
                    "idBeneficiario" => $idBeneficiario['idBeneficiario'],
                    "InicioVigencia" => $this->dataSql($request->getParam('inicioVigencia')),
                    "Codigo" => $request->getParam('modulo'),
                    "Nome" => $request->getParam('NomePlano'),
                    "status" => 1,
                );

                $modulo->insert($dados);
                
                //VAI DAR UPDATE NO DEPENDENTE, PARA ENVIAR O ANTIGO MODULO COM O FIM VIGENCIA
                $dadosBene = array("status" => 1);
                $where = "status is null and lote is null and idBeneficiario = ". $idBeneficiario['idBeneficiario'];
                $beneficiario->update($dadosBene,$where);
            }
        }
        //redireciona a pagina
        //$this->_redirect('/beneficiario/exibealt/id/'.$request->getParam('idBeneficiarioUnimed'));
        /* RETORNA O FIM VIGENCIA PARA A TELA */
        echo date('d/m/Y', strtotime($fimVigencia));
        exit;
    }

    public function altlocalAction() {

        $beneficiario = new Application_Model_DbTable_Beneficiario();
        $lcat = new Application_Model_DbTable_LocalAtendimento();

        $request = $this->getRequest();

        if ($request->getParam('local') == null) {
            exit;
        } else {
            //PEGA O IDBENEFICIARIO
            $select = $beneficiario->select();
            $select ->setIntegrityCheck(false);
            $select ->where('AutoId = ?', $request->getParam('idBeneficiarioUnimed'))
                    ->where('status is null and lote is null');

            $idBeneficiario = $beneficiario->fetchAll($select)->current();

            //pega a data inicio vigencia e converte para o formato do MySQL
            $fimVigencia = date('Y-m-d', strtotime($this->subDayIntoDate($request->getParam('inicioVigenciaLcat'), 1)));
            $iniVigencia = date('Y-m-d', strtotime($request->getParam('inicioVigenciaLcat')));



            //pega os dados e faz o insert
            $dados = array(
                "idBeneficiario"    => $idBeneficiario['idBeneficiario'],
                "InicioVigencia"    => $this->dataSql($request->getParam('inicioVigenciaLcat')),
                "Codigo"            => $request->getParam('local'),
                "Nome"              => $request->getParam('NomeLcat'),
                "status"            => 1,
            );

            //echo var_dump($dados); exit;
            $lcat->insert($dados);

            //faz o update
            $dadosUpdate = array(   "FimVigencia"   => $fimVigencia,
                                    "status"        => 1,
                                );

            //estou perguntando se o codigo é null para ele nao dar update no registro que veio tudo null
            $where = "Codigo is not null and idlcat = " . $request->getParam('idlcat');

            $lcat->update($dadosUpdate, $where);
            

            //redireciona a pagina
            //$this->_redirect('/beneficiario/exibealt/id/'.$request->getParam('idBeneficiarioUnimed'));

            echo date('d/m/Y', strtotime($fimVigencia));
            exit;
        }
    }

    public function altlotacaoAction() {

        //ACTION QUE EXIBE OS DADOS DO USUARIO
        $user = Zend_Registry::get('zend_auth_user');
        if ($user == null or @$user->contrato == null)
            exit;

        $beneficiario = new Application_Model_DbTable_Beneficiario();
        $unibene = new Application_Model_DbTable_Unibeneficiario();
        $lotacao = new Application_Model_DbTable_Lotacao();

        $request = $this->getRequest();

        if ($request->getParam('lotacao') == null) {
            exit;
        } else {

            $select = $unibene->select();
            $select->where('familia = ?', $request->getParam('familia'))
                    ->where('contrato = ?', $user->contrato);

            //PEGA O IDBENEFICIARIO
            $select = $beneficiario->select();
            $select->setIntegrityCheck(false);
            $select->where('AutoId = ?', $request->getParam('idBeneficiarioUnimed'))
                    ->where('status is null and lote is null');

            $idBeneficiario = $beneficiario->fetchAll($select)->current();

            //pega a data inicio vigencia e converte para o formato do MySQL
            $fimVigencia = date('Y-m-d', strtotime($this->subDayIntoDate($request->getParam('inicioVigenciaLotacao'), 1)));
            $iniVigencia = date('Y-m-d', strtotime($request->getParam('inicioVigenciaLotacao')));



            //pega os dados e faz o insert
            $dados = array(
                "idBeneficiario" => $idBeneficiario['idBeneficiario'],
                "InicioVigencia" => $this->dataSql($request->getParam('inicioVigenciaLotacao')),
                "Codigo" => $request->getParam('lotacao'),
                "Nome" => $request->getParam('NomeLotacao'),
                "status" => 1,
            );

            $lotacao->insert($dados);
            
            //faz o update
            $dadosUpdate = array("FimVigencia" => $fimVigencia,
                "status" => 1,
            );

            //estou perguntando se o codigo é null para ele nao dar update no registro que veio tudo null
            $where = "Codigo is not null and idLotacao = " . $request->getParam('idLotacao');

            $lotacao->update($dadosUpdate, $where);
            $where = null;
            
            
            //VAI DAR UPDATE NO TITULAR PARA MANDAR ELE NO XML
            $dadosBene = array("status" => 1);
            $where = "status is null and lote is null and AutoId = ". $request->getParam('idBeneficiarioUnimed');
            $beneficiario->update($dadosBene,$where);
            
            //FUNCAO QUE RETORNA OS DEPENDETES
            if ($idBeneficiario['RDP'] == 0) {

                $depe = $this->pegaDepe($request->getParam('contrato'), $request->getParam('familia'));
                /* var_dump($depe);
                  exit; */

                /* PARA FAZER O UPDATE DE TODOS OS BENEFICIARIOS DO DEPENDENTE */
                foreach ($depe as $i => $v) {
                    $this->puxaBenef($v['AutoId']);

                    //PEGA O IDBENEFICIARIO
                    $select = $beneficiario->select();
                    $select->setIntegrityCheck(false);
                    $select->where('AutoId = ?', $v['AutoId'])
                            ->where('status is null and lote is null');

                    $idBeneficiario = $beneficiario->fetchAll($select)->current();

                    //faz o update
                    $dadosUpdate = array("FimVigencia" => $fimVigencia,
                                        "status" => 1,
                                        );

                    $where = "fimvigencia is null and idBeneficiario = " . $idBeneficiario['idBeneficiario'];

                    $lotacao->update($dadosUpdate, $where);
                    $where = null;
                    
                    //faz o insert
                    $dados = array(
                                    "idBeneficiario" => $idBeneficiario['idBeneficiario'],
                                    "InicioVigencia" => $this->dataSql($request->getParam('inicioVigenciaLotacao')),
                                    "Codigo" => $request->getParam('lotacao'),
                                    "Nome" => $request->getParam('NomeLotacao'),
                                    "status" => 1,
                                );

                    $lotacao->insert($dados);
                    
                    //VAI DAR UPDATE NO DEPENDENTE, PARA ENVIAR O ANTIGO MODULO COM O FIM VIGENCIA
                    $dadosBene = array("status" => 1);
                    $where = "status is null and lote is null and idBeneficiario = ". $idBeneficiario['idBeneficiario'];
                    $beneficiario->update($dadosBene,$where);
                }
            }

            //redireciona a pagina
            //$this->_redirect('/beneficiario/exibealt/id/'.$request->getParam('idBeneficiarioUnimed'));

            echo date('d/m/Y', strtotime($fimVigencia));
            exit;
        }
    }

    public function cadenderecoAction() {

        $pegaUser = $this->getRequest();
        $userId = $pegaUser->getParam('id');

        $beneficiario = new Application_Model_DbTable_Beneficiario();
        $endereco = new Application_Model_DbTable_Endereco();

        $request = $this->getRequest();

        //PEGA O IDBENEFICIARIO
        $select = $beneficiario->select();
        $select->setIntegrityCheck(false);
        $select->where('AutoId = ?', $request->getParam('idBeneficiarioUnimed'))
                ->where('status is null and lote is null');

        $idBeneficiario = $beneficiario->fetchAll($select)->current();

        //pega a data inicio vigencia e converte para o formato do MySQL
        $fimVigencia = date('Y-m-d', strtotime($this->subDayIntoDate($request->getParam('iniCaixaVig'), 1)));
        $iniVigencia = $this->dataSql($request->getParam('iniCaixaVig'));

        /* PEGA O NOME DA CIDADE E A UF */
        $var = explode("/", $request->getParam('Cidade'));
        //$arrayReverso = array_reverse($var);			
        $cidade = $var[0];
        $uf = $var[1];

        $endereco = new Application_Model_DbTable_Endereco();

        $dados = array("idBeneficiario" => $idBeneficiario['idBeneficiario'],
            "Logradouro" => $request->getParam('Logradouro'),
            "NumLogradouro" => $request->getParam('NumLogradouro'),
            "ComplLogradouro" => $request->getParam('ComplLogradouro'),
            "Seq" => $request->getParam('endSeq'),
            "Tipo" => $request->getParam('endtipo'),
            "Bairro" => $request->getParam('Bairro'),
            "Cidade" => $request->getParam('idCidade'),
            "CEP" => $request->getParam('CEP'),
            "PontoReferencia" => $request->getParam('PontoReferencia'),
            "CaixaPostal" => $request->getParam('CaixaPostal'),
            "InicioVigencia" => $iniVigencia,
            "NomeCidade" => $cidade,
            "UF" => $uf,
            "ParaCorrespondencia" => 1,
            "ParaFaturamento" => 1,
            "ParaCobranca" => 1,
            "ParaPublicacao" => 1,
            "status" => 1,
        );

        $endereco->insert($dados);

        //faz o update
        $dadosUpdate = array("FimVigencia" => $fimVigencia,
            "status" => 1,
        );

        $where = "idEndereco = " . $request->getParam('idEndereco');

        $endereco->update($dadosUpdate, $where);


        //redireciona a pagina
        //$this->_redirect('/beneficiario/exibealt/id/'.$request->getParam('idBeneficiarioUnimed'));

        echo date('d/m/Y', strtotime($fimVigencia));
        exit;
    }

    public function exibealtAction() {

        //ACTION QUE EXIBE OS DADOS DO USUARIO 
        $user = Zend_Registry::get('zend_auth_user');
        if ($user == null or @$user->contrato == null)
            exit;

        $pegaUser = $this->getRequest();
        $userId = $pegaUser->getParam('id');

        $this->verificaId($pegaUser->getParam('id'));

        $this->puxaBenef($userId);

        $benef = new Application_Model_DbTable_Beneficiario();
        $telefone = new Application_Model_DbTable_Telefone();
        $endereco = new Application_Model_DbTable_Endereco();
        $email = new Application_Model_DbTable_Email();
        $modulo = new Application_Model_DbTable_Modulo();
        $local = new Application_Model_DbTable_LocalAtendimento();
        $lotacao = new Application_Model_DbTable_Lotacao();
        $registro = new Application_Model_DbTable_Registro();

        /* SELECT PARA PEGAR O ULTIMO BENEFICIARIO INSERIDO */
        $select = $benef->select();
        $select->setIntegrityCheck(false);
        $select->from(array('b' => 'beneficiario'), array('max(idBeneficiario) as beneficiario'))
                ->where('AutoId=' . $userId);

        $reg = $benef->fetchAll($select);
        $reg = $reg->current();

        $idBeneficiario = $reg['beneficiario'];

        /* BENEFICIARIO */
        $select = $benef->select();
        $select->setIntegrityCheck(false);
        $select->where('AutoId = ?', $userId)
                ->where('lote is null');

        $this->view->dados = $benef->fetchAll($select)->current();

        /* verifica se o beneficiario é desse contrato */
        $this->verificaContrato($this->view->dados, $user->contrato);

        /* TELEFONE */
        $select = $telefone->select();
        $select->setIntegrityCheck(false);
        $select->where('idBeneficiario = ?', $idBeneficiario);

        $this->view->dadosTelefone = $telefone->fetchAll($select)->current();

        /* REGISTRO */
        $select = $registro->select();
        $select->setIntegrityCheck(false);
        $select->where('idBeneficiario = ?', $idBeneficiario);

        $this->view->dadosRegistro = $registro->fetchAll($select)->current();

        /* ENDERECO */
        $select = $endereco->select();
        $select->setIntegrityCheck(false);
        $select->where('idBeneficiario = ?', $idBeneficiario)
                ->where('FimVigencia is null');

        $this->view->dadosEndereco = $endereco->fetchAll($select);

        /* ENDERECO */
        $select = $endereco->select();
        $select->setIntegrityCheck(false);
        $select->where('idBeneficiario = ?', $idBeneficiario);

        $this->view->dadosEnderecoHistorico = $endereco->fetchAll($select);

        /* EMAIL */
        $select = $email->select();
        $select->setIntegrityCheck(false);
        $select->where('idBeneficiario = ?', $idBeneficiario);

        $this->view->dadosEmail = $email->fetchAll($select)->current();

        /* MODULO */
        $select = $modulo->select();
        $select->setIntegrityCheck(false);
        $select->where('idBeneficiario = ?', $idBeneficiario)
                ->where('FimVigencia is null');

        $this->view->dadosModulo = $modulo->fetchAll($select)->current();

        //SELECT QUE PEGA OS PLANOS DA EMPRESA			
        $this->view->dadosModuloContrato = $this->carregaModuloContrato($user->contrato);

        /* MOSTRAS TODOS OS MODULOS QUE ELE JA TEVE */
        $select = $modulo->select();
        $select->setIntegrityCheck(false);
        $select->where('idBeneficiario = ?', $idBeneficiario);

        $this->view->dadosModuloHistorico = $modulo->fetchAll($select);

        /* LOCAL */
        $select = $local->select();
        $select->setIntegrityCheck(false);
        $select->where('idBeneficiario = ?', $idBeneficiario)
                ->where('FimVigencia is null');

        $this->view->dadosLocal = $local->fetchAll($select)->current();

        //SELECT QUE PEGA LOCAL DE ATENDIMENTO		
        $this->view->dadosLocalContrato = $this->carregaLocalAtendimentoContrato($user->contrato);

        /* LOCAL */
        $select = $local->select();
        $select->setIntegrityCheck(false);
        $select->where('idBeneficiario = ?', $idBeneficiario);

        $this->view->dadosLocalHistorico = $local->fetchAll($select);

        /* LOTACAO */
        $select = $lotacao->select();
        $select->setIntegrityCheck(false);
        $select->where('idBeneficiario = ?', $idBeneficiario)
                ->where('FimVigencia is null');

        $this->view->dadosLotacao = $lotacao->fetchAll($select)->current();

        //MOSTRA AS LOTACOES QUE O CONTRATO TEM
        $this->view->dadosLotacaoContrato = $this->carregaLotacaoContrato($user->contrato);

        /* LOTACAO MOSTRA TODAS AS LOTACOES DO BENEFICIARIO */
        $select = $lotacao->select();
        $select->setIntegrityCheck(false);
        $select->where('idBeneficiario = ?', $idBeneficiario);

        $this->view->dadosLotacaoHistorico = $lotacao->fetchAll($select);


        $this->view->rdp = $this->vRdp;
        /*
          $beneficiario = new Application_Model_DbTable_Unibeneficiario();
          $pessoa = new Application_Model_DbTable_Unipessoa();
          $endereco = new Application_Model_DbTable_Uniendereco();

          $empresas = Zend_Auth::getInstance()->getStorage()->read()->contratante;

          //EXIBE OS DADOS DO BENEFICIARIO E DA PESSOA
          $this->view->dados = $this->carregaBenef($pegaUser->getParam('id'));
          $this->view->id = $pegaUser->getParam('id');

          //EXIBE OS DADOS DO BENEFICIARIO, PESSOA E ENDERECOPESSOA
          $this->view->dadosEndereco = $this->carregaEnderecoBenef($userId);

          //MOSTRA OS MODULOS DO BENEFICIARIO
          $this->view->dadosModulo = $this->carregaModuloBenef($userId);

          //var_dump($this->view->dadosAtendimentogrid); exit; // nao esta retornando nada...

          //MOSTRA O LOCAL DE ATENDIMENTO QUE ESTA COM FIMVIGENCIA NULL*
          $this->view->dadosAtendimentoview = $this->carregaLocalAtendimentoBene($userId)->current();



          //MOSTRA A LOTACAO ATUAL DO BENEFICIARIO
          $this->view->dadosLotacaoView = $this->carregaLotacaoBenef($userId)->current();
         */
    }

    public function alteraaltAction() {

        //ACTION QUE EXIBE OS DADOS DO USUARIO 
        $user = Zend_Registry::get('zend_auth_user');
        if ($user == null or @$user->contrato == null)
            exit;

        $pegaUser = $this->getRequest();
        $idBeneficiario = $pegaUser->getParam('id');

        $this->verificaId($pegaUser->getParam('id'));

        $beneficiario = new Application_Model_DbTable_Beneficiario();
        $beneficiarioCardio = new Application_Model_DbTable_Unibeneficiario();
        $telefone = new Application_Model_DbTable_Telefone();
        $endereco = new Application_Model_DbTable_Endereco();
        $email = new Application_Model_DbTable_Email();
        $modulo = new Application_Model_DbTable_Modulo();
        $local = new Application_Model_DbTable_LocalAtendimento();
        $lotacao = new Application_Model_DbTable_Lotacao();
        $registro = new Application_Model_DbTable_Registro();

        //DADOS DO BENEFICIARIO
        $select = $beneficiario->select();
        $select->setIntegrityCheck(false);
        $select->where('idBeneficiario = ?', $idBeneficiario);

        $this->view->dados = $beneficiario->fetchAll($select)->current();

        $this->verificaContrato($this->view->dados, $user->contrato);

        /* REGISTRO */
        $select = $registro->select();
        $select->setIntegrityCheck(false);
        $select->where('idBeneficiario = ?', $idBeneficiario);

        $this->view->dadosRegistro = $registro->fetchAll($select)->current();

        /* MOSTRA OS MODULOS QUE ELE JA TEVE */
        $select = $modulo->select();
        $select->setIntegrityCheck(false);
        $select->where('idBeneficiario = ?', $idBeneficiario)
                ->where('FimVigencia is null');

        $this->view->dadosModulo = $modulo->fetchAll($select)->current();

        /* MOSTRA O EMAIL QUE ELE JA TEVE */
        $select = $email->select();
        $select->setIntegrityCheck(false);
        $select->where('idBeneficiario = ?', $idBeneficiario);

        $this->view->dadosEmail = $email->fetchAll($select)->current();

        /* MOSTRA O TELEFONE QUE ELE JA TEVE */
        $select = $telefone->select();
        $select->setIntegrityCheck(false);
        $select->where('idBeneficiario = ?', $idBeneficiario);

        $this->view->dadosTelefone = $telefone->fetchAll($select)->current();

        /* MOSTRA O ULTIMO MODULO DO BENEFICIARIO */
        $select = $modulo->select();
        $select->setIntegrityCheck(false);
        $select->where('idBeneficiario = ?', $idBeneficiario)
                ->order('idModulo');

        $this->view->dadosModuloHistorico = $modulo->fetchAll($select);

        /* SELECT QUE PEGA OS PLANOS DA EMPRESA */
        $this->view->dadosModuloContrato = $this->carregaModuloContrato($this->view->dados['Contrato']);

        /* SELECT QUE PEGA LOCAL DO BENEFICIARIO */
        $select = $local->select();
        $select->setIntegrityCheck(false);
        $select->where('idBeneficiario = ?', $idBeneficiario)
                ->where('FimVigencia is null');

        $this->view->dadosLocal = $local->fetchAll($select)->current();

        /* SELECT QUE PEGA TODOS OS LOCAIS DE ATENDIMENTO */
        $select = $local->select();
        $select->setIntegrityCheck(false);
        $select->where('idBeneficiario = ?', $idBeneficiario)
                ->order('idLcat');

        $this->view->dadosLocalHistorico = $local->fetchAll($select);

        /* MOSTRA OS LOCAIS DE ATENDIMENTO PELO CONTRATO */
        $this->view->dadosLocalContrato = $this->carregaLocalAtendimentoContrato($this->view->dados['Contrato']);

        /* MOSTRA AS LOTACOES QUE O USUARIO JA TEVE */
        $select = $lotacao->select();
        $select->setIntegrityCheck(false);
        $select->where('idBeneficiario = ?', $idBeneficiario)
                ->where('FimVigencia is null');

        $this->view->dadosLotacao = $lotacao->fetchAll($select)->current();

        /* MOSTRA AS LOTACOES QUE O CONTRATO PODE TER */
        $this->view->dadosLotacaoContrato = $this->carregaLotacaoContrato($this->view->dados['Contrato']);

        /* MOSTRA A LOTACAO ATUAL DO BENEFICIARIO */
        $select = $lotacao->select();
        $select->setIntegrityCheck(false);
        $select->where('idBeneficiario = ?', $idBeneficiario)
                ->order('idLotacao');

        $this->view->dadosLotacaoHistorico = $lotacao->fetchAll($select);

        /* ENDERECO DO BENEFICIARIO */
        $select = $endereco->select();
        $select->setIntegrityCheck(false);
        $select->where('idBeneficiario = ?', $idBeneficiario)
                ->where('FimVigencia is null');

        $this->view->dadosEndereco = $endereco->fetchAll($select);

        /* ENDERECO DO BENEFICIARIO */
        $select = $endereco->select();
        $select->setIntegrityCheck(false);
        $select->where('idBeneficiario = ?', $idBeneficiario);

        $this->view->dadosEnderecoHistorico = $endereco->fetchAll($select);

        //´PASSA RDP
        $this->view->rdp = $this->vRdp;
    }

    public function exibealteradosAction() {

        //ACTION QUE EXIBE OS DADOS DO USUARIO 
        $user = Zend_Registry::get('zend_auth_user');
        if ($user == null or @$user->contrato == null)
            exit;
        $pegaUser = $this->getRequest();
        $idBeneficiario = $pegaUser->getParam('id');

        $this->verificaId($pegaUser->getParam('id'));

        $beneficiario = new Application_Model_DbTable_Beneficiario();
        $telefone = new Application_Model_DbTable_Telefone();
        $endereco = new Application_Model_DbTable_Endereco();
        $email = new Application_Model_DbTable_Email();
        $modulo = new Application_Model_DbTable_Modulo();
        $local = new Application_Model_DbTable_LocalAtendimento();
        $lotacao = new Application_Model_DbTable_Lotacao();
        $registro = new Application_Model_DbTable_Registro();

        $this->view->dados = $this->carregaBenef($pegaUser->getParam('id'));
        $this->view->id = $pegaUser->getParam('id');

        /* BENEFICIARIO */
        $select = $beneficiario->select();
        $select->setIntegrityCheck(false);
        $select->from(array('b' => 'beneficiario'), array('*'))
                ->where('b.idBeneficiario = ?', $idBeneficiario);

        $this->view->dados = $beneficiario->fetchAll($select)->current();

        $this->verificaContrato($this->view->dados, $user->contrato);

        /* DEPENDENTES */
        $select = $beneficiario->select();
        $select->setIntegrityCheck(false);
        $select->from(array('b' => 'beneficiario'), array('*'))
                ->where('b.contrato = ?', $user->contrato)
                ->where('b.familia = ?', $this->view->dados['Familia'])
                ->where('b.idbeneficiario != ?', $idBeneficiario);

        $this->view->dadosDependente = $beneficiario->fetchAll($select);

        /* REGISTRO */
        $select = $registro->select();
        $select->setIntegrityCheck(false);
        $select->where('idBeneficiario = ?', $idBeneficiario);

        $this->view->dadosRegistro = $registro->fetchAll($select)->current();

        /* MODULO */
        $select = $modulo->select();
        $select->setIntegrityCheck(false);
        $select->from(array('m' => 'modulo'), array('Codigo', 'Nome', 'InicioVigencia'))
                ->where('m.idBeneficiario = ?', $idBeneficiario)
                ->where('m.fimVigencia is null');

        $this->view->dadosModulo = $modulo->fetchAll($select)->current();

        /* LOCAL */
        $select = $local->select();
        $select->setIntegrityCheck(false);
        $select->from(array('m' => 'localatendimento'), array('Codigo', 'Nome', 'InicioVigencia'))
                ->where('m.idBeneficiario = ?', $idBeneficiario)
                ->where('m.fimVigencia is null');

        $this->view->dadosLocal = $local->fetchAll($select)->current();

        /* LOTACAO */
        $select = $lotacao->select();
        $select->setIntegrityCheck(false);
        $select->from(array('m' => 'lotacao'), array('Codigo', 'Nome', 'InicioVigencia'))
                ->where('m.idBeneficiario = ?', $idBeneficiario)
                ->where('m.fimVigencia is null');

        $this->view->dadosLotacao = $lotacao->fetchAll($select)->current();

        /* ENDERECO */
        $select = $endereco->select();
        $select->setIntegrityCheck(false);
        $select->from(array('e' => 'endereco'), array('*'))
                ->where('e.idBeneficiario = ?', $idBeneficiario)
                ->where('e.FimVigencia is null');

        $this->view->dadosEndereco = $endereco->fetchAll($select);

        /* EMAIL */
        $select = $email->select();
        $select->setIntegrityCheck(false);
        $select->from(array('e' => 'email'), array('*'))
                ->where('e.idBeneficiario = ?', $idBeneficiario);

        $this->view->dadosEmail = $email->fetchAll($select)->current();

        /* TELEFONE */
        $select = $telefone->select();
        $select->setIntegrityCheck(false);
        $select->from(array('t' => 'telefone'), array('*'))
                ->where('t.idBeneficiario = ?', $idBeneficiario);

        $this->view->dadosTelefone = $telefone->fetchAll($select)->current();


        $this->view->rdp = $this->vRdp;
    }

    public function exibeAction() {

        //ACTION QUE EXIBE OS DADOS DO USUARIO 
        $user = Zend_Registry::get('zend_auth_user');
        if ($user == null or @$user->contrato == null)
            exit;
        $pegaUser = $this->getRequest();
        $userId = $pegaUser->getParam('id');

        $this->verificaId($pegaUser->getParam('id'));


        $beneficiario = new Application_Model_DbTable_Unibeneficiario();
        $pessoa = new Application_Model_DbTable_Unipessoa();
        $endereco = new Application_Model_DbTable_Uniendereco();

        $this->view->dados = $this->carregaBenef($pegaUser->getParam('id'));

        $this->verificaContrato($this->view->dados, $user->contrato);

        $this->view->id = $pegaUser->getParam('id');


        /* SELECT NO BANCO DA UNIMED PARA PEGAR O TELEFONE */
        $unibenef = new Application_Model_DbTable_Unibeneficiario();
        $select = $unibenef->select();
        $select->setIntegrityCheck(false);
        $select->from(array('b' => 'Beneficiario'), array())
                ->joinleft(array('p' => 'Pessoa'), 'b.Pessoa = p.AutoId', array())
                ->joinleft(array('t' => 'TelefonePessoa'), 't.pessoa = p.autoid', array('*'))
                ->where('b.AutoId = ? ', $userId)
                ->where('t.fimvigencia is null');

        $telefoneUni = $unibenef->fetchAll($select)->current();

        $this->view->dadosTelefone = $telefoneUni;

        /* SELECT NO BANCO DA UNIMED PARA PEGAR O EMAIL */
        $unibenef = new Application_Model_DbTable_Unibeneficiario();
        $select = $unibenef->select();
        $select->setIntegrityCheck(false);
        $select->from(array('b' => 'Beneficiario'), array())
                ->joinleft(array('p' => 'Pessoa'), 'b.Pessoa = p.AutoId', array())
                ->joinleft(array('m' => 'EmailPessoa'), 'm.pessoa = p.autoid', array('*'))
                ->where('b.AutoId = ? ', $userId)
                ->where('m.fimvigencia is null');

        $emailUni = $unibenef->fetchAll($select)->current();

        $this->view->dadosEmail = $emailUni;

        //EXIBE OS DADOS DO BENEFICIARIO, PESSOA E ENDERECOPESSOA	
        $this->view->dadosEndereco = $this->carregaEnderecoBenef($userId);

        //EXIBE O MODULO DO BENEFICIARIO			
        $this->view->dadosModulo = $this->carregaModuloBenef($userId);

        //EXIBE OS DADOS LOCAL ATENDIMENTO		
        $this->view->dadosAtendimento = $this->carregaLocalAtendimentoBene($userId)->current();

        //EXIBE LOTACAO
        $this->view->dadosLotacao = $this->carregaLotacaoBenef($userId)->current();

        /* $reg = $this->view->dados;
          $reg = $reg->current(); */

        /* EXIBE OS DEPENDENTES */
        $this->view->dadosDependente = $this->carregaDependentes($this->view->dados['Familia'], $user->contrato);

        $this->view->rdp = $this->vRdp;
    }

    public function jsonindexAction() {

        $user = Zend_Registry::get('zend_auth_user');
        if ($user == null or @$user->contrato == null)
            exit;

        $dbCardio = Zend_Registry::get('dbcardio');

        $select = $dbCardio->select();
        $select->from(array('b' => 'Beneficiario'), array('b.AutoId', 'b.contrato', 'b.Codigo', 'b.matricula', 'b.pessoa'))
                ->join(array('p' => 'Pessoa'), 'b.pessoa = p.AutoId', array('p.nome', 'p.Cnp'))
                ->where('b.contrato = ? and b.RDP = 0', $user->contrato)
                ->where('not exists( select 1 from suspensaovinculo sv
                                      where sv.vinculorescindido=1 and sv.Beneficiario=b.AutoId)')
                ->order('p.nome');


        $tab = $dbCardio->fetchAll($select);

        $this->view->teste = $tab;

        $data['page'] = 1;

        foreach ($tab as $id => $row) {
            $rows[] = array(
                "id" => $row['AutoId'],
                "cell" => array(
                    $row['Codigo'],
                    $row['Cnp'],
                    $row['nome'],
                    $row['matricula'],
                )
            );
        }

        $data['rows'] = $rows;

        echo json_encode($data);
        exit;
    }

    public function jsonalteradosAction() {

        $user = Zend_Registry::get('zend_auth_user');
        if ($user == null or @$user->contrato == null)
            exit;

        $beneficiario = new Application_Model_DbTable_Beneficiario();

        $select = $beneficiario->select();
        $select->setIntegrityCheck(false);
        $select->from(array('b' => 'beneficiario'), array('*'))
                ->where('lote is null')
                ->where('Contrato = ?', $user->contrato)
                ->where('status in (1,2)');

        //echo $select; exit;

        $tab = $beneficiario->fetchAll($select);

        $this->view->teste = $tab;

        $data['page'] = 1;

        foreach ($tab as $id => $row) {
            $rows[] = array(
                "id" => $row['idBeneficiario'],
                "cell" => array(
                    $row['Nome'],
                    ($row['Sexo'] == "F") ? "Feminino" : "Masculino",
                    $this->nomeRDP($row['RDP']),
                )
            );
        }

        $data['rows'] = $rows;

        echo json_encode($data);
        exit;
    }

    public function cadAction() {

        $user = Zend_Registry::get('zend_auth_user');
        if ($user == null or @$user->contrato == null)
            exit;

        $request = $this->getRequest();

        $beneficiario = new Application_Model_DbTable_Beneficiario();
        $registro = new Application_Model_DbTable_Registro();
        $email = new Application_Model_DbTable_Email();
        $telefone = new Application_Model_DbTable_Telefone();
        $modulo = new Application_Model_DbTable_Modulo();
        $localAtendimento = new Application_Model_DbTable_LocalAtendimento();
        $lotacao = new Application_Model_DbTable_Lotacao();
        $endereco = new Application_Model_DbTable_Endereco();
        //modulobeneficiario
        //local de atendimento beneficiario
        //lotacao beneficiario
        //enderecobeneficiario

        $moduloDesc = $request->getParam('Modulo');
        $localDesc = $request->getParam('LocalAtendimento');
        $lotacaoDesc = $request->getParam('lotacao');

        //PEGA A Nome DO MODULO NO BANCO DA UNIMED
        $tab = new Application_Model_DbTable_Unibeneficiario();
        $select = $tab->select();
        $select->setIntegrityCheck(false);
        $select->from(array('o' => 'ModuloOperadora'), array('Nome', 'Codigo'))
                ->where('Codigo = ?', $moduloDesc);

        $NomeModulo = $tab->fetchAll($select)->current();

        /* SE NAO TIVER LOCAL DE ATENDIMENTO */
        if ($localDesc == null) {
            $NomeLocal['Nome'] = '';
        } else {
            //PEGA A Nome DO LOCAL ATENDIMENTO NO BANCO DA UNIMED
            $tab = new Application_Model_DbTable_Unibeneficiario();
            $select = $tab->select();
            $select->setIntegrityCheck(false);
            $select->from(array('o' => 'Pessoa'), array('Nome'))
                    ->where('AutoId = ?', $localDesc);

            $NomeLocal = $tab->fetchAll($select)->current();
        }

        /* SE NAO TIVER LOTACAO */
        if ($lotacaoDesc == null) {
            $NomeLotacao['Nome'] = '';
        } else {
            //PEGA A Nome DO LOTACAO NO BANCO DA UNIMED
            $tab = new Application_Model_DbTable_Unibeneficiario();
            $select = $tab->select();
            $select->setIntegrityCheck(false);
            $select->from(array('o' => 'LotacaoContrato'), array('Nome'))
                    ->where('Codigo = ?', $lotacaoDesc)
                    ->where('Contrato = ?', $user->contrato);

            $NomeLotacao = $tab->fetchAll($select)->current();
        }

        /* PEGA O NOME DA CIDADE E A UF se nulo nem entra */
        if ($request->getParam('idNaturalidade') != null) {
            $var = explode("/", $request->getParam('Naturalidade'));
            //$arrayReverso = array_reverse($var);			
            $cidadeNat = $var[0];
            $ufNat = $var[1];
        } else {
            $cidadeNat = null;
            $ufNat = null;
        }

        //PEGA O CODIGO DA FAMILIA GERADO
        $codFamilia = $this->novaFamilia($user->contrato);
        $nome = $this->removeAcento($request->getParam('Nome'));

        /* PEGA OS DADOS DO BENEFICIARIO */
        $inserir = array("Contrato" => $user->contrato,
            "Familia" => $codFamilia,
            "RDP" => 0,
            "IncluidoComoRN" => 0,
            "GrauDependencia" => 0,
            "InicioVigencia" => $this->dataSql($request->getParam('InicioVigencia')),
            //"CodigoExterno"	=> $this->dataSql($request->getParam('InicioVigencia')),
            "DataNascimento" => $this->dataSql($request->getParam('DataNascimento')),
            "Nome" => $nome,
            "Sexo" => $request->getParam('Sexo'),
            "EstadoCivil" => $request->getParam('EstadoCivil'),
            "Matricula" => $request->getParam('Matricula'),
            "Cnp" => $this->removePonto($request->getParam('Cnp')),
            "NomeMae" => $this->removeAcento($request->getParam('NomeMae')),
            "NomePai" => $this->removeAcento($request->getParam('NomePai')),
            "NomeConjuge" => $this->removeAcento($request->getParam('NomeConjuge')),
            "Naturalidade" => $request->getParam('idNaturalidade'),
            "NomeCidade" => $cidadeNat,
            "UF" => $ufNat,
            "DataAdmissao" => $this->dataSql($request->getParam('DataAdmissao')),
            "status" => 1
                //CodCarteirinha
        );

        $beneficiario->insert($inserir);
        /* SELECT PARA PEGAR O ULTIMO BENEFICIARIO INSERIDO */
        $select = $beneficiario->select();
        $select->setIntegrityCheck(false);
        $select->from(array('b' => 'beneficiario'), array('max(idBeneficiario) as beneficiario'));

        $reg = $beneficiario->fetchAll($select);
        $reg = $reg->current();

        $idBeneficiario = $reg['beneficiario'];
        /* DADOS DO REGISTRO */
        $dados = array("idBeneficiario" => $idBeneficiario,
            "RG" => $this->removePonto($request->getParam('RG')),
            "OrgaoExpeditor" => $request->getParam('Orgaoexpeditor'),
            "UF" => $request->getParam('UFRG'),
            "DataExpedicao" => $this->dataSql($request->getParam('dataExped')),
            "DecNascidoVivo" => $request->getParam('DecNascidoVivo'),
            "PIS" => $this->removePonto($request->getParam('PIS'))
        );
        /* DADOS DO EMAIL */
        $dados1 = array("idBeneficiario" => $idBeneficiario,
            "Email" => $request->getParam('Email'),
            "Seq" => 1,
            "InicioVigencia" => $this->dataSql($request->getParam('InicioVigencia')),
            "status" => 1,
        );
        /* DADOS DO TELEFONE */
        if ($request->getParam('DDD') == 0) {
            $ddd = null;
        } else {
            $ddd = $request->getParam('DDD');
        }
        $dados2 = array("idBeneficiario" => $idBeneficiario,
            "Seq" => 1,
            "SeqEnd" => 1,
            "DDD" => $ddd,
            "Tipo" => $request->getParam('Tipo'),
            "Numero" => $request->getParam('Numero'),
            "InicioVigencia" => $this->dataSql($request->getParam('InicioVigencia')),
            "status" => 1,
        );
        /* DADOS DO MODULO */
        $dados3 = array("idBeneficiario" => $idBeneficiario,
            "Codigo" => $request->getParam('Modulo'),
            "InicioVigencia" => $this->dataSql($request->getParam('InicioVigencia')),
            "Nome" => $NomeModulo['Nome'],
            "status" => 1,
        );
        /* DADOS DO LOCAL ATENDIMENTO */
        $dados4 = array("idBeneficiario" => $idBeneficiario,
            "Codigo" => $request->getParam('LocalAtendimento'),
            "InicioVigencia" => $this->dataSql($request->getParam('InicioVigencia')),
            "Nome" => $NomeLocal['Nome'],
            "status" => 1,
        );

        /* DADOS DO LOTACAO */
        $dados5 = array("idBeneficiario" => $idBeneficiario,
            "Codigo" => $request->getParam('lotacao'),
            "InicioVigencia" => $this->dataSql($request->getParam('InicioVigencia')),
            "Nome" => $NomeLotacao['Nome'],
            "status" => 1,
        );

        /* DADOS DO ENDERECO */
        if ($request->getParam('Naturalidade') != null) {
            $var = explode("/", $request->getParam('Naturalidade'));
            //$arrayReverso = array_reverse($var);			
            $cidade = $var[0];
            $uf = $var[1];
        } else {
            $cidade = null;
            $uf = null;
        }

        $dados6 = array("idBeneficiario" => $idBeneficiario,
            "Seq" => 1,
            "Logradouro" => $this->removeAcento($request->getParam('Logradouro')),
            "NumLogradouro" => $request->getParam('NumLogradouro'),
            "ComplLogradouro" => $this->removeAcento($request->getParam('ComplLogradouro')),
            "Tipo" => $request->getParam('EndTipo'),
            "Bairro" => $this->removeAcento($request->getParam('Bairro')),
            "Cidade" => $request->getParam('idCidade'),
            "NomeCidade" => $cidade,
            "UF" => $uf,
            "CEP" => $request->getParam('CEP'),
            "PontoReferencia" => $request->getParam('PontoReferencia'),
            "CaixaPostal" => $request->getParam('CaixaPostal'),
            "ParaCorrespondencia" => 1,
            "ParaFaturamento" => 1,
            "ParaCobranca" => 1,
            "ParaPublicacao" => 1,
            "InicioVigencia" => $this->dataSql($request->getParam('InicioVigencia')),
            "status" => 1,
        );

        $registro->insert($dados);
        $modulo->insert($dados3);

        if ($dados1['Email'] != '')
            $email->insert($dados1);

        if ($dados2['Numero'] != '')
            $telefone->insert($dados2);

        if ($dados4['Codigo'] != '')
            $localAtendimento->insert($dados4);

        if ($dados5['Codigo'] != '')
            $lotacao->insert($dados5);

        if ($dados6['Logradouro'] != '')
            $endereco->insert($dados6);

        //CADASTRAR
        //AGORA VAMOS PASSAR A FAMILIA PARA A TELA PARA PODER EFETUAR O CADASTRO DE UM DEPENDENTE AUTOMATICAMENTE
        $this->view->codFamilia = $codFamilia;
        $this->view->nome = $nome;
        $this->view->id = $idBeneficiario;
    }

    public function altAction() {

        $user = Zend_Registry::get('zend_auth_user');
        if ($user == null or @$user->contrato == null)
            exit;

        $request = $this->getRequest();

        $beneficiario = new Application_Model_DbTable_Beneficiario();
        $registro = new Application_Model_DbTable_Registro();
        $email = new Application_Model_DbTable_Email();
        $telefone = new Application_Model_DbTable_Telefone();
        $modulo = new Application_Model_DbTable_Modulo();
        $localAtendimento = new Application_Model_DbTable_LocalAtendimento();
        $lotacao = new Application_Model_DbTable_Lotacao();
        $endereco = new Application_Model_DbTable_Endereco();

        $moduloDesc = $request->getParam('Modulo');
        $localDesc = $request->getParam('LocalAtendimento');
        $lotacaoDesc = $request->getParam('lotacao');

        //PEGA A Nome DO MODULO NO BANCO DA UNIMED
        $tab = new Application_Model_DbTable_Unibeneficiario();
        $select = $tab->select();
        $select->setIntegrityCheck(false);
        $select->from(array('o' => 'ModuloOperadora'), array('Nome', 'Codigo'))
                ->where('Codigo = ?', $moduloDesc);

        $NomeModulo = $tab->fetchAll($select)->current();

        /* SE NAO TIVER LOCAL DE ATENDIMENTO */
        if ($localDesc == null) {
            $NomeLocal['Nome'] = '';
        } else {
            //PEGA A Nome DO LOCAL ATENDIMENTO NO BANCO DA UNIMED
            $tab = new Application_Model_DbTable_Unibeneficiario();
            $select = $tab->select();
            $select->setIntegrityCheck(false);
            $select->from(array('o' => 'Pessoa'), array('Nome'))
                    ->where('AutoId = ?', $localDesc);

            $NomeLocal = $tab->fetchAll($select)->current();
        }

        /* SE NAO TIVER LOTACAO */
        if ($lotacaoDesc == null) {
            $NomeLotacao['Nome'] = '';
        } else {
            //PEGA A Nome DO LOTACAO NO BANCO DA UNIMED
            $tab = new Application_Model_DbTable_Unibeneficiario();
            $select = $tab->select();
            $select->setIntegrityCheck(false);
            $select->from(array('o' => 'LotacaoContrato'), array('Nome'))
                    ->where('AutoId = ?', $lotacaoDesc);

            $NomeLotacao = $tab->fetchAll($select)->current();
        }

        /* INCLUIDO COMO RN
          if($request->getParam('IncluidoComoRN') == null){
          $IncluidoComoRN = 0;
          }else{
          $IncluidoComoRN = 1;
          } */

        //TESTA DE NATURALIDADE FOR NULO
        if ($request->getParam('idNaturalidade') != null) {
            $var = explode("/", $request->getParam('Naturalidade'));
            //$arrayReverso = array_reverse($var);			
            $cidadeNat = $var[0];
            $ufNat = $var[1];
        } else {
            $cidadeNat = null;
            $ufNat = null;
        }

        $alterar = array("Contrato" => $user->contrato,
            "Familia" => $request->getParam('Familia'),
            "RDP" => $request->getParam('RDP'),
            "IncluidoComoRN" => 0,
            //"GrauDependencia"	=> $request->getParam('GrauDependencia'),
            //"InicioVigencia"	=> $this->dataSql($request->getParam('InicioVigencia')),
            "FimVigencia" => $this->dataSql($request->getParam('FimVigencia')),
            //"CodigoExterno"	=> $this->dataSql($request->getParam('InicioVigencia')),
            //"DataNascimento"	=> $this->dataSql($request->getParam('DataNascimento')),
            "Nome" => $this->removeAcento($request->getParam('Nome')),
            "Sexo" => $request->getParam('Sexo'),
            "EstadoCivil" => $request->getParam('EstadoCivil'),
            "Naturalidade" => $request->getParam('idNaturalidade'),
            "NomeCidade" => $cidadeNat,
            "UF" => $ufNat,
            "Cnp" => $this->removePonto($request->getParam('Cnp')),
            "NomeMae" => $this->removeAcento($request->getParam('NomeMae')),
            "NomePai" => $this->removeAcento($request->getParam('NomePai')),
            "NomeConjuge" => $this->removeAcento($request->getParam('NomeConjuge')),
            "DataAdmissao" => $this->dataSql($request->getParam('DataAdmissao')),
            "status" => 2,
        );

        $where = "lote is null and idBeneficiario = " . $request->getParam('idBeneficiario');
        $beneficiario->update($alterar, $where);

        /* SELECT PARA PEGAR O ULTIMO BENEFICIARIO INSERIDO */
        $select = $beneficiario->select();
        $select->setIntegrityCheck(false);
        $select->from(array('b' => 'beneficiario'), array('max(idBeneficiario) as beneficiario'));

        $reg = $beneficiario->fetchAll($select);
        $reg = $reg->current();

        $idBeneficiario = $reg['beneficiario'];

        /* DADOS DO REGISTRO */
        $dados = array("RG" => $this->removePonto($request->getParam('RG')),
            "OrgaoExpeditor" => $request->getParam('Orgaoexpeditor'),
            "UF" => $request->getParam('UFRG'),
            "DataExpedicao" => $this->dataSql($request->getParam('dataExped')),
            "DecNascidoVivo" => $request->getParam('DecNascidoVivo'),
            "PIS" => $this->removePonto($request->getParam('PIS'))
        );
        /* DADOS DO EMAIL */
        $dados1 = array("Email" => $request->getParam('Email'),
            "Seq" => "1",
            "InicioVigencia" => $this->dataSql($request->getParam('InicioVigencia')),
        );
        /* DADOS DO TELEFONE */
        if ($request->getParam('DDD') == 0) {
            $ddd = null;
        } else {
            $ddd = $request->getParam('DDD');
        }
        $dados2 = array("DDD" => $ddd,
            "Tipo" => $request->getParam('Tipo'),
            "Numero" => $request->getParam('Numero'),
            "InicioVigencia" => $this->dataSql($request->getParam('InicioVigencia')),
            "status" => 1,
        );

        $registro->update($dados, $where);
        $email->update($dados1, $where);
        $telefone->update($dados2, $where);
        
        //ALTERAR
        $this->view->codFamilia = $request->getParam('Familia');
        $this->view->id = $request->getParam('idBeneficiario');
        $this->view->nome = $request->getParam('Nome');
    }

    public function altalteradosAction() {

        $user = Zend_Registry::get('zend_auth_user');
        if ($user == null or @$user->contrato == null)
            exit;

        $request = $this->getRequest();

        $beneficiario = new Application_Model_DbTable_Beneficiario();
        $registro = new Application_Model_DbTable_Registro();
        $email = new Application_Model_DbTable_Email();
        $telefone = new Application_Model_DbTable_Telefone();
        $modulo = new Application_Model_DbTable_Modulo();
        $localAtendimento = new Application_Model_DbTable_LocalAtendimento();
        $lotacao = new Application_Model_DbTable_Lotacao();
        $endereco = new Application_Model_DbTable_Endereco();

        $moduloDesc = $request->getParam('Modulo');
        $localDesc = $request->getParam('LocalAtendimento');
        $lotacaoDesc = $request->getParam('lotacao');


        if ($moduloDesc == null) {
            $NomeModulo['Nome'] = '';
        } else {
            //PEGA A Nome DO MODULO NO BANCO DA UNIMED
            $tab = new Application_Model_DbTable_Unibeneficiario();
            $select = $tab->select();
            $select->setIntegrityCheck(false);
            $select->from(array('o' => 'ModuloOperadora'), array('Nome', 'Codigo'))
                    ->where('Codigo = ?', $moduloDesc);

            $NomeModulo = $tab->fetchAll($select)->current();
        }
        /* SE NAO TIVER LOCAL DE ATENDIMENTO */
        if ($localDesc == null) {
            $NomeLocal['Nome'] = '';
        } else {
            //PEGA A Nome DO LOCAL ATENDIMENTO NO BANCO DA UNIMED
            $tab = new Application_Model_DbTable_Unibeneficiario();
            $select = $tab->select();
            $select->setIntegrityCheck(false);
            $select->from(array('o' => 'Pessoa'), array('Nome'))
                    ->where('AutoId = ?', $localDesc);

            $NomeLocal = $tab->fetchAll($select)->current();
        }

        /* SE NAO TIVER LOTACAO */
        if ($lotacaoDesc == null) {
            $NomeLotacao['Nome'] = '';
        } else {
            //PEGA A Nome DO LOTACAO NO BANCO DA UNIMED
            $tab = new Application_Model_DbTable_Unibeneficiario();
            $select = $tab->select();
            $select->setIntegrityCheck(false);
            $select->from(array('o' => 'LotacaoContrato'), array('Nome'))
                    ->where('AutoId = ?', $lotacaoDesc);

            $NomeLotacao = $tab->fetchAll($select)->current();
        }



        if ($request->getParam('Naturalidade') != null) {
            $var = explode("/", $request->getParam('Naturalidade'));
            //$arrayReverso = array_reverse($var);			
            $cidadeNat = $var[0];
            $ufNat = $var[1];
        } else {
            /* PEGA O NOME DA CIDADE E A UF se nulo nem entra */
            $cidadeNat = null;
            $ufNat = null;
        }

        $alterar = array("Contrato" => $user->contrato,
            "Familia" => $request->getParam('Familia'),
            "RDP" => $request->getParam('RDP'),
            "IncluidoComoRN" => 0,
            //"GrauDependencia"	=> $this->codigoDependencia($request->getParam('RDP')),
            "InicioVigencia" => $this->dataSql($request->getParam('InicioVigencia')),
            "FimVigencia" => $this->dataSql($request->getParam('FimVigencia')),
            //"CodigoExterno"	=> $this->dataSql($request->getParam('InicioVigencia')),
            "DataNascimento" => $this->dataSql($request->getParam('DataNascimento')),
            "Nome" => $this->removeAcento($request->getParam('Nome')),
            "Sexo" => $request->getParam('Sexo'),
            "EstadoCivil" => $request->getParam('EstadoCivil'),
            "Naturalidade" => $request->getParam('idNaturalidade'),
            "Cnp" => $this->removePonto($request->getParam('Cnp')),
            "NomeMae" => $this->removeAcento($request->getParam('NomeMae')),
            "NomePai" => $this->removeAcento($request->getParam('NomePai')),
            "NomeCidade" => trim($cidadeNat),
            "UF" => trim($ufNat),
            "NomeConjuge" => $this->removeAcento($request->getParam('NomeConjuge')),
            "DataAdmissao" => $this->dataSql($request->getParam('DataAdmissao')),
            "status" => 2,
        );

        $where = "idBeneficiario = " . $request->getParam('idBeneficiario');
        $beneficiario->update($alterar, $where);

        /* SELECT PARA PEGAR O ULTIMO BENEFICIARIO INSERIDO */
        $select = $beneficiario->select();
        $select->setIntegrityCheck(false);
        $select->from(array('b' => 'beneficiario'), array('max(idBeneficiario) as beneficiario'));

        $reg = $beneficiario->fetchAll($select);
        $reg = $reg->current();

        $idBeneficiario = $reg['beneficiario'];

        /* DADOS DO REGISTRO */
        $dados = array(
            "RG" => $request->getParam('RG'),
            "OrgaoExpeditor" => $request->getParam('Orgaoexpeditor'),
            "UF" => $request->getParam('UFRG'),
            "DataExpedicao" => $this->dataSql($request->getParam('dataExped')),
            "DecNascidoVivo" => $request->getParam('DecNascidoVivo'),
            "PIS" => $request->getParam('PIS')
        );

        /* DADOS DO EMAIL */
        $dados1 = array("Email" => $request->getParam('Email'),
            "Seq" => "1",
            "InicioVigencia" => $this->dataSql($request->getParam('InicioVigencia')),
        );
        /* DADOS DO TELEFONE */
        if ($request->getParam('DDD') == 0) {
            $ddd = null;
        } else {
            $ddd = $request->getParam('DDD');
        }
        $dados2 = array("DDD" => $ddd,
            "Tipo" => $request->getParam('Tipo'),
            "Numero" => $request->getParam('Numero'),
            "InicioVigencia" => $this->dataSql($request->getParam('InicioVigencia')),
        );

        $registro->update($dados, $where);
        $email->update($dados1, $where);
        $telefone->update($dados2, $where);
    }

    public function caddependenteAction() {

        $user = Zend_Registry::get('zend_auth_user');
        if ($user == null or @$user->contrato == null)
            exit;

        $request = $this->getRequest();


        if ($request->getParam('bloqueia') != null) {
            $beneficiario = new Application_Model_DbTable_Beneficiario();
            $registro = new Application_Model_DbTable_Registro();
            $email = new Application_Model_DbTable_Email();
            $telefone = new Application_Model_DbTable_Telefone();
            $modulo = new Application_Model_DbTable_Modulo();
            $localAtendimento = new Application_Model_DbTable_LocalAtendimento();
            $lotacao = new Application_Model_DbTable_Lotacao();
            $endereco = new Application_Model_DbTable_Endereco();

            //modulobeneficiario
            //local de atendimento beneficiario
            //lotacao beneficiario
            //enderecobeneficiario

            $moduloDesc = $request->getParam('Modulo');
            $localDesc = $request->getParam('LocalAtendimento');
            $lotacaoDesc = $request->getParam('lotacao');

            $tab = new Application_Model_DbTable_Unibeneficiario();
            $select = $tab->select();
            $select->setIntegrityCheck(false);
            $select->from(array('o' => 'ModuloOperadora'), array('Nome', 'Codigo'))
                    ->where('Codigo = ?', $moduloDesc);

            $NomeModulo = $tab->fetchAll($select)->current();


            if ($request->getParam('Naturalidade') != null) {
                /* PEGA O NOME DA CIDADE E A UF PARA O CAMPO NATURALIDADE */
                $var = explode("/", $request->getParam('Naturalidade'));
                //$arrayReverso = array_reverse($var);			
                $cidadeNat = $var[0];
                $ufNat = $var[1];
            } else {
                $cidadeNat = null;
                $ufNat = null;
            }


            /* PEGA O NOME DA CIDADE E A UF PARA O ENDERECO */
            $var = explode("/", $request->getParam('Cidade'));
            //$arrayReverso = array_reverse($var);			
            $cidadeEnd = $var[0];
            $ufEnd = $var[1];



            /* SE NAO TIVER LOCAL DE ATENDIMENTO */
            if ($localDesc == null) {
                $NomeLocal['Nome'] = '';
            } else {
                //PEGA A Nome DO LOCAL ATENDIMENTO NO BANCO DA UNIMED
                $tab = new Application_Model_DbTable_Unibeneficiario();
                $select = $tab->select();
                $select->setIntegrityCheck(false);
                $select->from(array('o' => 'Pessoa'), array('Nome'))
                        ->where('AutoId = ?', $localDesc);

                $NomeLocal = $tab->fetchAll($select)->current();
            }

            /* SE NAO TIVER LOTACAO
              if($lotacaoDesc == null){
              $NomeLotacao['Nome'] = '';
              }else{
              //PEGA A Nome DO LOTACAO NO BANCO DA UNIMED
              $tab = new Application_Model_DbTable_Unibeneficiario();
              $select = $tab->select();
              $select ->setIntegrityCheck(false);
              $select	->from(array('o' => 'LotacaoContrato'),array('Nome'))
              ->where('Codigo = ?', $lotacaoDesc );

              $NomeLotacao =  $tab->fetchAll($select)->current();
              } */

            $idFamilia = $request->getParam('Familia');
            //passando id
            $idTitular = $request->getParam('idTitular');
            // $idTitular = $request->getParam('idTitular');
            $nomeTitular = $request->getParam('nomeTitular');

            /* PEGA OS DADOS DO BENEFICIARIO */
            $inserir = array("Contrato" => $user->contrato,
                "Familia" => $idFamilia,
                "RDP" => $request->getParam('RDP'),
                "IncluidoComoRN" => 0,
                "GrauDependencia" => $this->codigoDependencia($request->getParam('RDP')),
                "InicioVigencia" => $this->dataSql($request->getParam('InicioVigencia')),
                //"CodigoExterno"	=> $this->dataSql($request->getParam('InicioVigencia')),
                "DataNascimento" => $this->dataSql($request->getParam('DataNascimento')),
                "Nome" => $this->removeAcento($request->getParam('Nome')),
                "Sexo" => $request->getParam('Sexo'),
                "EstadoCivil" => $request->getParam('EstadoCivil'),
                "Naturalidade" => $request->getParam('idNaturalidade'),
                "NomeCidade" => $cidadeNat,
                "UF" => $ufNat,
                "Cnp" => $this->removePonto($request->getParam('Cnp')),
                "NomeMae" => $this->removeAcento($request->getParam('NomeMae')),
                "NomePai" => $this->removeAcento($request->getParam('NomePai')),
                "NomeConjuge" => $this->removeAcento($request->getParam('NomeConjuge')),
                "status" => 1
                    //CodCarteirinha
            );

            $beneficiario->insert($inserir);
            /* SELECT PARA PEGAR O ULTIMO BENEFICIARIO INSERIDO */
            $select = $beneficiario->select();
            $select->setIntegrityCheck(false);
            $select->from(array('b' => 'beneficiario'), array('max(idBeneficiario) as beneficiario'));

            $reg = $beneficiario->fetchAll($select);
            $reg = $reg->current();

            $idBeneficiario = $reg['beneficiario'];
            /* DADOS DO REGISTRO */
            $dados = array("idBeneficiario" => $idBeneficiario,
                "RG" => $this->removePonto($request->getParam('RG')),
                "OrgaoExpeditor" => $request->getParam('Orgaoexpeditor'),
                "UF" => $request->getParam('UFRG'),
                "DataExpedicao" => $this->dataSql($request->getParam('dataExped')),
                "DecNascidoVivo" => $request->getParam('DecNascidoVivo'),
                "PIS" => $this->removePonto($request->getParam('PIS'))
            );
            /* DADOS DO EMAIL */
            $dados1 = array("idBeneficiario" => $idBeneficiario,
                "Email" => $request->getParam('Email'),
                "Seq" => "1",
                "InicioVigencia" => $this->dataSql($request->getParam('InicioVigencia')),
                "status" => 1,
            );
            /* DADOS DO TELEFONE */
            if ($request->getParam('DDD') == 0) {
                $ddd = null;
            } else {
                $ddd = $request->getParam('DDD');
            }
            $dados2 = array("idBeneficiario" => $idBeneficiario,
                "DDD" => $ddd,
                "Tipo" => $request->getParam('Tipo'),
                "Numero" => $request->getParam('Numero'),
                "SeqEnd" => 1,
                "Seq" => 1,
                "InicioVigencia" => $this->dataSql($request->getParam('InicioVigencia')),
                "status" => 1,
            );
            /* DADOS DO MODULO */
            $dados3 = array("idBeneficiario" => $idBeneficiario,
                "Codigo"            => $request->getParam('Modulo'),
                "InicioVigencia"    => $this->dataSql($request->getParam('InicioVigencia')),
                "Nome"              => $NomeModulo['Nome'],
                "status"            => 1,
            );

            /* DADOS DO LOCAL ATENDIMENTO */
            $dados4 = array("idBeneficiario" => $idBeneficiario,
                "Codigo" => $request->getParam('LocalAtendimento'),
                "InicioVigencia" => $this->dataSql($request->getParam('InicioVigencia')),
                "Nome" => $NomeLocal['Nome'],
                "status" => 1,
            );


            /* DADOS DO LOTACAO */
            $dados5 = array("idBeneficiario" => $idBeneficiario,
                "Codigo" => $request->getParam('lotacao'),
                "InicioVigencia" => $this->dataSql($request->getParam('InicioVigencia')),
                "Nome" => $request->getParam('nome'),
                "status" => 1,
            );

            /* DADOS DO ENDERECO */
            $dados6 = array("idBeneficiario" => $idBeneficiario,
                "Seq" => 1,
                "Logradouro" => $this->removeAcento($request->getParam('Logradouro')),
                "NumLogradouro" => $request->getParam('NumLogradouro'),
                "ComplLogradouro" => $this->removeAcento($request->getParam('ComplLogradouro')),
                "Tipo" => $request->getParam('Endtipo'),
                "Bairro" => $this->removeAcento($request->getParam('Bairro')),
                "Cidade" => $request->getParam('idCidade'),
                "NomeCidade" => $cidadeEnd,
                "UF" => $ufEnd,
                "CEP" => $request->getParam('CEP'),
                "PontoReferencia" => $request->getParam('PontoReferencia'),
                "CaixaPostal" => $request->getParam('CaixaPostal'),
                "ParaCorrespondencia" => 1,
                "ParaFaturamento" => 1,
                "ParaCobranca" => 1,
                "ParaPublicacao" => 1,
                "InicioVigencia" => $this->dataSql($request->getParam('InicioVigencia')),
                "status" => 1,
            );

            $registro->insert($dados);
            $modulo->insert($dados3);

            if ($dados1['Email'] != '')
                $email->insert($dados1);

            if ($dados2['Numero'] != '')
                $telefone->insert($dados2);

            if ($dados4['Codigo'] != '')
                $localAtendimento->insert($dados4);

            if ($dados5['Codigo'] != '')
                $lotacao->insert($dados5);

            if ($dados6['Logradouro'] != '')
                $endereco->insert($dados6);

            //PASSAR DADOS PARA A VIEW
            //PASSAR DADOS PARA A VIEW
            //PASSAR DADOS PARA A VIEW
            //PASSAR DADOS PARA A VIEW
            $this->view->codFamilia = $idFamilia;
            $this->view->nome = $nomeTitular;
            $this->view->id = $idTitular;
        }else {
            $user = Zend_Registry::get('zend_auth_user');
            $contrato = $user->contrato;

            //TESTE DE RDP 
            $beneficiario = new Application_Model_DbTable_Beneficiario();

            //BD UNIMED 
            $unibeneficiario = new Application_Model_DbTable_Unibeneficiario();

            //pegando parametros enviados
            $request = $this->getRequest();

            //familia
            $familia = $request->getParam('Familia');



            //PEGA O IDBENEFICIARIO
            $select = $beneficiario->select();
            $select->where('RDP = ?', $request->getParam('RDP'))
                    ->where('Familia = ?', $familia)
                    ->where('Contrato = ?', $contrato);

            $select_uni = $unibeneficiario->select();
            $select_uni->where('RDP = ?', $request->getParam('RDP'))
                    ->where('Familia = ?', $familia)
                    ->where('Contrato = ?', $contrato);

            $select1 = $beneficiario->fetchall($select);
            $select2 = $unibeneficiario->fetchall($select_uni);



            if ($select1->count() >= 1 or $select2->count() >= 1) {
                echo "1";
            }
            exit;
        }
    }

    public function dependentesAction() {

        $beneficiarioCardio = new Application_Model_DbTable_Unibeneficiario();
        $beneficiario = new Application_Model_DbTable_Beneficiario();
        $endereco = new Application_Model_DbTable_Endereco();
        $lotacao = new Application_Model_DbTable_Lotacao();
        $telefone = new Application_Model_DbTable_Telefone();

        $user = Zend_Registry::get('zend_auth_user');
        if ($user == null or @$user->contrato == null)
            exit;
        $pegaUser = $this->getRequest();
        $userId = $pegaUser->getParam('id');
        $this->view->id = $this->getRequest()->getParam('id');
        $this->view->familia = $this->getRequest()->getParam('familia');
        $this->view->nome = $this->getRequest()->getParam('nome');
        $contrato = $user->contrato;


        $select = $telefone->select();
        $select->where('idBeneficiario = ?', $userId)
                ->order('idTelefone desc')
                ->limit(1);
        $this->view->dadosTel = $telefone->fetchAll($select);

        //EXIBE OS DADOS DO BENEFICIARIO, PESSOA E ENDERECOPESSOA DIRETO DA UNIMED 	
        $select = $endereco->select();
        $select->where('idBeneficiario = ?', $userId);

        $resultado = $endereco->fetchAll($select);

        /* SE NAO RETONAR NADA DO ENDERECO NO NOSSO BANCO, PEGA NO BANCO DA UNIMED */
        if ($resultado->count() > 0) {
            $this->view->dadosEndereco = $resultado;
        } else {
            $this->view->dadosEndereco = $this->carregaEnderecoBenef($userId);
        }

        /* SELECT PARA PEGAR A LOTACAO DO TITULAR */
        $select = $beneficiarioCardio->select();
        $select->where('familia = ?', $this->getRequest()->getParam('familia'))
                ->where('contrato = ?', $contrato)
                ->where('RDP = 0');

        $lotacaoDepe = $beneficiarioCardio->fetchAll($select)->current();

        /* SE NAO ACHAR NO BANCO DA UNIMED PROCURA NO DA SEASON */
        if ($lotacaoDepe['AutoId'] != null) {
            $tab = new Application_Model_DbTable_Unibeneficiario();
            $select = $tab->select();
            $select->setIntegrityCheck(false);
            $select->from(array('l' => 'LotacaoBeneficiario'), array('InicioVigencia', 'FimVigencia', 'AutoId'))
                    ->joinLeft(array('c' => 'LotacaoContrato'), 'l.Lotacao = c.AutoId', array('Nome', 'Codigo'))
                    ->where('l.beneficiario = ?', $lotacaoDepe['AutoId']);

            $this->view->dadosLotacao = $tab->fetchAll($select)->current();
        } else {

            $select = $beneficiario->select();
            $select->setIntegrityCheck(false);
            $select->from(array('b' => 'beneficiario'), array())
                    ->join(array('l' => 'lotacao'), 'b.idbeneficiario=l.idbeneficiario', array('*'))
                    ->where('familia = ?', $this->getRequest()->getParam('familia'))
                    ->where('contrato = ?', $contrato)
                    ->where('RDP = 0');

            $this->view->dadosLotacao = $beneficiario->fetchAll($select)->current();
        }


        $this->view->rdp = $this->vRdp;

        //$this->carregaLotacaoContrato($user->contrato);
        $this->carregaLocalAtendimentoContrato($user->contrato);

        $this->view->dadosModulo = $this->carregaModuloContrato($user->contrato);

        $this->view->dadosLocalAtendimento = $this->carregaLocalAtendimentoContrato($user->contrato);
    }

    public function enviaralteracoesAction() {

        /*
          ação para listar alterações feitas nesse contrato
          ou seja select where contrato = esse  and estado = 1
         */
        $user = Zend_Registry::get('zend_auth_user');
        if ($user == null or @$user->contrato == null)
            exit;

        $beneficiario = new Application_Model_DbTable_Beneficiario();



        $select = $beneficiario->select();
        $select->setIntegrityCheck(false);
        $select->from(array('b' => 'beneficiario'), array('*'))
                ->join(array('m' => 'modulo'), 'b.idbeneficiario = m.idbeneficiario', array('Nome as NomePlano'))
                ->where('contrato = ? and b.lote is null ', $user->contrato)
                ->where('m.fimVigencia is null')
                ->where('b.status in (1,2,3)');


        $this->view->listaBeneficiario = $beneficiario->fetchall($select);
    }

    public function pesqcidadeAction() {
        $request = $this->getRequest();
        $benefs = $request->getParam('q') . '%';

        $func = 'selLocalidade';
        if ($request->getParam('t') == 1) {
            $func = 'selCidade';
        }
        $tab = new Application_Model_DbTable_Unibeneficiario();
        $select = $tab->select();
        $select->setIntegrityCheck(false);
        $select->from(array('o' => 'cidadePais'), array('Nome', 'Codigo', 'UF'))
                ->where('Nome like ?', $benefs)
                ->limit(10);


        $lista = $tab->fetchAll($select);
        if (count($lista) == 0) {
            echo "Nenhuma cidade encontrada";
            exit;
        }
        echo "<table>";
        foreach ($lista as $reg) {
            echo "<tr><td><a href='javascript:$func($reg[Codigo],\"$reg[Nome] / $reg[UF]\")'>$reg[Nome] / $reg[UF]</a></td></tr>";
        }
        echo "</table>";
        exit;
    }

    public function confirmaalteracoesAction() {
        $user = Zend_Registry::get('zend_auth_user');
        if ($user == null or @$user->contrato == null)
            exit;

        $request = $this->getRequest();
        $benefs = $request->getParam('benef');
        if (count($benefs) > 0) {
            $lote = new Application_Model_DbTable_Lote();
            $vals = array("contrato" => $user->contrato,
                "idLogin" => $user->id,
                "status" => 1);
            $idlote = $lote->insert($vals);

            $beneficiario = new Application_Model_DbTable_Beneficiario();
            $registro = new Application_Model_DbTable_Registro();
            $email = new Application_Model_DbTable_Email();
            $telefone = new Application_Model_DbTable_Telefone();
            $modulo = new Application_Model_DbTable_Modulo();
            $localAtendimento = new Application_Model_DbTable_LocalAtendimento();
            $lotacao = new Application_Model_DbTable_Lotacao();
            $endereco = new Application_Model_DbTable_Endereco();


            $vals = array('lote' => $idlote);
            $beneficiario->update($vals, 'idBeneficiario in (' . implode(',', $benefs) . ')');
            $registro->update($vals, 'idBeneficiario in (' . implode(',', $benefs) . ')');
            $email->update($vals, 'idBeneficiario in (' . implode(',', $benefs) . ')');
            $telefone->update($vals, 'idBeneficiario in (' . implode(',', $benefs) . ')');
            $modulo->update($vals, 'idBeneficiario in (' . implode(',', $benefs) . ')');
            $localAtendimento->update($vals, 'idBeneficiario in (' . implode(',', $benefs) . ')');
            $lotacao->update($vals, 'idBeneficiario in (' . implode(',', $benefs) . ')');
            $endereco->update($vals, 'idBeneficiario in (' . implode(',', $benefs) . ')');

            foreach ($benefs as $i => $v) {
                $select = $beneficiario->select();
                $select->setIntegrityCheck(false);
                $select->from(array('b' => 'beneficiario'), array('*'))
                        ->join(array('m' => 'modulo'), 'b.idbeneficiario = m.idbeneficiario', array('Nome as NomePlano'))
                        ->where("b.idBeneficiario = ?", $v);

                $resultado = $beneficiario->fetchall($select)->current();

                $lista[$v] = array(
                    'Nome' => $resultado["Nome"],
                    'Cnp' => $resultado["Cnp"],
                    'NomePlano' => $resultado["NomePlano"],
                    'RDP' => $resultado["RDP"]
                );
            }

            $this->view->lista = $lista;
            $this->view->contrato = $user->contrato;
            $this->view->lote = $idlote;
        }
    }

    public function suspenderAction() {
        //ACTION PARA SUSPENDER BENEFICIARIO, RECEBE COMO PARAMETRO O ID DO BENEF
        $request = $this->getRequest();

        $this->view->nome = $request->getParam('nome');
        $this->view->id = $request->getParam('id');
    }

    public function confirmasuspensaoAction() {

        //ACTION PARA SUSPENDER BENEFICIARIO, RECEBE COMO PARAMETRO O ID DO BENEF
        $request = $this->getRequest();

        $beneficiario = new Application_Model_DbTable_Beneficiario();

        $this->puxaBenef($request->getParam('id'));

        $fimVigencia = date("Y-m-d");

        //NOVO FIM DE VIGENCIA
        //$fimVigencia = $request->getParam('dia');



        $dados = array("FimVigencia" => $fimVigencia,
            "status" => 3);

        $where = "AutoId = " . $request->getParam('id');

        $beneficiario->update($dados, $where);
        //echo $request->getParam('id');		

        echo "1";
        exit;
    }

    public function deletarAction() {
        $benef = new Application_Model_DbTable_Beneficiario();
        $telefone = new Application_Model_DbTable_Telefone();
        $endereco = new Application_Model_DbTable_Endereco();
        $email = new Application_Model_DbTable_Email();
        $modulo = new Application_Model_DbTable_Modulo();
        $local = new Application_Model_DbTable_LocalAtendimento();
        $lotacao = new Application_Model_DbTable_Lotacao();
        $registro = new Application_Model_DbTable_Registro();

        $request = $this->getRequest();
        $idBeneficiario = $request->getParam('id');

        $where = "idBeneficiario = " . $idBeneficiario;


        $telefone->delete($where);
        $endereco->delete($where);
        $email->delete($where);
        $modulo->delete($where);
        $local->delete($where);
        $lotacao->delete($where);
        $registro->delete($where);
        $benef->delete($where);

        $this->_redirect('/beneficiario/enviaralteracoes');
    }

}