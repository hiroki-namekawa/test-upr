<?php /* Smarty version 2.6.19, created on 2015-06-22 11:33:03
         compiled from project.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate_i18n', 'project.tpl', 44, false),array('modifier', 'newmark', 'project.tpl', 65, false),)), $this); ?>
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
	<h2>フォーム管理</h2>
	<form action="<?php echo $this->_tpl_vars['script']; ?>
" method="post">
		<fieldset>
			<legend>作成フォーム</legend>
			<input type="hidden" name="mode" value="project_add" />
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_error.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<dl>
				<dt>フォーム名<em class="required">※</em></dt>
					<dd>（注文フォームなど）</dd>
					<dd><input type="text" id="name" name="name" size="50" value="<?php echo $this->_tpl_vars['app']['name']; ?>
" style="ime-mode: active;" /></dd>
				<dt>ファイル名</dt>
					<dd>（英数小文字と記号_-）</dd>
					<dd><input type="text" id="file" name="file" size="50" value="<?php echo $this->_tpl_vars['app']['file']; ?>
" /></dd>
			</dl>
			<p>
				<input type="submit" value="作成する" class="button" />
			</p>
		</fieldset>
	</form>
</div>

<div>
	<table summary="フォーム一覧">
		<tr>
			<th style="width: auto;"><span class="help" title="フォームの個別設定">フォーム名</span></th>
			<th style="width: 6%;"><span class="help" title="送信ログの一覧">ログ</span></th>
			<th style="width: 6%;"><span class="help" title="選択項目の集計結果">集計</span></th>
			<th style="width: 9%;"><span class="help" title="設定を反映させたフォームファイルの作成">ﾃﾝﾌﾟﾚｰﾄ</span></th>
			<th style="width: 7%;"><span class="help" title="メール文面の作成">ﾒｰﾙ</span></th>
			<th style="width: 9%;"><span class="help" title="控えメール文面の作成">控えﾒｰﾙ</span></th>
			<th style="width: 7%;"><span class="help" title="フォームを構成する要素の設定">設定</span></th>
			<th style="width: 7%;"><span class="help" title="フォームの完全削除">削除</span></th>
			<th style="width: 5%;"><span class="help" title="フォームを構成する要素数">要素</span></th>
			<th style="width: 15%;"><span class="help" title="設定ファイルの更新時間">更新時間</span></th>
		</tr>
<?php $_from = $this->_tpl_vars['app']['projects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
		<tr id="project<?php echo $this->_tpl_vars['item']['id']; ?>
"<?php if ($this->_tpl_vars['app']['index'] == $this->_tpl_vars['item']['id']): ?> class="selected"<?php endif; ?>>
			<td style="line-height: 1.3em;">
				<a href="<?php echo $this->_tpl_vars['script']; ?>
?mode=project_config&amp;id=<?php echo $this->_tpl_vars['item']['id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['name'])) ? $this->_run_mod_handler('truncate_i18n', true, $_tmp, 40) : smarty_modifier_truncate_i18n($_tmp, 40)); ?>
</a><br />
<?php if ($this->_tpl_vars['item']['published_p']): ?>
				<a href="<?php echo $this->_tpl_vars['item']['form_file_p']; ?>
" title="<?php echo $this->_tpl_vars['item']['form_file_p']; ?>
">PC用</a>
<?php else: ?>
				<span style="color: #AAA;" title="<?php echo $this->_tpl_vars['item']['form_file_p']; ?>
">PC用</span>
<?php endif; ?>
|
<?php if ($this->_tpl_vars['item']['published_m']): ?>
				<a href="<?php echo $this->_tpl_vars['item']['form_file_m']; ?>
" title="<?php echo $this->_tpl_vars['item']['form_file_m']; ?>
">携帯用</a>
<?php else: ?>
				<span style="color: #AAA;" title="<?php echo $this->_tpl_vars['item']['form_file_m']; ?>
">携帯用</span>
<?php endif; ?>
			</td>
			<td><a href="<?php echo $this->_tpl_vars['script']; ?>
?mode=project_log&amp;id=<?php echo $this->_tpl_vars['item']['id']; ?>
">見る</a></td>
			<td><a href="<?php echo $this->_tpl_vars['script']; ?>
?mode=project_enquete&amp;id=<?php echo $this->_tpl_vars['item']['id']; ?>
">見る</a></td>
			<td><a href="<?php echo $this->_tpl_vars['script']; ?>
?mode=project_tmpl_publish&amp;id=<?php echo $this->_tpl_vars['item']['id']; ?>
">作成</a></td>
			<td><a href="<?php echo $this->_tpl_vars['script']; ?>
?mode=project_mail_modify&amp;id=<?php echo $this->_tpl_vars['item']['id']; ?>
">編集</a></td>
			<td><a href="<?php echo $this->_tpl_vars['script']; ?>
?mode=project_receipt_modify&amp;id=<?php echo $this->_tpl_vars['item']['id']; ?>
">編集</a></td>
			<td><a href="<?php echo $this->_tpl_vars['script']; ?>
?mode=project_form&amp;id=<?php echo $this->_tpl_vars['item']['id']; ?>
">設定</a></td>
			<td><a href="<?php echo $this->_tpl_vars['script']; ?>
?mode=project_delete&amp;id=<?php echo $this->_tpl_vars['item']['id']; ?>
" onclick="return confirm('このフォームを本当に削除しますか？');" onkeypress="return;">削除</a></td>
			<td><?php echo $this->_tpl_vars['item']['count']; ?>
</td>
			<td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['time'])) ? $this->_run_mod_handler('newmark', true, $_tmp, "%m&#26376;%d&#26085; %H:%M") : smarty_modifier_newmark($_tmp, "%m&#26376;%d&#26085; %H:%M")); ?>
</td>
		</tr>
<?php endforeach; endif; unset($_from); ?>
	</table>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_footer.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>