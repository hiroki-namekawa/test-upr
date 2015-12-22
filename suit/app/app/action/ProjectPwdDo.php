<?php

require_once 'lib/Constants.php';

class Esform_Form_ProjectPwdDo extends Esform_ActionForm
{
	var $use_validator_plugin = true;

	var $form = array(
			'oldpass' => array(
				'type'         => VAR_TYPE_STRING,
				'form_type'    => FORM_TYPE_PASSWORD,
				'name'         => '現在のパスワード',
				'required'     => true,
				'custom'       => 'isAdmin',
			),
			'newpass' => array(
				'type'         => VAR_TYPE_STRING,
				'form_type'    => FORM_TYPE_PASSWORD,
				'name'         => '新しいパスワード',
				'required'     => true,
				'min'          => 6,
				'max'          => 16,
				'regexp'       => '{^[a-z\d_.+\-*@/]+$}i',
				'custom'       => 'isDuplicate,isEasy',
			),
			'chkpass' => array(
				'type'         => VAR_TYPE_STRING,
				'form_type'    => FORM_TYPE_PASSWORD,
				'name'         => '確認用パスワード',
				'required'     => true,
				'custom'       => 'isSame',
			),
	);
	function isAdmin($name)
	{
		$string = $this->form_vars[$name];

		if (md5($string) !== C_ADMIN_PASS) {
			$this->ae->add($name, '{form}が正しくありません', E_FORM_CONFIRM);
		}
	}
	function isDuplicate($name)
	{
		$string = $this->form_vars[$name];

		if (md5($string) === C_ADMIN_PASS) {
			$this->ae->add($name, '{form}が現在のパスワードです', E_FORM_CONFIRM);
		}
	}
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
	function isSame($name)
	{
		$newpass = $this->form_vars['newpass'];
		$chkpass = $this->form_vars['chkpass'];

		if ($newpass !== $chkpass) {
			$this->ae->add($name, '{form}が正しくありません', E_FORM_CONFIRM);
		}
	}
}
class Esform_Action_ProjectPwdDo extends Esform_Action_Project
{
	function prepare()
	{
		if (empty($_POST)) {
			return 'login';
		}
		if ($this->af->validate() > 0) {
			return 'pwd';
		}
	}
	function perform()
	{
		if (!is_writable($this->config->get('data_dir'))) {
			$this->ae->add('error', $this->config->get('data_dir') . 'に書き込み権限がありません');
			return 'error';
		}
		if (!is_writable($this->config->get('config_file'))) {
			$this->ae->add('error', $this->config->get('config_file') . 'に書き込み権限がありません');
			return 'error';
		}

		$constants = new Constants();
		$constants->set('C_ADMIN_PASS', md5($this->af->get('newpass')));
		$constants->set('C_ADMIN_MAIL', C_ADMIN_MAIL);
		$constants->set('C_AUTO_SELECT', C_AUTO_SELECT);

		$fp = fopen($this->config->get('config_file'), 'w+b');
		if (!$fp || !fwrite($fp, $constants->toString())) {
			$this->ae->add('error', $this->config->get('config_file') . 'に書き込めませんでした');
			return 'error';
		}
		fclose($fp);

		$this->session->destroy();
		$this->ae->add('error', 'パスワードを変更しました');
		return 'login';
	}
}

?>
