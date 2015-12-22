<?php

class Esform_Form_ProjectLogDelete extends Esform_ActionForm
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
class Esform_Action_ProjectLogDelete extends Esform_Action_Project
{
	function perform()
	{
		if (!is_writable($this->config->get('log_dir'))) {
			$this->ae->add('error', $this->config->get('log_dir') . 'に書き込み権限がありません');
			return 'error';
		}

		$file = $this->af->get('file');
		$log_file = $this->config->get('log_dir') . $file;
		if (!is_file($log_file)) {
			$this->ae->add('error', $log_file . 'が見つかりませんでした');
			return 'error';
		}
		if (!is_writable($log_file)) {
			$this->ae->add('error', $log_file . 'に書き込み権限がありません');
			return 'error';
		}
		unlink($log_file);

		list($id) = sscanf($file, '%03d');
		$this->af->set('id', $id);

		$fl = &$this->backend->getManager('FileList');
		$file_list = $fl->scandir($this->config->get('log_dir'), sprintf('/^%03d_\d/', $id));

		return 'log';
	}
}

?>
