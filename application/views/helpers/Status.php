<?php
/**
 * Formatação de Datas
 * Auxiliar da Camada de Visualização
 * @author Wanderson Henrique Camargo Rosa
 * @see APPLICATION_PATH/views/helpers/Date.php
 */
class Zend_View_Helper_Status extends Zend_View_Helper_Abstract
{
    /**
     * Método Principal
     * @param string $value Valor para Formatação
     * @param string $format Formato de Saída
     * @return string Valor Formatado
     */
    public function Status($status){
		if($status == 1){
			return "Inclusao";
		}
		if($status == 2){
			return "Alteracao";
		}
		if($status == 3){
			return "Suspensao";
		}
	   
    }
}