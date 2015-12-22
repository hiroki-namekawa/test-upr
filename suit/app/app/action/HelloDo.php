<?php

require_once 'lib/Constants.php';

class Esform_Form_HelloDo extends Esform_ActionForm
{
	var $use_validator_plugin = true;

	var $form = array(
			'admin_pass' => array(
				'type'         => VAR_TYPE_STRING,
				'form_type'    => FORM_TYPE_PASSWORD,
				'name'         => 'パスワード',
				'required'     => true,
				'min'          => 6,
				'max'          => 16,
				'regexp'       => '{^[a-z\d_.+\-*@/]+$}i',
				'custom'       => 'isEasy',
			),
			'admin_mail' => array(
				'type'         => VAR_TYPE_STRING,
				'name'         => 'メールアドレス',
				'filter'       => 'alnum_zentohan',
				'required'     => false,
				'regexp'       => '/^[a-z\d_\-+@.,]{5,}$/',
			),
	);
	function isEasy($name)
	{
		$string = $this->form_vars[$name];
		$regexp = '/' . preg_quote($string) . '/i';

		if (preg_match($regexp, str_repeat($string[0], strlen($string)))) {
			$this->ae->add($name, '{form}は同一文字にしないで下さい', E_FORM_CONFIRM);
		}
		if (preg_match($regexp, '01234567890 09876543210 abcdefghijklmnopqrstuvwxyz')) {
			$this->ae->add($name, '{form}は連番で構成しないで下さい', E_FORM_CONFIRM);
		}
	}
}
class Esform_Action_HelloDo extends Esform_ActionClass
{
	function authenticate()
	{
		if (is_file($this->config->get('config_file'))) {
			return 'login';
		}
	}
	function prepare()
	{
		if (empty($_POST)) {
			return 'hello';
		}
		if ($this->af->validate() > 0) {
			return 'hello';
		}
	}
	function perform()
	{
		if (!is_writable($this->config->get('data_dir'))) {
			$this->ae->add('error', $this->config->get('data_dir') . 'に書き込み権限がありません');
			return 'error';
		}

		$constants = new Constants();
		$constants->set('C_ADMIN_PASS', md5($this->af->get('admin_pass')));
		$constants->set('C_ADMIN_MAIL', $this->af->get('admin_mail'));
		$constants->set('C_AUTO_SELECT', '0');

		$fp = fopen($this->config->get('config_file'), 'w+b');
		if (!$fp || !fwrite($fp, $constants->toString())) {
			$this->ae->add('error', $this->config->get('config_file') . 'に書き込めませんでした');
			return 'error';
		}
		fclose($fp);

		return 'login';
	}
}

?>
