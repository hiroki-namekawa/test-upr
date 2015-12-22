<?php

/**
 * Include the {@link modifier.date_format.php} plugin
 */
require_once $smarty->_get_plugin_filepath('modifier', 'date_format');

function smarty_modifier_newmark($time, $format = '')
{
	static $now, $period, $count;

	$time = is_numeric($time) ? (int)$time : strToTime($time);
	$retval = $format == '' ? '' : smarty_modifier_date_format($time, $format);

	if ($now == null) {
		$now = time();
		$day = 60 * 60 * 24;
		$period = array($day, $day * 7);
		$count = count($period);
	}
	for ($i = 0; $i < $count; ++$i) {
		if ($now < $time + $period[$i]) {
			$retval .= sprintf('<em class="new%d">new!</em>', $i + 1);
			break;
		}
	}
	return $retval;
}

?>
