<?php

class Esform_View_TmplModify extends Esform_ViewClass
{
	function preforward()
	{
		$this->af->setApp('id', $this->af->get('id'));
		$this->af->setApp('index', $this->af->get('index'));
		$this->af->setApp('source', $this->af->get('source'));

		$data = &$this->backend->getManager('Data');
		$mailto = $data->get('mailto');
		if ($mailto == '') {
			$mailto = C_ADMIN_MAIL;
		}
		$mailto = $mailto == '' ? 'メールアドレス' : preg_replace('/,.+/', '', $mailto);
		$this->af->setApp('mailto', $mailto);

		$file = $this->af->getApp('form_file');
		$is_mobile = strpos($file, $this->config->get('mobile_suffix') . '.php') !== false;
		$this->af->setApp('is_mobile', $is_mobile);
	}
}

?>
