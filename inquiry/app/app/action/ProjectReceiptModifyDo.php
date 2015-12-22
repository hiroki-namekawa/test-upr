<?php

class Esform_Form_ProjectReceiptModifyDo extends Esform_ActionForm
{
	var $use_validator_plugin = true;

	var $form = array(
			'id' => array(
				'type'         => VAR_TYPE_STRING,
				'name'         => 'ファイル番号',
				'required'     => true,
				'regexp'       => '/^[1-9]\d*$/',
			),
			'body' => array(
				'type'         => VAR_TYPE_STRING,
				'name'         => 'メール文面',
				'filter'       => 'trim',
				'required'     => true,
			),
	);
}
class Esform_Action_ProjectReceiptModifyDo extends Esform_Action_Project
{
	function prepare()
	{
		if (empty($_POST)) {
			return 'login';
		}
		if ($this->af->validate() > 0) {
			return 'mailModify';
		}
	}
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
		if (!is_writable($data_file)) {
			$this->ae->add('error', $data_file . 'に書き込み権限がありません');
			return 'error';
		}

		$data = &$this->backend->getManager('Data');
		$data->load($data_file);

		$data->set('receipt', $this->af->get('body'));
		if (!$data->write()) {
			$this->ae->add('error', $data_file . 'に書き込めませんでした');
			return 'error';
		}

		$this->ae->add('error', '変更を保存しました');
		return 'mailModify';
	}
}

?>
