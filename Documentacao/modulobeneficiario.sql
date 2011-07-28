-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: Abr 28, 2011 as 09:12 PM
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
-- Estrutura da tabela `modulobeneficiario`
--

CREATE TABLE IF NOT EXISTS `modulobeneficiario` (
  `AutoId` int(10) NOT NULL AUTO_INCREMENT,
  `Beneficiario` int(10) NOT NULL,
  `InicioVigencia` date NOT NULL,
  `Modulo` int(10) NOT NULL,
  `Vendedor` int(10) NOT NULL,
  `FimVigencia` date NOT NULL,
  `lote` int(100) NOT NULL,
  PRIMARY KEY (`AutoId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
