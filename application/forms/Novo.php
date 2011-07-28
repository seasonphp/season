<?php

class Application_Form_Novo extends Zend_Dojo_Form
{

    public function init()
    {
        $this->setName('frmPesquisa');
		$this->setMethod('post');

		
		$contratante = new Zend_Form_Element_Text('Contratante');
		$contratante->setLabel('Contratante');

		$rdp = new Zend_Form_Element_Text('RDP');
		$rdp->setLabel('RDP');
		
		$nome = new Zend_Form_Element_Text('Nome');
		$nome->setLabel('Nome');
		
		
		$sexo = new Zend_Form_Element_Text('Sexo');
		$sexo->setLabel('Sexo');		
		
		$nomeMae = new Zend_Form_Element_Text('NomeMae');
		$nomeMae->setLabel('NomeMae');
		
		$nomeConjuge = new Zend_Form_Element_Text('NomeConjuge');
		$nomeConjuge->setLabel('NomeConjuge');
		
		$titular = new Zend_Form_Element_Text('Titular');
		$titular->setLabel('Titular');
		
		$modulo = new Zend_Form_Element_Text('Modulo');
		$modulo->setLabel('Modulo');
		
		$localAtendimento = new Zend_Form_Element_Text('LocalAtendimento');
		$localAtendimento->setLabel('LocalAtendimento');
		
		$lotacao = new Zend_Form_Element_Text('Lotacao');
		$lotacao->setLabel('Lotacao');
		
		$SEQ = new Zend_Form_Element_Text('SEQ');
		$SEQ->setLabel('SEQ');
		
		$logradouro = new Zend_Form_Element_Text('Logradouro');
		$logradouro->setLabel('Logradouro');
		
		$numero = new Zend_Form_Element_Text('Numero');
		$numero->setLabel('Numero');
		
		$complemento = new Zend_Form_Element_Text('Complemento');
		$complemento->setLabel('Complemento');
		
		$tipo = new Zend_Form_Element_Text('Tipo');
		$tipo->setLabel('Tipo');
		
		$bairro = new Zend_Form_Element_Text('Bairro');
		$bairro->setLabel('Bairro');
		
		$cidade = new Zend_Form_Element_Text('Cidade');
		$cidade->setLabel('Cidade');
		
		$cep = new Zend_Form_Element_Text('CEP');
		$cep->setLabel('CEP');
		
		$pontoReferencia = new Zend_Form_Element_Text('PontoReferencia');
		$pontoReferencia->setLabel('PontoReferencia');
		
		$caixaPostal = new Zend_Form_Element_Text('CaixaPostal');
		$caixaPostal->setLabel('CaixaPostal');
		
		$caixaPostalInicio = new Zend_Form_Element_Text('CaixaPostalInicioVigencia');
		$caixaPostalInicio->setLabel('CaixaPostalInicioVigencia');
		
		$caixaPostalFim = new Zend_Form_Element_Text('CaixaPostalFimVigencia');
		$caixaPostalFim->setLabel('CaixaPostalFimVigencia');
		
		$correspondencia = new Zend_Form_Element_Text('Correspondecia');
		$correspondencia->setLabel('Correspondecia');
		
		$cobranca = new Zend_Form_Element_Text('Cobranca');
		$cobranca->setLabel('Cobranca');
		
		$fechamento = new Zend_Form_Element_Text('Fechamento');
		$fechamento->setLabel('Fechamento');
		
		$contratoInicio = new Zend_Form_Element_Text('ContratoInicioVigencia');
		$contratoInicio->setLabel('ContratoInicioVigencia');
		
		$contratoFim = new Zend_Form_Element_Text('ContratoFimVigencia');
		$contratoFim->setLabel('ContratoFimVigencia');
		
		$nascimento = new Zend_Form_Element_Text('Nascimento');
		$nascimento->setLabel('Nascimento');
		
		$estadoCivil = new Zend_Form_Element_Text('EstadoCivil');
		$estadoCivil->setLabel('EstadoCivil');
		
		$cnp = new Zend_Form_Element_Text('CNP');
		$cnp->setLabel('CNP');
		
		$pis = new Zend_Form_Element_Text('PIS');
		$pis->setLabel('PIS');
		
		$nomePai = new Zend_Form_Element_Text('NomePai');
		$nomePai->setLabel('NomePai');
		
		$admissao = new Zend_Form_Element_Text('Admissao');
		$admissao->setLabel('Admissao');
		
		$matricula = new Zend_Form_Element_Text('Matricula');
		$matricula->setLabel('Matricula');
		
		$email = new Zend_Form_Element_Text('Email');
		$email->setLabel('Email');
		
		$telefone = new Zend_Form_Element_Text('Telefone');
		$telefone->setLabel('Telefone');
		
		$fechamento = new Zend_Form_Element_Text('Fechamento');
		$fechamento->setLabel('Fechamento');
		
		$moduloInicio = new Zend_Form_Element_Text('ModuloInicioFatura');
		$moduloInicio->setLabel('ModuloInicioFatura');
		
		$moduloFim = new Zend_Form_Element_Text('ModuloFimFatura');
		$moduloFim->setLabel('ModuloFimFatura');
		
		$localAtendInicio = new Zend_Form_Element_Text('LocalAtendimentoInicioVigencia');
		$localAtendInicio->setLabel('LocalAtendimentoInicioVigencia');
		
		$localAtendFim = new Zend_Form_Element_Text('LocalAtendimentoFimVigencia');
		$localAtendFim->setLabel('LocalAtendimentoFimVigencia');
		
		$lotacaoInicio = new Zend_Form_Element_Text('LotacaoInicioVigencia');
		$lotacaoInicio->setLabel('LotacaoInicioVigencia');
		
		$lotacaoFim = new Zend_Form_Element_Text('LotacaoFimVigencia');
		$lotacaoFim->setLabel('LotacaoFimVigencia');
		   
		$submit = new Zend_Dojo_Form_Element_SubmitButton('Cadastrar beneficiario');

		$this->addElements(array($contratante,$rdp,$nome,$sexo,$nomeMae,$nomeConjuge,$titular,$modulo,$localAtendimento,$lotacao,$SEQ,$logradouro,$numero,$complemento,$tipo,$bairro,$cidade,$cep,$pontoReferencia,$caixaPostal,$caixaPostalInicio,$caixaPostalFim,$correspondencia,$cobranca,$fechamento,$contratoInicio,$contratoFim,$nascimento,$estadoCivil,$cnp,$pis,$nomePai,$admissao,$matricula,$email,$telefone,$fechamento,$moduloInicio,$moduloFim,$localAtendInicio,$localAtendFim,$lotacaoInicio,$lotacaoFim));   
		   
		
    }


}

