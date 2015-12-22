<?php

require_once 'lib/FormBuilder.php';

class Esform_View_FormModify extends Esform_ViewClass
{
	function preforward()
	{
		$this->af->setApp('params', $this->af->getArray(false));
		$this->af->setApp('options', array('いいえ', 'はい'));
		$this->af->setApp('group_options', array('いいえ', 'はい（一行）', 'はい（改行）'));
		$this->af->setApp('custom_options', array(
			'' => 'なし',
			'checkHiragana'      => 'ふりがな',
			'checkKatakana'      => 'フリガナ',
			'checkMailaddress'   => 'メールアドレス ( 例： info@example.com )',
			'checkMailaddress_r' => 'メールアドレス ( このアドレスに控えメールを送信します。 )',
			'checkRepeat'        => '上段のフォーム内容の再入力 ( 確認の為に再度入力して下さい。 )',
			'checkURL'           => 'URL ( 例： http://www.example.com/ )',
			'checkAlphabet'      => '英字 ( 英字を入力して下さい。 )',
			'checkAlphanum'      => '英数字 ( 英数字を入力して下さい。 )',
			'checkNumber'        => '数字',
			'checkInteger'       => '正整数',
			'checkZipcode'       => '郵便番号 ( 例： 000-1111 )',
			'checkZipcode_d'     => '郵便番号 ( 例： 0001111 (ハイフン不要) )',
			'checkPhone'         => '固定電話 ( 例： 03-111-2222 )',
			'checkPhone_d'       => '固定電話 ( 例： 031112222 (ハイフン不要) )',
			'checkMbphone'       => '携帯電話 ( 例： 090-1111-2222 )',
			'checkMbphone_d'     => '携帯電話 ( 例： 09011112222 (ハイフン不要) )'
		));

		if ($this->af->getApp('attr') != null) {
			$params = $this->af->getArray();
			$params['id'] = 'none';
			$values = &$params['values'];
			$values = preg_replace('/\r\n?/', "\n", $values);
			$form = FormBuilder::build($params);
			$default = $params['default'];
			$t = $params['type_name'][0];
			// 初期値代入
			if ($t == 't' || $t == 'f') {
				$form = str_replace('<?=$none_v?>', $default, $form);
			} else {
				$selected = $t == 's' ? ' selected="selected"' : ' checked="checked"';
				$value = $t == 'c' ? preg_split('/[、,]/u', $default) : array($default);
				$values = explode("\n", $values);
				foreach ($values as $i => $v) {
					$v = in_array($v, $value) ? $selected : '';
					$form = str_replace(sprintf('<?=$none%d_v?>', $i), $v, $form);
				}
			}
			$this->af->setAppNE('form', $form);
		}
	}
}

?>
