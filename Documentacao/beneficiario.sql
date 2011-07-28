-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: Abr 28, 2011 as 06:26 PM
-- Versão do Servidor: 5.1.54
-- Versão do PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `unimed`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `beneficiario`
--

CREATE TABLE IF NOT EXISTS `beneficiario` (
  `idBeneficiario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(10) NOT NULL,
  `contrato` int(10) DEFAULT NULL,
  `familia` int(10) DEFAULT NULL,
  `rdp` int(10) DEFAULT NULL,
  `iniContratoVig` date DEFAULT NULL,
  `fimContratoVig` date DEFAULT NULL,
  `nomeBene` varchar(60) DEFAULT NULL,
  `sexo` varchar(1) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `estadoCivil` varchar(20) DEFAULT NULL,
  `naturalidade` varchar(20) DEFAULT NULL,
  `cnp` int(11) DEFAULT NULL,
  `pis` int(20) DEFAULT NULL,
  `nomeMae` varchar(60) DEFAULT NULL,
  `nomePai` varchar(60) DEFAULT NULL,
  `nomeConjug` varchar(60) DEFAULT NULL,
  `admissao` date DEFAULT NULL,
  `matricula` int(20) DEFAULT NULL,
  `titular` int(20) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `telefone` int(20) DEFAULT NULL,
	/* AQUI FICAVA O MODULO -> TABELA modulobeneficiario*/
	/* AQUI FICAVA O LOCAL DE ATENDIMENTO -> */
	/* AQUI FICAVA A LOTACAO */
	/* AQUI FICAVA O ENDERECO -> tabela EnderecoPessoa */
  `anexo` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`idBeneficiario`),
  KEY `beneficiario_FKIndex1` (`empresa_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;




--
-- Estrutura da tabela `EnderecoPessoa`
--

CREATE TABLE `unimed`.`EnderecoPessoa` (
`AutoId` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`Pessoa` INT( 10 ) NOT NULL ,
`Seq` INT( 10 ) NOT NULL ,
`Logradouro` VARCHAR( 150 ) NOT NULL ,
`NumLogradouro` INT( 10 ) NOT NULL ,
`CompLogradouro` VARCHAR( 150 ) NOT NULL ,
`Bairro` VARCHAR( 100 ) NOT NULL ,
`Cidade` VARCHAR( 100 ) NOT NULL ,
`CEP` INT( 8 ) NOT NULL ,
`PontoReferencia` VARCHAR( 100 ) NOT NULL ,
`CaixaPostal` VARCHAR( 100 ) NOT NULL ,
`Tipo` INT( 1 ) NOT NULL ,
`ParaCorrespondencia` BOOLEAN NOT NULL ,
`ParaCobranca` BOOLEAN NOT NULL ,
`ParaFaturamento` BOOLEAN NOT NULL ,
`InicioVigencia` DATE NOT NULL ,
`FimVigencia` DATE NOT NULL ,
`InicioHorario` VARCHAR( 6 ) NOT NULL ,
`FimHorario` VARCHAR( 6 ) NOT NULL 
) ENGINE = MYISAM ;


--
-- Estrutura da tabela `modulobeneficiario`
--

CREATE TABLE `unimed`.`modulobeneficiario` (
`AutoId` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`Beneficiario` INT( 10 ) NOT NULL ,
`InicioVigencia` DATE NOT NULL ,
`Modulo` INT( 10 ) NOT NULL ,
`Vendedor` INT( 10 ) NOT NULL ,
`FimAquisicao` DATE NOT NULL , 
`FimHorario` DATE NOT NULL
) ENGINE = MYISAM ;

AutoId
Beneficiario
InicioVigencia
Modulo
Vendedor
DataAquisicao
FimVigencia


