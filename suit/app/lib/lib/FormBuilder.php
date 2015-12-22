<?php

class FormBuilder
{
	function build($attr)
	{
		$class_name = 'FormBuilder';
		$method_name = $attr['type_name'];
		if (is_callable(array($class_name, $method_name), true)) {
			return call_user_func(array($class_name, $method_name), $attr);
		}
	}
	function text($attr)
	{
		extract($attr);
		return sprintf('<input type="text" id="%s" name="%s" size="%s" value="<?=$%s_v?>" style="%s" />',
			$id, $id, $width, $id, $style);
	}
	function textarea($attr)
	{
		extract($attr);
		return sprintf('<textarea id="%s" name="%s" cols="%s" rows="%s" style="%s"><?=$%s_v?></textarea>',
			$id, $id, $width, $height, $style, $id);
	}
	function select($attr)
	{
		extract($attr);
		$lines = array();
		$lines[] = sprintf('<select id="%s" name="%s">', $id, $id);
		$values = explode("\n", $values);
		$is_group = false;
		foreach ($values as $i => $value) {
			$num_id = $id . $i;
			if ($value[0] === '+') {
				if ($is_group)
				$lines[] = sprintf('	</optgroup>');
				$lines[] = sprintf('	<optgroup label="%s">', substr($value, 1));
				$is_group = true;
			} else if ($value[0] === '-') {
				$lines[] = sprintf('		<option value="%s"<?=$%s_v?>>%s</option>', '', $num_id, substr($value, 1));
			} else {
				$lines[] = sprintf('		<option value="%s"<?=$%s_v?>>%s</option>', $value, $num_id, $value);
			}
		}
		if ($is_group)
		$lines[] = '	</optgroup>';
		$lines[] = '</select>';
		return implode("\n", $lines);
	}
	function radio($attr)
	{
		extract($attr);
		$lines = array();
		$lines[] = sprintf('<span id="%s" class="radio">', $id);
		$values = explode("\n", $values);
		$is_group = false;
		foreach ($values as $i => $value) {
			$num_id = $id . $i;
			if ($value[0] === '+') {
				if ($is_group)
				$lines[] = sprintf('	</span>');
				$lines[] = sprintf('	<em class="group-name">%s</em>', substr($value, 1));
				$lines[] = sprintf('	<span class="group">');
				$is_group = true;
			} else if ($value === '') {
				$lines[] = sprintf('		<br />');
			} else {
				$num_id = $id . $i;
				$lines[] = sprintf('		<label for="%s"><input type="radio" id="%s" name="%s" value="%s"<?=$%s_v?> />%s</label>',
					$num_id, $num_id, $id, $value, $num_id, $value);
			}
		}
		if ($is_group)
		$lines[] = '	</span>';
		$lines[] = '</span>';
		return implode("\n", $lines);
	}
	function checkbox($attr)
	{
		extract($attr);
		$lines = array();
		$lines[] = sprintf('<span id="%s" class="checkbox">', $id);
		$values = explode("\n", $values);
		$is_group = false;
		foreach ($values as $i => $value) {
			$num_id = $id . $i;
			if ($value[0] === '+') {
				if ($is_group)
				$lines[] = sprintf('	</span>');
				$lines[] = sprintf('	<em class="group-name">%s</em>', substr($value, 1));
				$lines[] = sprintf('	<span class="group">');
				$is_group = true;
			} else if ($value === '') {
				$lines[] = sprintf('		<br />');
			} else {
				$num_id = $id . $i;
				$lines[] = sprintf('		<label for="%s"><input type="checkbox" id="%s" name="%s[]" value="%s"<?=$%s_v?> />%s</label>',
					$num_id, $num_id, $id, $value, $num_id, $value);
			}
		}
		if ($is_group)
		$lines[] = '	</span>';
		$lines[] = '</span>';
		return implode("\n", $lines);
	}
	function file($attr)
	{
		extract($attr);
		return sprintf('<input type="file" id="%s" name="%s" size="%s" />', $id, $id, $width);
	}
}

?>
