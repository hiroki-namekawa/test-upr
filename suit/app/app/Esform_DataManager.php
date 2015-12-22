<?php

class Esform_DataManager extends Ethna_AppManager
{
	var $file_path = '';
	var $array = array();

	function load($file_path)
	{
		$this->file_path = $file_path;
		if (is_file($file_path)) {
			$line = file_get_contents($file_path);
			$line = str_replace("\t", "\n", $line);
			$this->array = unserialize($line);
			$this->array['id'] = ltrim(basename($file_path, '.cgi'), '0');
		}
	}
	function &getArray()
	{
		return $this->array;
	}
	function set($name, $value)
	{
		$this->array[$name] = $value;
	}
	function &get($name)
	{
		if (isset($this->array[$name])) {
			return $this->array[$name];
		}
		$value = null;
		return $value;
	}
	function toLine(&$array)
	{
		$keys = array_keys($array);
		foreach ($keys as $key) {
			$value = &$array[$key];
			if (is_array($value)) {
				$this->toLine($value);
			} else {
				$value = preg_replace('/\r\n?|\n/', "\t", $value);
			}
		}
	}
	function write()
	{
		$array = $this->array;
		unset($array['id']);
		$this->toLine($array);
		$fp = fopen($this->file_path, 'wb');
		return $fp && fwrite($fp, serialize($array)) && fclose($fp);
	}
}

?>
