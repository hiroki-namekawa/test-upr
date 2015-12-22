<?php /* Smarty version 2.6.19, created on 2015-06-22 11:36:09
         compiled from log.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'newmark', 'log.tpl', 25, false),)), $this); ?>
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

<div>
	<h2>送信ログ管理</h2>
	<p>
		<input type="button" value="前へ戻る" class="button" onclick="location.href='<?php echo $this->_tpl_vars['script']; ?>
?mode=project&amp;index=<?php echo $this->_tpl_vars['app']['id']; ?>
';return false;" onkeypress="return;" />
		<input type="button" value="削除する" class="button" onclick="if(confirm('このフォームの送信ログをすべて削除しますか？'))location.href='<?php echo $this->_tpl_vars['script']; ?>
?mode=project_log_clear&amp;id=<?php echo $this->_tpl_vars['app']['id']; ?>
';return false;" onkeypress="return;" />
	</p>
	<table summary="送信ログ一覧">
		<tr>
			<th style="width: 4%;">行</th>
			<th style="width: auto;">ファイル名</th>
			<th style="width: 17%;">ダウンロード</th>
			<th style="width: 17%;">削除</th>
			<th style="width: 24%;">送信時間</th>
		</tr>
<?php $_from = $this->_tpl_vars['app']['logs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
		<tr id="log<?php echo $this->_tpl_vars['key']+1; ?>
">
			<td><?php echo $this->_tpl_vars['key']+1; ?>
</td>
			<td><a href="<?php echo $this->_tpl_vars['script']; ?>
?mode=project_log_read&amp;file=<?php echo $this->_tpl_vars['item']['file']; ?>
" target="_blank" title="別窓で開きます"><?php echo $this->_tpl_vars['item']['file']; ?>
</a></td>
			<td><a href="<?php echo $this->_tpl_vars['script']; ?>
?mode=project_log_download&amp;file=<?php echo $this->_tpl_vars['item']['file']; ?>
">ダウンロードする</a></td>
			<td><a href="<?php echo $this->_tpl_vars['script']; ?>
?mode=project_log_delete&amp;file=<?php echo $this->_tpl_vars['item']['file']; ?>
">削除する</a></td>
			<td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['time'])) ? $this->_run_mod_handler('newmark', true, $_tmp, "%Y&#24180;%m&#26376;%d&#26085; %H:%M") : smarty_modifier_newmark($_tmp, "%Y&#24180;%m&#26376;%d&#26085; %H:%M")); ?>
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