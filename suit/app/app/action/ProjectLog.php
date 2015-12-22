<?php

class Esform_Form_ProjectLog extends Esform_ActionForm
{
	var $use_validator_plugin = true;

	var $form = array(
			'id' => array(
					'type'         => VAR_TYPE_STRING,
					'name'         => 'ファイル番号',
					'required'     => true,
					'regexp'       => '/^[1-9]\d*$/',
			),
	);
}
class Esform_Action_ProjectLog extends Esform_Action_Project
{
	function perform()
	{
		if (!is_writable($this->config->get('log_dir'))) {
			$this->ae->add('error', $this->config->get('log_dir') . 'に書き込み権限がありません');
			return 'error';
		}

		$id = $this->af->get('id');
		$fl = &$this->backend->getManager('FileList');
		$file_list = $fl->scandir($this->config->get('log_dir'), sprintf('/^%03d_\d/', $id));

		return 'log';
	}
}

?>
