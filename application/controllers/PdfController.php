<?php

/**
 * PDF CONTROLLER

 * @author Raphael Valério
 * @author Paulo Victor
 * @author Pedro Ribeiro

 * @version 

 */
// Load Zend_Pdf class 
require_once 'Zend/Loader/Autoloader.php';

require_once 'Zend/Controller/Action.php';

class PdfController extends Zend_Controller_Action {

    //PDF DO CONFIRMA ALTERACOES 
    public function indexAction() {

        //echo $local = 'layouts/pequeno.png';
        //exit;

        $request = $this->getRequest();
        $contrato = $request->getParam('contrato');
        $lote = $request->getParam('lote');

        $beneficiario = new Application_Model_DbTable_Beneficiario();

        $select = $beneficiario->select();
        $select->setIntegrityCheck(false);
        $select->from(array('b' => 'beneficiario'), array('*'))
                ->joinleft(array('m' => 'modulo'), 'b.idBeneficiario = m.idBeneficiario', array('Nome as Modulo'))
                ->joinleft(array('l' => 'lotacao'), 'b.idBeneficiario = l.idBeneficiario', array('Nome as Lotacao'))
                ->where('b.lote = ? ', $lote);

        $tab_beneficiario = $beneficiario->fetchall($select);


        //N TENDEMO
        $loader = Zend_Loader_Autoloader::getInstance();

        try {
            //cria pdf
            $pdf = new Zend_Pdf();

            //cria formato A4
            $n = 0;
            $page[$n] = new Zend_Pdf_Page(Zend_Pdf_Page::SIZE_A4);

            //Define a fonte
            $font = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_HELVETICA);

            //buscando imagem
            $imagem = Zend_Pdf_Image::imageWithPath('imagens/pequeno.png');

            //Colocando imagem no PDF

            $page[$n]->drawImage($imagem, 20, 750, ($imagem->getPixelWidth() + 20), (750 + $imagem->getPixelHeight()));

            $user = Zend_Registry::get('zend_auth_user');
            //escreve na página
            $page[$n]->setFont($font, 10)
                    /*
                      COLUNA LINHA, COMEÇA DE BAIXO ¬¬
                      800 o máximpo de altura
                      564 0 máximo de largura
                     */
                    ->drawText('Comprovante - Movimentações cadastrais', 160, 730)
                    ->setFont($font, 12)
                    ->drawText('Contrato: ' . $contrato, 90, 690)
                    ->drawText('Empresa: '. $user->nome , 90, 670)
                    ->drawText('Numero do comprovante: ' . $lote, 90, 650)
                    ->setFont($font, 11)
                    ->drawText('Data: ' . date("d/m/Y"), 90, 630)
                    ->drawText('Beneficiarios: ', 90, 600)
                    ->setFont($font, 8);
            $pdf->pages[] = $page[$n];

            $altura = 585;
            //$pagina = -1;
            foreach ($tab_beneficiario as $key => $row) {

                if ($altura < 80) {
                    $altura = 780;
                    $n = $n + 1;
                    $page[$n] = new Zend_Pdf_Page(Zend_Pdf_Page::SIZE_A4);
                    $pdf->pages[] = $page[$n];
                }


                ($row['RDP'] == 0) ? $grau = "Titular" : $grau = "Dependente";
                ($row['Lotacao'] == null) ? $NomeLotacao = "Sem lotacao" : $NomeLotacao = $row['Lotacao'];
                ($row['status'] == 1) ? $Movtipo = "Inclusao" : ($row['status'] == 2) ? $Movtipo = "Alteracao" : $Movtipo = "Exclusao";

                $page[$n]->setFont($font, 8)
                        ->drawText('Nome: ' . $row['Nome'], 90, $altura-=10)
                        ->drawText('CPF: ' . $row['Cnp'], 90, $altura-=10)
                        ->drawText('Grau dependencia: ' . $grau, 90, $altura-=10)
                        ->drawText('Plano: ' . $row['Modulo'], 90, $altura-=10)
                        ->drawText('Lotação: ' . $NomeLotacao, 90, $altura-=10)
                        ->drawText('Tipo: ' . $Movtipo, 90, $altura-=10)
                        ->drawText('  ', 90, $altura-=10);
            }



            $page[$n]->setFont($font, 8)
                    ->drawText('Unimed Santos - Av. Dona Ana Costa, 211 - Encruzilhada - Santos - SP', 150, 20)
                    ->drawText('Cep: 11.060-001 - Tels.: (13) 2102-8100 / 8300 ', 150, 10);



            //adiciona página ao documento
            //$pdf->pages[] = $page[$n];

            $diretorio = "listapdf/" . $contrato . "/";
            chmod($diretorio, 0777);

            if (@opendir($diretorio) == false) {
                mkdir($diretorio, 0777);
            }

            //salva PDF 
            $pdf->save($diretorio . $lote . '.pdf');

            echo $nomePDF = $diretorio . $lote . '.pdf';

            /* cadastrar na tabela PDF com as seguintes informações
              o numero desse lote
              o contrato (ver sessão)
              a data (hoje)
              o caminho $nomePDF
             */

            $pdf = new Application_Model_DbTable_Pdf();

            $inserir = array(
                "contrato" => $contrato,
                "lote" => $lote,
                "data" => date('Y-m-d'),
                "caminho" => $nomePDF,
            );


            $pdf->insert($inserir);

            exit;
        } catch (Zend_Pdf_Exception $e) {
            die('PDF error: ' . $e->getMessage());
        } catch (Exception $e) {
            die('Application error: ' . $e->getMessage());
        }
    }

    public function testepdfAction() {


        // include auto-loader class
        require_once 'Zend/Loader/Autoloader.php';

        // register auto-loader
        $loader = Zend_Loader_Autoloader::getInstance();

        try {
            // create PDF
            $pdf = new Zend_Pdf();

            // create A4 page
            $n = 0;
            $page[] = new Zend_Pdf_Page(Zend_Pdf_Page::SIZE_A4);

            // define image resource
            $image = Zend_Pdf_Image::imageWithPath('imagens/pequeno.png');
            $font = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_HELVETICA);

            // write image to page
            $page[$n]->drawImage($image, 50, 50, 400, 400);

            for ($x = 1; $x < 10; $x++) {
                $page[$n] = new Zend_Pdf_Page(Zend_Pdf_Page::SIZE_A4);
                $page[$n]->setFont($font, 10)
                        ->drawText('Comprovante - Movimentações cadastrais', 160, 730);

                $pdf->pages[] = $page[$n];
                $n++;
            }

            // save as file
            $pdf->save('example.pdf');
            echo 'SUCCESS: Document saved!';
        } catch (Zend_Pdf_Exception $e) {
            die('PDF error: ' . $e->getMessage());
        } catch (Exception $e) {
            die('Application error: ' . $e->getMessage());
        }
    }

    public function xmlAction() {
        //AÇÃO PARA GERAR PDF do XML

        $lote_obj = new Application_Model_DbTable_Lote();
        $beneficiario = new Application_Model_DbTable_Beneficiario();


        //RECEBE O ID DO LOTE 
        $request = $this->getRequest();
        $lote = $request->getParam('lote');
        $contrato = $request->getParam('contrato');


        $select = $beneficiario->select();
        $select->where('lote = ? ', $lote);

        $tab_beneficiario = $beneficiario->fetchall($select);


        //COMEÇO A MONTAR O MALDITO PDF 
        $loader = Zend_Loader_Autoloader::getInstance();

        try {
            //cria pdf
            $pdf = new Zend_Pdf();

            //cria formato A4
            $n=0;
            $page[$n] = new Zend_Pdf_Page(Zend_Pdf_Page::SIZE_A4);

            //Define a fonte
            $font = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_HELVETICA);

            //buscando imagem
            $imagem = Zend_Pdf_Image::imageWithPath('imagens/pequeno.png');

            //Colocando imagem no PDF
            $page[$n]->drawImage($imagem, 20, 750, ($imagem->getPixelWidth() + 20), (750 + $imagem->getPixelHeight()));


            //escreve na página
            $page[$n]->setFont($font, 10)
                    /*
                      COLUNA LINHA, COMEÇA DE BAIXO ¬¬
                      800 o máximpo de altura
                      564 0 máximo de largura
                     */
                    ->drawText('Relatorios XML ', 160, 730)
                    ->setFont($font, 12)
                    ->drawText('Contrato: ' . $contrato, 90, 690)
                    ->drawText('Empresa: ', 90, 670)
                    ->drawText('Numero do lote: ' . $lote, 90, 650)
                    ->setFont($font, 11)
                    ->drawText('Data: ' . date("d/m/Y"), 90, 630)
                    ->drawText('Beneficiarios: ', 90, 600)
                    ->setFont($font, 8);
            //CRIANDO LAÇO
            $altura = 585;
            foreach ($tab_beneficiario as $key => $row) {

                if ($altura < 80) {
                    $altura = 780;
                    $n = $n + 1;
                    $page[$n] = new Zend_Pdf_Page(Zend_Pdf_Page::SIZE_A4);
                    $pdf->pages[] = $page[$n];
                }

                $page[$n]->setFont($font, 8)
                        ->drawText('Nome: ' . $row['Nome'], 90, $altura-=10)
                        ->drawText('CPF: ' . $row['Cnp'], 90, $altura-=10)
                        ->drawText('  ', 90, $altura-=10);
            }


            $page[$n]->setFont($font, 8)
                    ->drawText('Unimed Santos - Av. Dona Ana Costa, 211 - Encruzilhada - Santos - SP', 150, 20)
                    ->drawText('Cep: 11.060-001 - Tels.: (13) 2102-8100 / 8300 ', 150, 10);


            //adiciona página ao documento
            //$pdf->pages[] = $page;				

            $diretorio = "pdfxml/" . $contrato . "/";

            if (@opendir($diretorio) == false) {
                mkdir($diretorio, 0777);
            }

            //salva PDF 
            $pdf->save($diretorio . $lote . '.pdf');

            //Por fim, setamos a header como um PDF, e renderizamos o nosso $pdf;
            header('Content-type: application/pdf');
            echo $pdf->render();
            //$this->_redirect('/xml');
        } catch (Zend_Pdf_Exception $e) {
            die('PDF error: ' . $e->getMessage());
        } catch (Exception $e) {
            die('Application error: ' . $e->getMessage());
        }

        echo $lote;
        exit;
    }
}