<?php /* Smarty version 2.6.19, created on 2015-06-22 11:33:07
         compiled from pwd.tpl */ ?>
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
	<h2>パスワード変更</h2>
	<form action="<?php echo $this->_tpl_vars['script']; ?>
" method="post">
		<fieldset>
			<legend>パスワード変更</legend>
			<input type="hidden" name="mode" value="project_pwd_do" />
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_error.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<dl>
				<dt>現在のパスワード</dt>
					<dd><input type="password" id="oldpass" name="oldpass" size="16" value="" class="pass" /></dd>
				<dt>新しいパスワード</dt>
					<dd>（半角英数字と記号_.+-*@/の組み合わせ6～16文字）</dd>
					<dd><input type="password" id="newpass" name="newpass" size="16" value="" class="pass" /></dd>
				<dt>確認の為に再入力</dt>
					<dd><input type="password" id="chkpass" name="chkpass" size="16" value="" class="pass" /></dd>
			</dl>
			<p>
				<input type="button" value="前へ戻る" class="button" onclick="location.href='<?php echo $this->_tpl_vars['script']; ?>
?mode=project';return false;" onkeypress="return;" />
				<input type="submit" value="変更する" class="button" />
			</p>
		</fieldset>
	</form>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_footer.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>