<?php

class Esform_Form_Post extends Esform_ActionForm
{
	var $use_validator_plugin = true;

	var $form = array(
			'id' => array(
				'type'         => VAR_TYPE_STRING,
				'name'         => 'ファイル番号',
				'required'     => true,
				'regexp'       => '/^[1-9]\d*$/',
			),
			'_send' => array(
			),
	);

	function checkRepeat($name)
	{
		$string = &$this->form_vars[$name];
		if ($string == '') return;
		$pre_string = null;
		foreach ($this->form_vars as $key => $val) {
			if ($key === $name) break;
			$pre_string = $val;
		}

		if ($string !== $pre_string) {
			$this->ae->add($name, '{form}を正しく入力して下さい', E_FORM_INVALIDCHAR);
		}
	}
	function checkMailaddress($name)
	{
		$string = &$this->form_vars[$name];
		if ($string == '') return;
		$string = mb_convert_kana($string, 'as');

		// parent::checkMailaddress($name);
		if (!Ethna_Util::checkMailaddress($string)) {
			$this->ae->add($name, '{form}を正しく入力して下さい', E_FORM_INVALIDCHAR);
		}
	}
	function checkMailaddress_r($name)
	{
		$this->checkMailaddress($name);
	}
	function checkURL($name)
	{
		$string = &$this->form_vars[$name];
		if ($string == '') return;
		$string = mb_convert_kana($string, 'as');

		// parent::checkURL($name);
		if (!preg_match('{^(https?|ftp)://.+}', $string)) {
			$this->ae->add($name, '{form}を正しく入力して下さい', E_FORM_INVALIDCHAR);
		}
	}
	function checkAlphabet($name)
	{
		$string = &$this->form_vars[$name];
		if ($string == '') return;
		$string = mb_convert_kana($string, 'as');

		if (!preg_match('/^[a-z]+$/i', $string)) {
			$this->ae->add($name, '{form}は英字にして下さい', E_FORM_INVALIDCHAR);
		}
	}
	function checkNumber($name)
	{
		$string = &$this->form_vars[$name];
		if ($string == '') return;
		$string = mb_convert_kana($string, 'as');

		if (!preg_match('/^\d+$/', $string)) {
			$this->ae->add($name, '{form}は数字にして下さい', E_FORM_INVALIDCHAR);
		}
	}
	function checkAlphanum($name)
	{
		$string = &$this->form_vars[$name];
		if ($string == '') return;
		$string = mb_convert_kana($string, 'as');

		if (!preg_match('/^[a-z\d]+$/i', $string)) {
			$this->ae->add($name, '{form}は英数字にして下さい', E_FORM_INVALIDCHAR);
		}
	}
	function checkInteger($name)
	{
		$string = &$this->form_vars[$name];
		if ($string == '') return;
		$string = mb_convert_kana($string, 'as');

		if (!preg_match('/^[1-9]\d*$/', $string)) {
			$this->ae->add($name, '{form}は正整数にして下さい', E_FORM_INVALIDCHAR);
		}
	}
	function checkZipcode($name)
	{
		$string = &$this->form_vars[$name];
		if ($string == '') return;
		$string = mb_convert_kana($string, 'as');

		if (!preg_match('/^\d{3}-\d{4}$/', $string)) {
			$this->ae->add($name, '{form}を正しく入力して下さい', E_FORM_INVALIDCHAR);
		}
	}
	function checkZipcode_d($name)
	{
		$string = &$this->form_vars[$name];
		if ($string == '') return;
		$string = mb_convert_kana($string, 'as');
		$string = str_replace('-', '', $string);

		if (!preg_match('/^\d{7}$/', $string)) {
			$this->ae->add($name, '{form}を正しく入力して下さい', E_FORM_INVALIDCHAR);
		}
	}
	function checkPhone($name)
	{
		$string = &$this->form_vars[$name];
		if ($string == '') return;
		$string = mb_convert_kana($string, 'as');

		if (!preg_match('/^0[1-9]\d{0,3}-\d{1,4}-\d{4}$/', $string)) {
			$this->ae->add($name, '{form}を正しく入力して下さい', E_FORM_INVALIDCHAR);
		}
	}
	function checkPhone_d($name)
	{
		$string = &$this->form_vars[$name];
		if ($string == '') return;
		$string = mb_convert_kana($string, 'as');
		$string = str_replace('-', '', $string);

		if (!preg_match('/^0[1-9]\d{8}$/', $string)) {
			$this->ae->add($name, '{form}を正しく入力して下さい', E_FORM_INVALIDCHAR);
		}
	}
	function checkMbphone($name)
	{
		$string = &$this->form_vars[$name];
		if ($string == '') return;
		$string = mb_convert_kana($string, 'as');

		if (!preg_match('/^0[7-9]0-\d{4}-\d{4}$/', $string)) {
			$this->ae->add($name, '{form}を正しく入力して下さい', E_FORM_INVALIDCHAR);
		}
	}
	function checkMbphone_d($name)
	{
		$string = &$this->form_vars[$name];
		if ($string == '') return;
		$string = mb_convert_kana($string, 'as');
		$string = str_replace('-', '', $string);

		if (!preg_match('/^0[7-9]0\d{8}$/', $string)) {
			$this->ae->add($name, '{form}を正しく入力して下さい', E_FORM_INVALIDCHAR);
		}
	}
	function checkKatakana($name)
	{
		$string = &$this->form_vars[$name];
		if ($string == '') return;
		$string = mb_convert_kana($string, 'CKs');

		if (!preg_match('/^[ァ-ン ]+$/u', $string)) {
			$this->ae->add($name, '{form}は片仮名で入力して下さい', E_FORM_INVALIDCHAR);
		}
	}
	function checkHiragana($name)
	{
		$string = &$this->form_vars[$name];
		if ($string == '') return;
		$string = mb_convert_kana($string, 'cHs');

		if (!preg_match('/^[ぁ-ん ]+$/u', $string)) {
			$this->ae->add($name, '{form}は平仮名で入力して下さい', E_FORM_INVALIDCHAR);
		}
	}
}
class Esform_Action_Post extends Esform_ActionClass
{
	var $vars;
	var $attr_list;

	function prepare()
	{
		$carrier = $this->getCarrier();
		if (C_AUTO_SELECT) {
			$form_file = $_SERVER['SCRIPT'];
			$form_file = basename($form_file, '.php');
			$form_file = basename($form_file, $this->config->get('mobile_suffix'));
			$form_file_p = $this->config->get('publish_dir') . $form_file . '.php';
			$form_file_m = $this->config->get('publish_dir') . $form_file . $this->config->get('mobile_suffix') . '.php';
			if ((bool)$carrier) {
				$form_file = is_file($form_file_m) ? $form_file_m : $form_file_p;
			} else {
				$form_file = is_file($form_file_p) ? $form_file_p : $form_file_m;
			}
		} else {
			$form_file = $this->config->get('publish_dir') . $_SERVER['SCRIPT'];
		}

		$this->vars = array(
			'carrier'   => $carrier,
			'form_file' => $form_file,
			'errors'    => array(),
			'ERROR'     => false,
			'DONE'      => false,
			'CONFIRM'   => false
		);
		$vars = &$this->vars;

		if ($this->af->validate() > 0) {
			print '$idの値が正しくありません。';
			exit;
		}

		$id = $this->af->get('id');
		$data_file = sprintf('%s%03d.cgi', $this->config->get('data_dir'), $id);
		if (!is_file($data_file)) {
			print '該当データが見つかりません。';
			exit;
		}

		$data = &$this->backend->getManager('Data');
		$data->load($data_file);
		$this->attr_list = $attr_list = $data->get('attr');
		$vars['heading'] = $this->escape($data->get('name'));

		// フォームの初期値
		if (strToUpper($_SERVER['REQUEST_METHOD']) != 'POST') {
			$this->setDefaultVars();
			$this->setInputVars();
			return null;
		}

		// 入力チェック
		if ($this->validate()) {
			$this->setInputVars();
			$this->setErrorVars();
			return null;
		}

		// 確認画面へ
		if ($this->af->get('_send') === null) {
			$this->setConfirmVars($id);
			return null;
		}

		// 連投チェック
		if ($this->isDuplicatePost()) {
			$vars['ERROR'] = sprintf('あと%s秒お待ち下さい', $this->config->get('repost_interval'));
			return null;
		}

		// メール送信
		$attach_list = array();
		$body_vars = array();
		$from = '';
		$receipt_to = '';
		foreach ($attr_list as $attr) {
			$id = $attr['id'];
			$t = $attr['type_name'][0];
			$custom = $attr['custom'];
			$suffix = $attr['suffix'];

			$value = $this->af->get($id);
			if (is_array($value)) {
				$value = implode(', ', $value);
			}

			if ($t == 't' && strpos($custom, 'ailaddress') !== false) {
				if ($value != '') {
					if ($receipt_to == '' && substr($custom, -1) == 'r') {
						$receipt_to = $value;
					}
					if ($from == '') {
						$from = $value;
					}
					$value = 'mailto:' . $value;
					
				}
			} else if ($t == 'f' && $value != null) {
				$c =& Ethna_Controller::getInstance();
				$file = preg_replace('/^.+_/', '', $value);
				$file = sprintf('%s/upload_%s', $c->getDirectory('tmp'), $file);
				if (!is_file($file)) {
					$vars['ERROR'] = $file . 'がアップロードされていません';
					return null;
				}
				$value = preg_replace('/_[^_]+$/', '', $value);
				$type = $this->af->get($id . '_type');
				$attach_list[] = array($value, $type, file_get_contents($file));
			}

			$this->changeBlankText($value, $t);
			$body_vars["{\$$id}"] = $value . $suffix;
		}

		$body_vars['{$ip}'] = $ip = $_SERVER['REMOTE_ADDR'];
		$body_vars['{$host}'] = $host = $_SERVER['REMOTE_HOST'];
		$body_vars['{$browser}'] = $_SERVER['HTTP_USER_AGENT'];
		$body_vars['{$referer}'] = $_SERVER['HTTP_REFERER'];
		$body_vars['{$carrier}'] = $this->getCarrierName($carrier);
		$body_vars['{$date}'] = date('y年m月d日 H時i分', $_SERVER['REQUEST_TIME']);
		$body_vars['{$serial}'] = $serial = strToUpper(Ethna_Util::getRandom(12));
		$body_vars['{$url}'] = $_SERVER['SCRIPT_URL'];

		$subject = $data->get('name');
		$body = $data->get('body') . "\n";
		$body = $log_body = strtr($body, $body_vars);
		$receipt = $data->get('receipt') . "\n";
		$receipt = strtr($receipt, $body_vars);

		$header_list = array();
		if ((bool)$attach_list) {
			$boundary = '----=_NextPart_' . $serial;
			$header_list[] = sprintf('Content-Type: multipart/mixed;');
			$header_list[] = sprintf('	boundary="%s"', $boundary);
			$body = <<< EOM
--$boundary
Content-Type: text/plain; charset=ISO-2022-JP
Content-Transfer-Encoding: 7bit

$body
EOM;
			foreach ($attach_list as $attach) {
				$attach_name = $this->escape($attach[0]);
				$attach_type = $attach[1];
				$attach_data = chunk_split(base64_encode($attach[2]));
				$body .= <<< EOM


--$boundary
Content-Type: $attach_type;
	name="$attach_name"
Content-Transfer-Encoding: base64
Content-Disposition: attachment;
	filename="$attach_name"

$attach_data
EOM;
				$log_body .= <<< EOM

$attach_data
EOM;
			}
			$body .= <<< EOM

--$boundary--


.

EOM;
		}

		$to = $data->get('mailto');
		if ($to == '') {
			$to = C_ADMIN_MAIL;
		}
		if ($to != '') {
			$success = $this->sendMail($to, $subject, '', $body, $from, $header_list);
			if (!$success) {
				$vars['ERROR'] = 'メールを送信できませんでした';
				return null;
			}
		}
		if ($receipt_to != '') {
			$subject .= ' [送信者控え]';
			$from = 'poweredsuits@upr-net.co.jp';
			$success = $this->sendMail($receipt_to, $subject, '', $receipt, $from);
		}

		if (is_writable($this->config->get('log_dir'))) {
			// 送信ログ作成
			$id = $this->af->get('id');
			$log_file = sprintf('%s%03d_%s_%s.cgi', $this->config->get('log_dir'), $id, $_SERVER['REQUEST_TIME'], $this->getHostId());
			$fp = fopen($log_file, 'w+b');
			fwrite($fp, $log_body);
			fclose($fp);

			// アンケート集計
			$anquete_file = sprintf('%s%03d_enquete.cgi', $this->config->get('log_dir'), $id);
			if (is_file($anquete_file)) {
				$code = file_get_contents($anquete_file);
				$array = unserialize($code);
			} else {
				$array = array(
					'ip_list' => array(),
					'item_list' => array()
				);
			}
			$ip_list = &$array['ip_list'];
			$item_list = &$array['item_list'];
			if (!in_array($ip, $ip_list) && $this->setEnquete($item_list)) {
				$array['name'] = $data->get('name');
				$ip_list[] = $ip;
				$fp = fopen($anquete_file, 'w+b');
				fwrite($fp, serialize($array));
				fclose($fp);
			}
		}

		Ethna_Util::purgeTmp('upload_', 60 * 60 * 1);
		$vars['DONE'] = true;
	}
	function perform()
	{
		// テンプレート内で使える簡易変数
		$i = 0;
		$t = $_SERVER['REQUEST_TIME'];
		$vars = &$this->vars;
		extract($vars);
		// var_dump(get_defined_vars());
		include $form_file;
		exit;
	}
	function getCarrier()
	{
		$agent = $_SERVER['HTTP_USER_AGENT'];
		if (preg_match('{^DoCoMo/[12]\.0}', $agent)) {
			return 'd';
		} else if (preg_match('{^(J-PHONE|Vodafone|MOT-[CV]980|SoftBank)/}', $agent)) {
			return 's';
		} else if (strpos($agent, 'KDDI-') === 0 || strpos($agent, 'UP.Browser') !== false) {
			return 'a';
		} else if (strpos($agent, 'PDXGW') === 0 || strpos($agent, 'DDIPOCKET;') !== false || strpos($agent, 'WILLCOM;') !== false) {
			return 'w';
		} else {
			return null;
		}
	}
	function getCarrierName($carrier)
	{
		switch ($carrier) {
			case 'd': return 'ドコモ端末';
			case 's': return 'ソフトバンク端末';
			case 'a': return 'AU端末';
			case 'w': return 'ウィルコム端末';
			default:  return 'パソコン';
		}
	}
	// Ethna_Util::isDuplicatePost()の代用
	function isDuplicatePost()
	{
		if (!isset($_POST['uniqid'])) {
			return false;
		}
		Ethna_Util::purgeTmp('uniqid_', $this->config->get('repost_interval'));
		$c =& Ethna_Controller::getInstance();
		$filename = sprintf('%s/uniqid_%s_%s', $c->getDirectory('tmp'), $_SERVER['REMOTE_ADDR'], $_POST['uniqid']);
		if (!is_file($filename)) {
			touch($filename);
			return false;
		}
		return true;
	}
	function getHostId($length = 15)
	{
		$string = $_SERVER['REMOTE_HOST'];
		$string = md5($string);
		$string = substr($string, -$length);
		return $string;
	}
	function sendMail($to, $subject, $name, $body, $from = '', $header_list = null, $option = null)
	{
		$host = $_SERVER['HTTP_HOST'];
		if ($from === '') {
			$from = 'no-accounts@' . $host;
		}
		if ($name !== '') {
			$name = mb_convert_encoding($name, 'JIS');
			$name = '=?ISO-2022-JP?B?' . base64_encode($name) . '?=';
			$from = "$name <$from>";
		}

		$subject = mb_convert_encoding($subject, 'JIS');
		$subject = '=?ISO-2022-JP?B?' . base64_encode($subject) . '?=';
		$body = preg_replace('/\r\n?/', "\n", $body);
		$body = mb_convert_encoding($body, 'JIS');

		$list = array(
			'From: ' . $from,
			'MIME-Version: 1.0',
			'X-Mailer: PHP ' . PHP_VERSION,
			'Content-Type: text/plain; charset=ISO-2022-JP',
			'Content-Transfer-Encoding: 7bit'
		);
		if ((bool)$header_list) {
			array_splice($list, -2, 2, $header_list);
		}
		$header = implode("\n", $list);

		// テスト環境
		if ($host === 'localhost') {
			return true;
		} else if ($option === null) {
			return mail($to, $subject, $body, $header);
		} else {
			return mail($to, $subject, $body, $header, $option);
		}
	}
	function validate()
	{
		// 設定ファイルから検証ルールを作成
		$attr_list = $this->attr_list;
		foreach ($attr_list as $attr) {
			extract($attr);

			$rule = array(
				'name'         => $name,
				'type'         => $type,
				'form_type'    => $form_type,
				'filter'       => 'trim',
				'required'     => $required,
				'min'          => $min,
				'max'          => $max
			);
			if ($regexp != '') {
				$rule['regexp'] = $regexp;
				$rule['regexp_error'] = $regexp_error;
			}
			if ($custom != '') {
				$rule['custom'] = $custom;
			}

			if ($type_name == 'file') {
				if ($this->af->get('_send') == null) {
					$rule['extension'] = true;
					$rule['filter'] = null;
				} else {
					$rule['type'] = VAR_TYPE_STRING;
					$rule['form_type'] = FORM_TYPE_TEXT;
					$rule['max'] = 100;
					$rule['regexp'] = '/^.+_[a-z\d]+\.[a-z]{2,4}$/i';
					$rule['regexp_error'] = '{form}を正しく入力して下さい';

					$type_rule = array(
						'name'         => $name . 'のファイルタイプ',
						'required'     => $required,
						'type'         => VAR_TYPE_STRING,
						'form_type'    => FORM_TYPE_HIDDEN,
						'min'          => 0,
						'max'          => 100,
						'regexp'       => '/^[a-z.\-\/]+$/',
						'regexp_error' => '{form}を正しく入力して下さい'
					);
					$this->af->setDef($id . '_type', $type_rule);
				}
			}
			$this->af->setDef($id, $rule);
		}
		$this->af->setFormVars();
		return $this->af->validate();
	}
	function setDefaultVars()
	{
		$attr_list = $this->attr_list;
		foreach ($attr_list as $attr) {
			$no_default = !isset($attr['default']) || $attr['default'] == '';
			$no_query = !isset($attr['query']) || $attr['query'] == '0';
			if ($no_default && $no_query) {
				continue;
			}
			$id = $attr['id'];
			$t = $attr['type_name'][0];
			$default = $attr['default'];
			$query = $attr['query'];

			if ($t == 'c') {
				$default = preg_split('/[、,]/u', $default);
			}
			$this->af->set($id, $default);
		}
	}
	function setInputVars()
	{
		$attr_list = $this->attr_list;
		foreach ($attr_list as $attr) {
			$id = $attr['id'];
			$t = $attr['type_name'][0];
			$values = $attr['values'];

			// 全エラー変数を初期化
			$this->vars[$id . '_e'] = '';
			// 全フォーム変数を初期化
			$value = $this->af->get($id);
			if ($t == 't') {
				$this->vars[$id . '_v'] = $this->escape($value);
			} else if ($t == 'f') {
				$this->vars[$id . '_v'] = '';
			} else {
				$selected = $t == 's' ? ' selected="selected"' : ' checked="checked"';
				if (!is_array($value)) {
					$value = array($value);
				}
				$values = explode("\n", $values);
				foreach ($values as $i => $v) {
					$this->vars[$id . $i . '_v'] = in_array($v, $value) ? $selected : '';
				}
			}
		}
	}
	function setErrorVars()
	{
		$attr_list = $this->attr_list;
		foreach ($attr_list as $attr) {
			$id = $attr['id'];

			// エラー文を作成
			if ($this->ae->isError($id)) {
				$msg = $this->ae->getMessage($id) . '。';
				$this->vars[$id . '_e'] = $this->vars['errors'][$id] = $this->escape($msg);
			}
		}
	}
	function setConfirmVars($form_id)
	{
		// 送信内容をhiddenで復元
		$c =& Ethna_Controller::getInstance();
		$this->vars['CONFIRM'] = true;
		$hidden = &$this->vars['hidden'];
		$hidden = $this->getHidden('_send', 'true');
		$hidden = $this->getHidden('id', $form_id);
		$hidden = $this->getHidden('uniqid', Ethna_Util::getRandom(20));
		$attr_list = $this->attr_list;
		foreach ($attr_list as $attr) {
			$id = $attr['id'];
			$t = $attr['type_name'][0];

			$value = $this->af->get($id);
			$this->vars[$id . '_c'] = '';
			$display = &$this->vars[$id . '_c'];
			if ($t == 'f') {
				if (!empty($value['size'])) {
					$file_name = $display = basename($value['name']);
					$dst_name = $id . md5($_SERVER['REQUEST_TIME'] . $_SERVER['REMOTE_ADDR']);
					$dst_name = substr($dst_name, 0, 20);
					$dst_name = preg_replace('/^.+(?=\.)/', $dst_name, $file_name);
					$src = $value['tmp_name'];
					$dst = sprintf('%s/upload_%s', $c->getDirectory('tmp'), $dst_name);
					if (!move_uploaded_file($src, $dst)) {
						$this->vars['ERROR'] = 'アップロードに失敗しました';
						return null;
					}
					$hidden = $this->getHidden($id . '_type', $value['type']);
					$hidden = $this->getHidden($id, sprintf('%s_%s', $file_name, $dst_name));
				}
			} else if ($t == 'c') {
				if (is_array($value)) {
					foreach ($value as $v) {
						$hidden = $this->getHidden($id . '[]', $v);
					}
					$display = implode(', ', $value);
				}
			} else {
				$hidden = $this->getHidden($id, $value);
				$display = $value;
			}
			$this->changeBlankText($display, $t);
			$display = $this->escape($display, true);
		}
		$hidden .= "\n";
	}
	function changeBlankText(&$string, $type)
	{
		if ($string == '') {
			$string = $type == 't' ? '[入力なし]' : '[選択なし]';
		}
	}
	function getHidden($name, $value)
	{
		static $line = '';
		return $line .= sprintf('<input type="hidden" name="%s" value="%s" />', $name, $this->escape($value));
	}
	function setEnquete(&$array)
	{
		$attr_list = $this->attr_list;
		foreach ($attr_list as $attr) {
			$id = $attr['id'];
			$t = $attr['type_name'][0];
			$name = $attr['name'];
			$suffix = $attr['suffix'];
			$values = $attr['values'];
			if ($t == 't' || $t == 'f') {
				continue;
			}

			if (empty($array[$id])) {
				$array[$id] = array(
					'name'   => '',
					'type'   => $attr['type_name'],
					'suffix' => '',
					'vote'   => array()
				);
			}
			$arr = &$array[$id];
			$arr['name'] = $name;
			$arr['suffix'] = $suffix;
			$vote = &$arr['vote'];

			// 選択肢を抜粋して初期化
			$values = explode("\n", $values);
			foreach ($values as $val) {
				// 改行用の空文字、すでに抜粋済み、+グループ名、-選択して下さい
				if ($val == '' || isset($vote[$val]) || $val[0] == '+' || ($val[0] == '-' && $t == 's')) {
					continue;
				}
				$vote[$val] = 0;
			}

			// 投票の配列化
			$value = $this->af->get($id);
			$val_list = array();
			if ($t == 'c') {
				if (is_array($value) && current($value) != null) {
					$val_list = $value;
				}
			} else if ($value != null) {
				$val_list = array($value);
			}

			// 投票の集計
			foreach ($val_list as $val) {
				if (isset($vote[$val])) {
					++$vote[$val];
				}
			}
		}
		return isset($value);
	}
	function escape($string, $br = false)
	{
		$string = htmlSpecialChars($string, ENT_QUOTES);
		if ($br) {
			$string = nl2br($string);
		}
		return $string;
	}
}

?>
