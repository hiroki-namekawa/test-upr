<?php

class Esform_Form_ProjectAdd extends Esform_ActionForm
{
	var $use_validator_plugin = true;

	var $form = array(
			'name' => array(
					'type'         => VAR_TYPE_STRING,
					'name'         => 'フォーム名',
					'filter'       => 'trim',
					'required'     => true,
					'max'          => 80,
			),
			'file' => array(
					'type'         => VAR_TYPE_STRING,
					'name'         => 'ファイル名',
					'filter'       => 'alnum_zentohan',
					'required'     => false,
					'max'          => 50,
					'regexp'       => '/^[a-z\d_\-]+$/',
			),
	);
}
class Esform_Action_ProjectAdd extends Esform_Action_Project
{
	function prepare()
	{
		if (empty($_POST)) {
			return 'login';
		}
		if ($this->af->validate() > 0) {
			return 'project';
		}
	}
	function perform()
	{
		if (!is_writable($this->config->get('data_dir'))) {
			$this->ae->add('error', $this->config->get('data_dir') . 'に書き込み権限がありません');
			return 'error';
		}

		$fl = &$this->backend->getManager('FileList');
		$file_list = &$fl->scandir($this->config->get('data_dir'));
		$files = count($file_list);
		if ($files === 0) {
			$id = 1;
		} else {
			if ($files >= $this->config->get('project_limit')) {
				$this->ae->add('error', 'これ以上フォームを追加できません');
				return 'project';
			}
			list($id) = sscanf($file_list[0], '%03d.cgi');
			++$id;
		}
		$data_file = sprintf('%03d.cgi', $id);
		$data_file_path = $this->config->get('data_dir') . $data_file;

		$name = $this->af->get('name');
		$file = $this->af->get('file');
		if ($file === '') {
			$file = Ethna_Util::getRandom(6);
		}
		if ($file !== basename($file, $this->config->get('mobile_suffix'))) {
			$this->ae->add('error', $this->config->get('mobile_suffix') . 'は予約語につき変更して下さい');
			return 'project';
		}

		$file_p = $this->config->get('publish_dir') . $file . '.php';
		$file_m = $this->config->get('publish_dir') . $file . $this->config->get('mobile_suffix') . '.php';
		if (is_file($file_p) || is_file($file_m)) {
			$this->ae->add('error', $file . 'は使用中につき変更して下さい');
			return 'project';
		}

		$data = &$this->backend->getManager('Data');
		$data->load($data_file_path);
		$data->set('file', $file);
		$data->set('name', $name);
		$data->set('mailto', '');
		$data->set('body',    '先にテンプレートを作成して下さい。');
		$data->set('receipt', '先にテンプレートを作成して下さい。');
		$data->set('attr', array());
		if (!$data->write()) {
			$this->ae->add('error', $data_file_path . 'に書き込めませんでした');
			return 'error';
		}

		array_unshift($file_list, $data_file);
		$this->af->clearFormVars();
		return 'project';
	}
}

?>
