<?php

class Esform_Form_ProjectTmplPublish extends Esform_ActionForm
{
	var $use_validator_plugin = true;

	var $form = array(
			'id' => array(
				'type'         => VAR_TYPE_STRING,
				'name'         => 'ファイル番号',
				'required'     => true,
				'regexp'       => '/^[1-9]\d*$/',
			),
			'index' => array(
				'type'         => VAR_TYPE_STRING,
				'name'         => 'フォーム番号',
				'required'     => false,
				'regexp'       => '/^[1-9]\d*$/',
			),
	);
}
class Esform_Action_ProjectTmplPublish extends Esform_Action_Project
{
	function perform()
	{
		$id = $this->af->get('id');
		$data_file = sprintf('%s%03d.cgi', $this->config->get('data_dir'), $id);
		if (!is_file($data_file)) {
			$this->ae->add('error', $data_file . 'が見つかりませんでした');
			return 'error';
		}

		$data = &$this->backend->getManager('Data');
		$data->load($data_file);

		$this->af->set('form_file', $data->get('file'));
		$this->af->set('form_name', $data->get('name'));
		return 'tmplPublish';
	}
}

?>
