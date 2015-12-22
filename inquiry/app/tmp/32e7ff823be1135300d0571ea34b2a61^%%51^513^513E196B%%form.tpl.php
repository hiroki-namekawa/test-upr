<?php /* Smarty version 2.6.19, created on 2015-06-19 17:27:02
         compiled from form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_radios', 'form.tpl', 24, false),array('function', 'html_options', 'form.tpl', 28, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_header.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_menu.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="form">
	<h2><?php echo $this->_tpl_vars['app']['form_name']; ?>
</h2>
	<form action="<?php echo $this->_tpl_vars['script']; ?>
" method="post">
		<fieldset>
			<legend>追加フォーム</legend>
			<input type="hidden" name="mode" value="project_form_add" />
			<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['app']['id']; ?>
" />
			<ul>
				<li><a href="javascript:void(0);" onclick="toggle('onepoint');return false;" onkeypress="return;" title="開閉します">ヒント↓</a></li>
			</ul>
			<ul id="onepoint" style="display: none;">
				<li>複数の選択肢からの単一選択にはラジオボタン、複数選択にはチェックボックスを使います。</li>
				<li>「郵便番号などを複数フォームに分けない」「確認の再入力をさせない」「必須項目を減らす」などすると送信率が上がります。</li>
<?php if ($_SERVER['HTTPS'] != 'on'): ?>
				<li>住所や経歴など大切な個人情報を扱う場合は<span class="help" title="サーバとブラウザを安全に通信する技術">SSL暗号</span>への対応をご検討下さい。（現在非対応）</li>
<?php endif; ?>
			</ul>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_error.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<p>
				<?php echo smarty_function_html_radios(array('name' => 'type','options' => $this->_tpl_vars['app']['type_options'],'selected' => $this->_tpl_vars['app']['type'],'label_ids' => true,'onclick' => "this.form.submit();"), $this);?>

			</p>
			<p>
				<select id="index" name="index">
					<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['app']['index_options'],'selected' => $this->_tpl_vars['app']['index']), $this);?>

				</select>
				行目に追加
			</p>
			<p>
				<input type="button" value="前へ戻る" class="button" onclick="location.href='<?php echo $this->_tpl_vars['script']; ?>
?mode=project&amp;index=<?php echo $this->_tpl_vars['app']['id']; ?>
';return false;" onkeypress="return;" />
				<input type="submit" value="追加する" class="button" id="button" />
			</p>
		</fieldset>
	</form>
</div>

<script type="text/javascript">
// <![CDATA[
	document.getElementById('button').style.display = 'none';
// ]]>
</script>

<div>
	<table summary="フォーム要素一覧" onclick="ontouch(event, 'selected');" onkeydown="return;">
		<tr>
			<th style="width: 4%;"><span class="help" title="枠内クリックで行番号をセット">行</span></th>
			<th style="width: auto;">フォーム名</th>
			<th style="width: 13%;">イメージ</th>
			<th style="width: 16%;">設定</th>
			<th style="width: 11%;">上へ配置</th>
			<th style="width: 11%;">下へ配置</th>
			<th style="width: 11%;">削除</th>
		</tr>
<?php $_from = $this->_tpl_vars['app_ne']['forms']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['forms'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['forms']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['forms']['iteration']++;
?>
		<tr id="forms<?php echo $this->_tpl_vars['key']+1; ?>
"<?php if ($this->_tpl_vars['app']['index'] == $this->_tpl_vars['key']+1): ?> class="selected"<?php endif; ?>>
			<td><?php echo $this->_tpl_vars['key']+1; ?>
</td>
			<td><?php if ($this->_tpl_vars['item']['group'] == 2): ?>↓ <?php elseif ($this->_tpl_vars['item']['group'] == 1): ?>→ <?php endif; ?><?php echo $this->_tpl_vars['item']['name']; ?>
<?php if ($this->_tpl_vars['item']['required']): ?><em class="required">※</em><?php endif; ?></td>
<!--
			<td><?php echo $this->_tpl_vars['item']['form']; ?>
</td>
-->
			<td><img src="<?php echo $this->_tpl_vars['config']['template_dir']; ?>
image/<?php echo $this->_tpl_vars['item']['type_name']; ?>
.gif" alt="<?php echo $this->_tpl_vars['item']['type_name']; ?>
" /> <?php echo $this->_tpl_vars['item']['suffix']; ?>
</td>
			<td><a href="<?php echo $this->_tpl_vars['script']; ?>
?mode=project_form_modify&amp;id=<?php echo $this->_tpl_vars['app']['id']; ?>
&amp;index=<?php echo $this->_tpl_vars['key']+1; ?>
"><?php echo $this->_tpl_vars['app']['type_options'][$this->_tpl_vars['item']['type_name']]; ?>
</a></td>
<?php if (($this->_foreach['forms']['iteration'] <= 1)): ?>
			<td>上へ配置</td>
<?php else: ?>
			<td><a href="<?php echo $this->_tpl_vars['script']; ?>
?mode=project_form_up&amp;id=<?php echo $this->_tpl_vars['app']['id']; ?>
&amp;index=<?php echo $this->_tpl_vars['key']+1; ?>
">上へ配置</a></td>
<?php endif; ?>
<?php if (($this->_foreach['forms']['iteration'] == $this->_foreach['forms']['total'])): ?>
			<td>下へ配置</td>
<?php else: ?>
			<td><a href="<?php echo $this->_tpl_vars['script']; ?>
?mode=project_form_down&amp;id=<?php echo $this->_tpl_vars['app']['id']; ?>
&amp;index=<?php echo $this->_tpl_vars['key']+1; ?>
">下へ配置</a></td>
<?php endif; ?>
			<td><a href="<?php echo $this->_tpl_vars['script']; ?>
?mode=project_form_delete&amp;id=<?php echo $this->_tpl_vars['app']['id']; ?>
&amp;index=<?php echo $this->_tpl_vars['key']+1; ?>
">削除する</a></td>
		</tr>
<?php endforeach; endif; unset($_from); ?>
	</table>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_footer.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>