<?php

class Esform_Form_Login extends Esform_ActionForm
{
	var $use_validator_plugin = true;

	var $form = array(
			'pass' => array(
				'type'         => VAR_TYPE_STRING,
				'form_type'    => FORM_TYPE_PASSWORD,
				'name'         => 'パスワード',
				'required'     => true,
				'custom'       => 'isAdmin',
			),
	);
	function isAdmin($name)
	{
		$value = $this->form_vars[$name];

		if (md5($value) !== C_ADMIN_PASS) {
			$this->ae->add($name, '{form}が正しくありません', E_FORM_CONFIRM);
		}
	}
}
class Esform_Action_Login extends Esform_ActionClass
{
	function prepare()
	{
		if (empty($_POST)) {
			return 'login';
		}
		if ($this->af->validate() > 0) {
			return 'login';
		}
	}
	function perform()
	{
		$this->session->start();

		header('Location: ' . $_SERVER['SCRIPT_URL'] . '?mode=project');
		return null;
	}
}

?>
