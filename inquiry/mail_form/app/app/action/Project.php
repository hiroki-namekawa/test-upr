<?php

class Esform_Form_Project extends Esform_ActionForm
{
	var $use_validator_plugin = true;

	var $form = array(
			'index' => array(
				'type'         => VAR_TYPE_STRING,
				'name'         => 'フォーム番号',
				'required'     => false,
				'regexp'       => '/^[1-9]\d*$/',
			),
	);
}
class Esform_Action_Project extends Esform_ActionClass
{
	function authenticate()
	{
		if (!$this->session->isStart()) {
			return 'login';
		}
	}
	function prepare()
	{
		if ($this->af->validate() > 0) {
			return 'error';
		}
	}
	function perform()
	{
		if (!is_writable($this->config->get('data_dir'))) {
			$this->ae->add('error', $this->config->get('data_dir') . 'に書き込み権限がありません');
			return 'error';
		}

		$fl = &$this->backend->getManager('FileList');
		$fl->scandir($this->config->get('data_dir'));
		return 'project';
	}
}

?>
