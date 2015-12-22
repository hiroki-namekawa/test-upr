<?php

class Esform_View_TmplPublish extends Esform_ViewClass
{
	function preforward()
	{
		$form_file = $this->af->get('form_file');
		$form_file_p = $this->config->get('publish_dir') . $form_file . '.php';
		$form_file_m = $this->config->get('publish_dir') . $form_file . $this->config->get('mobile_suffix') . '.php';
		$published_p = is_file($form_file_p);
		$published_m = is_file($form_file_m);
		$type_options = array(
			'p' => 'PC用テンプレートを作成',
			'm' => '携帯用テンプレートを作成',
			'r' => '既存テンプレートを再構築'
		);
		$type = $this->af->get('type');
		if ($published_p || $published_m) {
			if ($type == null) $type = 'r';
		} else {
			$type = 'p';
			unset($type_options['r']);
		}
		$this->af->setApp('id', $this->af->get('id'));
		$this->af->setApp('index', $this->af->get('index'));
		$this->af->setApp('form_file', $form_file);
		$this->af->setApp('form_name', $this->af->get('form_name'));
		$this->af->setApp('type_options', $type_options);
		$this->af->setApp('type', $type);

		// filemtime
		clearStatCache();
		$list = array();
		if ($published_p) {
			$list[] = array(
				'id' => 1,
				'name' => 'PC用',
				'file' => $form_file_p,
				'time' => filemtime($form_file_p)
			);
		}
		if ($published_m) {
			$list[] = array(
				'id' => 2,
				'name' => '携帯用',
				'file' => $form_file_m,
				'time' => filemtime($form_file_m)
			);
		}
		$this->af->setApp('list', $list);
	}
}

?>
