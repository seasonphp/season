<?php
/**
 * Formatação de Datas
 * Auxiliar da Camada de Visualização
 * @author Wanderson Henrique Camargo Rosa
 * @see APPLICATION_PATH/views/helpers/Date.php
 */
class Zend_View_Helper_NomeRDP extends Zend_View_Helper_Abstract
{
    /**
     * Método Principal
     * @param string $value Valor para Formatação
     * @param string $format Formato de Saída
     * @return string Valor Formatado
     */
    public function NomeRDP($rdp){
		if($rdp == 0){
			return "Titular";
		}
		if($rdp == 1){
			return "Conjuge";
		}
		if($rdp == 2){
			return "Companheiro(a)";
		}
		if($rdp >= 10 and $rdp <= 29){
			return "Filho";
		}
		if($rdp >= 30 and $rdp <= 49){
			return "Filha";
		}
		if($rdp == 50){
			return "Pai";
		}
		if($rdp == 51){
			return "Mae";
		}
		if($rdp == 52){
			return "Sogro";
		}
		if($rdp == 53){
			return "Sogra";
		}
		if($rdp >= 60 and $rdp <=69){
			return "Outra Dependencia";
		}
		if($rdp >= 70 and $rdp <= 74){
			return "Filho Adotivo";
		}
		if($rdp >= 75 and $rdp <= 79){
			return "Filho Adotiva";
		}
		if($rdp >= 80 and $rdp <= 89){
			return "Irmao(a)";
		}
		if($rdp >= 90 and $rdp <= 99){
			return "Agregado";
		}	   
    }
}