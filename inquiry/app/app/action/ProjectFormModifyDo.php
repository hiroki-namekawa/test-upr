<?php

class Esform_Form_ProjectFormModifyDo extends Esform_ActionForm
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
			'name' => array(
				'type'         => VAR_TYPE_STRING,
				'name'         => '名称',
				'filter'       => 'trim',
				'required'     => true,
			),
			'required' => array(
				'type'         => VAR_TYPE_BOOLEAN,
				'name'         => '必須フラグ',
				'required'     => true,
			),
			'custom' => array(
				'type'         => VAR_TYPE_STRING,
				'name'         => 'フォーマット',
				'filter'       => 'trim',
				'required'     => false,
			),
			'regexp' => array(
				'type'         => VAR_TYPE_STRING,
				'name'         => '正規表現',
				'filter'       => 'trim',
				'required'     => false,
				'min'          => 4,
			),
			'regexp_error' => array(
				'type'         => VAR_TYPE_STRING,
				'name'         => 'エラー文',
				'filter'       => 'trim',
				'required'     => false,
			),
			'values' => array(
				'type'         => VAR_TYPE_STRING,
				'name'         => '選択項目',
				'filter'       => 'trim',
				'required'     => false,
			),
			'default' => array(
				'type'         => VAR_TYPE_STRING,
				'name'         => '初期値',
				'filter'       => 'trim',
				'required'     => false,
			),
			'query' => array(
				'type'         => VAR_TYPE_BOOLEAN,
				'name'         => 'URL初期値フラグ',
				'required'     => false,
			),
			'style' => array(
				'type'         => VAR_TYPE_STRING,
				'name'         => 'スタイル',
				'filter'       => 'trim,alnum_zentohan',
				'required'     => false,
			),
			'max' => array(
				'type'         => VAR_TYPE_STRING,
				'name'         => '文字数制限',
				'filter'       => 'trim,alnum_zentohan',
				'required'     => false,
				'regexp'       => '/^[1-9]\d*$/',
			),
			'width' => array(
				'type'         => VAR_TYPE_STRING,
				'name'         => '横幅',
				'filter'       => 'trim,alnum_zentohan',
				'required'     => false,
				'regexp'       => '/^[1-9]\d*$/',
			),
			'height' => array(
				'type'         => VAR_TYPE_STRING,
				'name'         => '縦幅',
				'filter'       => 'trim,alnum_zentohan',
				'required'     => false,
				'regexp'       => '/^[1-9]\d*$/',
			),
			'suffix' => array(
				'type'         => VAR_TYPE_STRING,
				'name'         => '単位',
				'filter'       => 'trim',
				'required'     => false,
			),
			'example' => array(
				'type'         => VAR_TYPE_STRING,
				'name'         => '記入例',
				'filter'       => 'trim',
				'required'     => false,
			),
			'group' => array(
				'type'         => VAR_TYPE_INT,
				'name'         => '結合フラグ',
				'required'     => false,
			),
	);
}
class Esform_Action_ProjectFormModifyDo extends Esform_Action_Project
{
	function prepare()
	{
		if (empty($_POST)) {
			return 'login';
		}
		$this->af->validate();
		if ($this->ae->isError('id') || $this->ae->isError('index')) {
			return 'error';
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

		$index = $this->af->get('index') - 1;
		$array = &$data->getArray();
		if (!isset($array['attr'][$index])) {
			$this->ae->add('error', 'フォーム要素が見つかりませんでした');
			return 'error';
		}
		$attr = &$array['attr'][$index];
		$this->af->set('type_name', $attr['type_name']);

		// タイプ名をセットしてエラー
		if ($this->ae->length() > 0) {
			return 'formModify';
		}

		// 必要な項目だけ更新
		$params = $this->af->getArray(false);
		$t = $attr['type_name'];
		if ($t == 'text') {
			$keys = array('name', 'required', 'custom', 'regexp', 'regexp_error',           'default', 'query', 'style', 'min', 'max', 'width',           'suffix', 'example');
		} else if ($t == 'textarea') {
			$keys = array('name', 'required',           'regexp', 'regexp_error',           'default', 'query', 'style', 'min', 'max', 'width', 'height',           'example');
		} else if ($t == 'select') {
			$keys = array('name', 'required',                                     'values', 'default', 'query',          'min',                           'suffix', 'example');
		} else if ($t == 'radio') {
			$keys = array('name', 'required',                                     'values', 'default', 'query',          'min',                                     'example');
		} else if ($t == 'checkbox') {
			$keys = array('name', 'required',                                     'values', 'default', 'query',          'min',                                     'example');
		} else {
			$keys = array('name', 'required',                                                                            'min', 'max', 'width',                     'example');
		}
		foreach ($keys as $key) {
			$attr[$key] = $params[$key];
		}

		if (!$data->write()) {
			$this->ae->add('error', $data_file . 'に書き込めませんでした');
			return 'error';
		}

		$this->af->setApp('attr', $attr);
		$this->af->setApp('name', $data->get('name'));
		$this->af->setApp('file', $data->get('file'));
		$this->ae->add('error', '変更を保存しました');
		return 'formModify';
	}
}

?>
