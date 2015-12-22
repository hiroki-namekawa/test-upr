<?php

require_once 'lib/FormBuilder.php';

class Esform_Form_ProjectTmplPublishDo extends Esform_ActionForm
{
	var $use_validator_plugin = true;

	var $form = array(
			'id' => array(
				'type'         => VAR_TYPE_STRING,
				'name'         => 'ファイル番号',
				'required'     => true,
				'regexp'       => '/^[1-9]\d*$/',
			),
			'index' => array(
				'type'         => VAR_TYPE_STRING,
				'name'         => 'フォーム番号',
				'required'     => false,
				'regexp'       => '/^[1-9]\d*$/',
			),
			'type' => array(
				'form_type'    => FORM_TYPE_RADIO,
				'type'         => VAR_TYPE_STRING,
				'name'         => 'テンプレート・タイプ',
				'required'     => true,
			),
	);
}
class Esform_Action_ProjectTmplPublishDo extends Esform_Action_Project
{
	function prepare()
	{
		if (empty($_POST)) {
			return 'login';
		}
		if ($this->af->validate() > 0) {
			return 'tmplPublish';
		}
	}
	function perform()
	{
		if (!is_writable($this->config->get('publish_dir'))) {
			$this->ae->add('error', $this->config->get('publish_dir') . 'に書き込み権限がありません');
			return 'error';
		}
		if (!is_writable($this->config->get('data_dir'))) {
			$this->ae->add('error', $this->config->get('data_dir') . 'に書き込み権限がありません');
			return 'error';
		}

		$id = $this->af->get('id');
		$data_file = sprintf('%s%03d.cgi', $this->config->get('data_dir'), $id);
		if (!is_file($data_file)) {
			$this->ae->add('error', $data_file . 'が見つかりませんでした');
			return 'error';
		}
		if (!is_writable($data_file)) {
			$this->ae->add('error', $data_file . 'に書き込み権限がありません');
			return 'error';
		}

		$data = &$this->backend->getManager('Data');
		$data->load($data_file);
		$form_file = $data->get('file');
		$form_name = $data->get('name');
		$array = &$data->getArray();
		$attr_list = $array['attr'];

		$type = $this->af->get('type');
		$form_file_p = $this->config->get('publish_dir') . $form_file . '.php';
		$form_file_m = $this->config->get('publish_dir') . $form_file . $this->config->get('mobile_suffix') . '.php';
		$list = array();
		if ($type == 'r') {
			if (is_file($form_file_p)) {
				$list[] = array('type' => 'p', 'src' => $form_file_p, 'dst' => $form_file_p);
			}
			if (is_file($form_file_m)) {
				$list[] = array('type' => 'm', 'src' => $form_file_m, 'dst' => $form_file_m);
			}
			if ((bool)$list) {
				$done_msg = '既存テンプレートを再構築しました';
			} else {
				$done_msg = '既存テンプレートはありません';
			}
		} else if ($type == 'm') {
			$list[] = array('type' => 'm', 'src' => 'app/template/ja/skelton_m.html', 'dst' => $form_file_m);
			$done_msg = '携帯用テンプレートを作成しました';
		} else {
			$list[] = array('type' => 'p', 'src' => 'app/template/ja/skelton_p.html', 'dst' => $form_file_p);
			$done_msg = 'PC用テンプレートを作成しました';
		}

		$form_name = htmlSpecialChars($form_name, ENT_QUOTES);
		foreach ($list as $pair) {
			extract($pair);
			if (!is_writable($dst) && is_file($dst)) {
				$this->ae->add('error', $dst . 'に書き込み権限がありません');
				return 'error';
			}

			$form_name_tmp = $type == 'm' ? mb_convert_kana($form_name, 'aks') : $form_name;
			$depth = substr_count($this->config->get('publish_dir'), '/');
			$dir = str_repeat('../', $depth - 1);
			$source = file_get_contents($src);
			$source = str_replace('{$dir}', $dir, $source);
			$source = str_replace('{$id}', $id, $source);
			$source = str_replace('{$form_file}', $dst, $source);
			$source = str_replace('{$form_name}', $form_name_tmp, $source);

			$make = 'makeParts_' . $type;
			list($confirms, $forms) = $this->$make($attr_list);
			$this->replace(sprintf('<?/* confirm_part_%s */?>', $type), $confirms, $source);
			$this->replace(sprintf('<?/* form_part_%s */?>', $type), $forms, $source);
			if (strpos($source, $this->config->get('design')) === false) {
				$foul = true;
			}

			$fp = fopen($dst, 'w+b');
			if (!$fp || !fwrite($fp, $source)) {
				$this->ae->add('error', $dst . 'に書き込めませんでした');
				return 'error';
			}
			fclose($fp);
		}

		$body = $this->makeBody($attr_list);
		$receipt = <<<EOM
───────────────────────────────
　■本日はお問い合わせ頂き誠にありがとうございました。■

　このメールは下記URLのフォームから送信された内容の控えです。
　{\$url}
　このメールに心当りがない場合は、お手数ですが、
　サイト運営者までご連絡下さい。
───────────────────────────────

$body
EOM;
		$data->set('body', $body);
		$data->set('receipt', $receipt);
		if (!$data->write()) {
			$this->ae->add('error', $data_file . 'に書き込めませんでした');
			return 'error';
		}
		if (isset($foul)) {
			unlink($data_file);
		}

		$this->ae->add('error', $done_msg);
		$this->af->set('form_file', $data->get('file'));
		$this->af->set('form_name', $data->get('name'));
		return 'tmplPublish';
	}
	function replace($mark, $line_list, &$source)
	{
		$mk = preg_quote($mark, '/');
		$regexp = sprintf('/^(.+%s[\r\n]+)(.*)([\r\n]*%s.+)$/s', $mk, $mk);
		if (!preg_match($regexp, $source)) {
			return false;
		}

		array_unshift($line_list, $mark);
		$line_list[] = $mark;
		$source = preg_replace("/$mk.+?$mk/s", implode("\n", $line_list), $source);
		return true;
	}
	function insertError(&$array, $error)
	{
		for ($j = count($array) - 2; $j > -1; --$j) {
			if (strpos($array[$j], 'error($') !== false) {
				array_splice($array, $j + 1, 0, $error);
				break;
			}
		}
	}
	function makeParts_p($attr_list)
	{
		$cycle = 1;
		$forms = array();
		$confirms = array();
		foreach ($attr_list as $i => $attr) {
			$attr = Ethna_Util::escapeHtml($attr);
			extract($attr);

			$form = FormBuilder::build($attr);
			if ($i === 0) $group = '0';
			if ($required === '1') $name .= '<em class="required">※</em>';
			if ($suffix != '') $form .= ' ' . $suffix;
			if ($example !== '') {
				$example = nl2br($example);
$form .= <<<EOM
<br />
							<em class="example">$example</em>
EOM;
			}
// =================================================================================
$error = <<<EOM
							<?error(\$vars, '$id')?>
EOM;
			if ($group === '0' && $i > 0) {
$forms[] = <<<EOM
						</div>
					</td>
				</tr>
EOM;
			}
			if ($group === '0') {
				$cycle ^= 1;
$forms[] = <<<EOM
				<tr class="zebra$cycle">
					<th>$name</th>
					<td>
						<div>
$error
EOM;
			} else {
				$this->insertError($forms, $error);
				if ($group === '2') $forms[count($forms) - 1] .= '<br />';
			}
$forms[] = <<<EOM
							$form
EOM;
// =================================================================================
			if ($group === '0' && $i > 0) {
$confirms[] = <<<EOM
				</div>
			</td>
		</tr>
EOM;
			}
			if ($group === '0') {
$confirms[] = <<<EOM
		<tr class="zebra$cycle">
			<th>$name</th>
			<td>
				<div>
EOM;
			} else {
				if ($group === '2') $confirms[count($confirms) - 1] .= '<br />';
			}
$confirms[] = <<<EOM
					<?=\${$id}_c?> $suffix
EOM;
// =================================================================================
		}// endforeach
		if ((bool)$forms) {
$forms[] = <<<EOM
						</div>
					</td>
				</tr>
EOM;
$confirms[] = <<<EOM
				</div>
			</td>
		</tr>
EOM;
		}
		return array($confirms, $forms);
	}
	function makeParts_m($attr_list)
	{
		$cycle = 1;
		$forms = array();
		$confirms = array();
		foreach ($attr_list as $i => $attr) {
			$attr = Ethna_Util::escapeHtml($attr);
			extract($attr);

			$form = FormBuilder::build($attr);
			$form = $this->lightweighting($form);
			if ($i === 0) $group = '0';
			if ($required === '1') $name .= '<em class="required">※</em>';
			if ($suffix != '') $form .= ' ' . $suffix;
			if ($example !== '') {
				$example = nl2br($example);
$form .= <<<EOM
<br />
			<em class="example">$example</em>
EOM;
			}
// =================================================================================
$error = <<<EOM
			<?error(\$vars, '$id')?>
EOM;
			if ($group === '0' && $i > 0) {
$forms[] = <<<EOM
		</div>
		<hr />
EOM;
			}
			if ($group === '0') {
				$cycle ^= 1;
$forms[] = <<<EOM
		<div>
			■$name<br />
$error
EOM;
			} else {
				$this->insertError($forms, $error);
				if ($group === '2') $forms[count($forms) - 1] .= '<br />';
			}
$forms[] = <<<EOM
			$form
EOM;
// =================================================================================
			if ($group === '0' && $i > 0) {
$confirms[] = <<<EOM
	</div>
	<hr />
EOM;
			}
			if ($group === '0') {
$confirms[] = <<<EOM
	<div>
		■$name<br />
EOM;
			} else {
				if ($group === '2') $confirms[count($confirms) - 1] .= '<br />';
			}
$confirms[] = <<<EOM
		<?=\${$id}_c?> $suffix
EOM;
// =================================================================================
		}// endforeach
		if ((bool)$forms) {
$forms[] = <<<EOM
		</div>
EOM;
$confirms[] = <<<EOM
	</div>
EOM;
		}
		return array($confirms, $forms);
	}
	function makeBody($attr_list)
	{
		$body = '';
		foreach ($attr_list as $i => $attr) {
			extract($attr);

			if ($i === 0) $group = '0';
			if ($group === '0') {
				$body .= "\n\n■$name\n";
			} else if ($group === '2') {
				$body .= "\n";
			}
			$body .= "{\$$id}";
		}
		$body = ltrim($body);
		return $body;
	}
	function lightweighting($string)
	{
		$regexp = array(
			'/size="\d+?"/',
			'/cols="\d+?"/',
			'/rows="\d+?"/',
			'/style="ime-mode: active.+?"/',
			'/style="ime-mode: .+?"/',
			'/ id="[\w\-]+?"/',
			'/<label.+?>/',
			'/<\/label>/'
		);
		$after = array(
			'size="14"',
			'cols="14"',
			'rows="2"',
			'istyle="1"',
			'istyle="3"',
			'',
			'',
			''
		);
		return preg_replace($regexp, $after, $string);
	}
}

?>
