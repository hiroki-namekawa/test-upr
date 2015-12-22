<?php

class Esform_Form_ProjectLogRead extends Esform_ActionForm
{
	var $use_validator_plugin = true;

	var $form = array(
			'file' => array(
					'type'         => VAR_TYPE_STRING,
					'name'         => 'ファイル名',
					'required'     => true,
					'regexp'       => '/^\d{3}_\d+_[a-f\d]+\.cgi$/',
			),
	);
}
class Esform_Action_ProjectLogRead extends Esform_Action_Project
{
	function perform()
	{
		$file = $this->af->get('file');
		$log_file = $this->config->get('log_dir') . $file;
		if (!is_file($log_file)) {
			$this->ae->add('error', $log_file . 'が見つかりませんでした');
			return 'error';
		}

		header(sprintf('Content-Type: text/plain; charset=UTF-8'), true);
		header(sprintf('Content-Length: %s', filesize($log_file)));
		readfile($log_file);
		return false;
	}
}

?>
