<?php

class Esform_Plugin_Validator_Extension extends Ethna_Plugin_Validator
{
	/** @var    bool    配列を受け取るかフラグ */
	var $accept_array = true;

	/**
	 *  拡張子チェック
	 *
	 *  @access public
	 *  @param  string  $name       フォームの名前
	 *  @param  mixed   $var        フォームの値
	 *  @param  array   $params     プラグインのパラメータ
	 */
	function &validate($name, $var, $params)
	{
		if (empty($var['size'])) {
			return true;
		}

		$safety_ext_list = array(
			'jpg', 'png', 'gif', 'bmp',
			'doc', 'xls', 'ppt', 'csv', 'txt', 'pdf',
			'zip', 'lzh', 'sit', 'rar', 'tar', 'tgz'
		);

		$ext = pathinfo($var['name'], PATHINFO_EXTENSION);
		$ext = strToLower($ext);
		if (in_array($ext, $safety_ext_list)) {
			return true;
		}
		return Ethna::raiseNotice('{form}のファイルタイプは対応していません', E_FORM_INVALIDVALUE);
	}
}

?>
