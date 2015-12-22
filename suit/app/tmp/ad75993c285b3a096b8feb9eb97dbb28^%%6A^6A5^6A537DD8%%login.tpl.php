<?php /* Smarty version 2.6.19, created on 2015-11-05 13:23:43
         compiled from login.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_header.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div>
	<h2>管理者用</h2>
	<form action="<?php echo $this->_tpl_vars['script']; ?>
" method="post">
		<fieldset>
		<legend>認証フォーム</legend>
			<input type="hidden" name="mode" value="login" />
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_error.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<dl>
				<dt>パスワード</dt>
					<dd><input type="password" id="pass" name="pass" size="16" value="" /></dd>
			</dl>
			<p><input type="submit" value="認証する" class="button" /></p>
		</fieldset>
	</form>
</div>

<div>
	<p><a href="<?php echo $this->_tpl_vars['script']; ?>
" onclick="return addFavorite(this);">お気に入りに登録する</a></p>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_footer.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>