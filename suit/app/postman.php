<?php

if (!is_file('app/app/Esform_Controller.php')) exit;
require_once 'app/app/Esform_Controller.php';
if (!is_file($cnf)) exit;
require_once $cnf;

if (!isset($id)) $id = null;
$_GET['id'] = $_POST['id'] = $id;
Esform_Controller::main('Esform_Controller', array('post'));

/**
 * テンプレート関数
 */
function obfuscate($address)
{
	$address = str_replace('@', '*', $address);
	$address = str_replace('.', ':', $address);
	$address = str_rot13($address);
	return $address;
}
function mb_date($time = 0)
{
	$time += time();
	$offset = (int)date('w', $time) * 3;
	$format = sprintf('n月j日（%s曜日）', substr('日月火水木金土', $offset, 3));
	return date($format, $time);
}
function error($var, $id)
{
	$id .= '_e';
	if (!empty($var[$id])) {
		printf('<em id="%srror" class="error">%s</em>', $id, $var[$id]);
	}
	print "\n";
}
function checked(&$var)
{
	if (count($_POST) == 1) {
		$var = ' checked="checked"';
	}
}
function selected(&$var)
{
	if (count($_POST) == 1) {
		$var = ' selected="selected"';
	}
}
function typed(&$var, $string)
{
	if (count($_POST) == 1) {
		$var = htmlSpecialChars($string, ENT_QUOTES);
	}
}

?>
