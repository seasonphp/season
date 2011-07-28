<?php
/**
 */
class Zend_View_Helper_Estado extends Zend_View_Helper_Abstract
{
    /**
     * Método Principal
     * @param string $value Valor para Formatação
     * @param string $format Formato de Saída
     * @return string Valor Formatado
     */
    public function Estado($nome,$valor = null){
		
		if($valor == null){
			return '
				<select name="'.$nome.'" id="'.$nome.'">
					<option value="" selected > Selecione </option>
					<option value="AC">AC</option>
					<option value="AL">AL</option>
					<option value="AM">AM</option>
					<option value="AP">AP</option>
					<option value="BA">BA</option>
					<option value="CE">CE</option>
					<option value="DF">DF</option>
					<option value="ES">ES</option>
					<option value="GO">GO</option>
					<option value="MA">MA</option>
					<option value="MG">MG</option>
					<option value="MS">MS</option>
					<option value="MT">MT</option>
					<option value="PA">PA</option>
					<option value="PB">PB</option>
					<option value="PE">PE</option>
					<option value="PI">PI</option>
					<option value="PR">PR</option>
					<option value="RJ">RJ</option>
					<option value="RN">RN</option>
					<option value="RO">RO</option>
					<option value="RR">RR</option>
					<option value="RS">RS</option>
					<option value="SC">SC</option>
					<option value="SE">SE</option>
					<option value="SP">SP</option>
					<option value="TO">TO</option>  
				</select>';
		}else{
			$estado = array("AC",
							"AL",
							"AM",
							"AP",
							"BA",
							"CE",
							"DF",
							"ES",
							"GO",
							"MA",
							"MG",
							"MS",
							"MT",
							"PA",
							"PB",
							"PE",
							"PI",
							"PR",
							"RJ",
							"RN",
							"RO",
							"RR",
							"RS",
							"SC",
							"SE",
							"SP",
							"TO"
							);
				
				$option ='<select name="'.$nome.'" id="'.$nome.'">';
				foreach($estado as $v){
					if($valor == $v){
						$option .='<option value="'.$v.'" selected> '.$v.' </option>';
					}else{
						$option .='<option value="'.$v.'"> '.$v.' </option>';
					}
				}
				$option .='</select>';
				return  $option;
		}
	}
}