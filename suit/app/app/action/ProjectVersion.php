<?php

class Esform_Form_ProjectVersion extends Esform_ActionForm
{
	var $use_validator_plugin = true;

	var $form = array(
	);
}
class Esform_Action_ProjectVersion extends Esform_Action_Project
{
	function perform()
	{
		$proto_version = '';
		$proto = 'app/prototype.js';
		if (is_file($proto)) {
			$buffer = '';
			$fp = fopen($proto, 'r');
			if (is_resource($fp)) {
				$buffer = fread($fp, 1024);
			}
			fclose($fp);
			if (preg_match('/version ?([ .\d]+)/i', $buffer, $match)) {
				$proto_version = ltrim($match[1]);
			}
		} else {
			$proto_version = 'File has been moved.';
		}
		$this->af->setApp('proto_version', $proto_version);

		return 'version';
	}
}

?>
