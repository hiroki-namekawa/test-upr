<?php

require_once 'app/app/Esform_Controller.php';

if (is_file($cnf)) {
	include_once $cnf;
	Esform_Controller::main('Esform_Controller', 'project', 'project');
} else {
	Esform_Controller::main('Esform_Controller', array('hello', 'hello_*'));
}

?>
