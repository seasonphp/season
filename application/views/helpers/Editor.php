<?php
class Zend_View_Helper_Editor {

  function Editor( $textareaId ) {
        return "<script type=\"text/javascript\">
    CKEDITOR.replace( '". $textareaId ."' ,

	 
	);
        </script>";
    }
}
?>