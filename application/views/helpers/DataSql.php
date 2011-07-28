<?php
/**
 * Formatação de Datas
 * Auxiliar da Camada de Visualização
 * @author Wanderson Henrique Camargo Rosa
 * @see APPLICATION_PATH/views/helpers/Date.php
 */
class Zend_View_Helper_DataSql extends Zend_View_Helper_Abstract
{
    /**
     * Método Principal
     * @param string $value Valor para Formatação
     * @param string $format Formato de Saída
     * @return string Valor Formatado
     */
    public function dataSql($data){
		if($data != NULL){
			return date('Y-m-d',strtotime($data));
		}	   
    }
}