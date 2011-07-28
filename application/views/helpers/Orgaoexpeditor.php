<?php
/**
 */
class Zend_View_Helper_Orgaoexpeditor extends Zend_View_Helper_Abstract
{
    /**
     * Método Principal
     * @param string $value Valor para Formatação
     * @param string $format Formato de Saída
     * @return string Valor Formatado
     */
    public function Orgaoexpeditor($nome){
		return '
		<select name="'.$nome.'" id="'.$nome.'">
			<option value="34" selected >SSP</option>

		</select>';
    }
}