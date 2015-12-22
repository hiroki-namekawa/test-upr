<?php

class Esform_Form_ProjectFormModify extends Esform_ActionForm
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
				'required'     => true,
				'regexp'       => '/^[1-9]\d*$/',
			),
	);
}
class Esform_Action_ProjectFormModify extends Esform_Action_Project
{
	function perform()
	{
		if (!is_writable($this->config->get('data_dir'))) {
			$this->ae->add('error', $this->config->get('data_dir') . 'に書き込み権限がありません');
			return 'error';
		}

		$id = $this->af->get('id');
		$data_file = sprintf('%s%03d.cgi', $this->config->get('data_dir'), $id);
		if (!is_file($data_file)) {
			$this->ae->add('error', $data_file . 'が見つかりませんでした');
			return 'error';
		}

		$data = &$this->backend->getManager('Data');
		$data->load($data_file);

		$index = $this->af->get('index') - 1;
		$attr_list = $data->get('attr');
		if (!isset($attr_list[$index])) {
			$this->ae->add('error', 'フォーム要素が見つかりませんでした');
			return 'error';
		}

		$attr = $attr_list[$index];
		$this->af->setApp('attr', $attr);
		$this->af->setApp('name', $data->get('name'));
		$this->af->setApp('file', $data->get('file'));
		unset($attr['id']);
		foreach ($attr as $k => $v) {
			$this->af->set($k, $v);
		}

		return 'formModify';
	}
}

?>
