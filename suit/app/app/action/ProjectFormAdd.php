<?php

class Esform_Form_ProjectFormAdd extends Esform_ActionForm
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
			'type' => array(
				'type'         => VAR_TYPE_STRING,
				'name'         => 'フォームタイプ',
				'required'     => true,
				'regexp'       => '/^[a-z]+$/',
			),
	);
}
class Esform_Action_ProjectFormAdd extends Esform_Action_Project
{
	function prepare()
	{
		if (empty($_POST)) {
			return 'login';
		}
		if ($this->af->validate() > 0) {
			return 'form';
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

		$count = count($data->get('attr'));
		if ($count >= $this->config->get('element_limit')) {
			$this->ae->add('error', 'これ以上フォーム要素を追加できません');
			return 'form';
		}

		$var_types = array(
			'text'     => VAR_TYPE_STRING,
			'textarea' => VAR_TYPE_STRING,
			'select'   => VAR_TYPE_STRING,
			'radio'    => VAR_TYPE_STRING,
			'checkbox' => array(VAR_TYPE_STRING),
			'file'     => VAR_TYPE_FILE
		);
		$type_name = $this->af->get('type');
		if (!isset($var_types[$type_name])) {
			$this->ae->add('error', 'typeの値が正しくありません');
			return 'form';
		}
		$type = $var_types[$type_name];
		$form_type = constant('FORM_TYPE_' . strToUpper($type_name));

		$alist = range('a', 'z');
		$nlist = range(0, 9);
		$form_id = $type_name[0] . $nlist[mt_rand(0, 9)] . $alist[mt_rand(0, 25)] . $alist[mt_rand(0, 25)];
		$max = $type_name == 'textarea' ? '3000' : '300';

		$attr = array(
			'id'           => $form_id,
			'type'         => $type,
			'form_type'    => $form_type,
			'type_name'    => $type_name,
			'name'         => '未定義',
			'required'     => '1',
			'custom'       => '',
			'regexp'       => '',
			'regexp_error' => '{form}を正しく入力して下さい',
			'values'       => '選択項目',
			'default'      => '',
			'query'        => '0',
			'style'        => 'ime-mode: auto;',
			'min'          => '0',
			'max'          => $max,
			'width'        => '50',
			'height'       => '5',
			'example'      => '',
			'suffix'       => '',
			'group'        => '0'
		);

		$index = $this->af->get('index') - 1;
		// 最後に追加
		if ($index > $count - 1) {
			$this->af->set('index', $count + 2);
		}

		$array = &$data->getArray();
		$attr_list = &$array['attr'];
		array_splice($attr_list, $index, 0, array($attr));
		if (!$data->write()) {
			$this->ae->add('error', $data_file . 'に書き込めませんでした');
			return 'error';
		}

		return 'form';
	}
}

?>
