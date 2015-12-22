<?php

require_once 'lib/FormBuilder.php';

class Esform_View_Form extends Esform_ViewClass
{
	function preforward()
	{
		$type = $this->af->get('type');
		if ($type === null) {
			$type = 'text';
		}
		$type_options = array(
			'text'     => '一行入力',
			'textarea' => '複数行入力',
			'select'   => 'セレクトボックス',
			'radio'    => 'ラジオボタン',
			'checkbox' => 'チェックボックス',
			'file'     => 'ファイル選択'
		);

		$data = &$this->backend->getManager('Data');

		$index_options = range(0, count($data->get('attr')) + 1);
		unset($index_options[0]);

		$this->af->setApp('id', $this->af->get('id'));
		$this->af->setApp('index', $this->af->get('index'));
		$this->af->setApp('index_options', $index_options);
		$this->af->setApp('type', $type);
		$this->af->setApp('type_options', $type_options);
		$this->af->setApp('form_name', $data->get('name'));

		$forms = array();
		$attr_list = $data->get('attr');
		if (is_array($attr_list)) {
			foreach ($attr_list as $attr) {
				$attr = Ethna_Util::escapeHtml($attr);
				$t = $attr['type_name'][0];
				$attr['style'] = $attr['type_name'] == 'textarea' ? 'overflow-y: scroll;height: 2.8em;' : '';
				$attr['width'] = 1;
				$attr['height'] = 1;
				$attr['values'] = '　';
				$form = FormBuilder::build($attr);

				if ($t == 'c' || $t == 'r') {
					$v = ' checked="checked"';
				} else {
					$v = '';
				}
				$form = preg_replace('/\<\?.+?\?\>/', $v, $form);
				$attr['form'] = $form;
				$forms[] = $attr;
			}
			$this->af->setAppNE('forms', $forms);
		}
	}
}

?>
