<?php

class Esform_View_MailModify extends Esform_ViewClass
{
	function preforward()
	{
		$this->af->setApp('id', $this->af->get('id'));
		$this->af->setApp('body', $this->af->get('body'));

		$action = $this->backend->ctl->getCurrentActionName();
		if (strpos($action, 'receipt') !== false) {
			$mode = 'receipt';
			$heading = '控え';
		} else {
			$mode = 'mail';
			$heading = '';
		}
		$this->af->setApp('mode', $mode);
		$this->af->setApp('heading', $heading);
	}
}

?>
