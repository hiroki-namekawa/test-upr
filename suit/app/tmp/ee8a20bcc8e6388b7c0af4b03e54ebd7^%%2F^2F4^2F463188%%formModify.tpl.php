<?php /* Smarty version 2.6.19, created on 2015-11-06 12:11:07
         compiled from formModify.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'nl2br', 'formModify.tpl', 15, false),array('function', 'html_radios', 'formModify.tpl', 36, false),)), $this); ?>
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
	<h2>フォーム詳細設定</h2>
<?php if (isset ( $this->_tpl_vars['app']['attr'] )): ?>
	<form action="<?php echo $this->_tpl_vars['script']; ?>
" method="post" style="margin-bottom: 12px;">
		<fieldset>
			<legend>プレビュー</legend>
			<dl>
				<dt><?php echo $this->_tpl_vars['app']['params']['name']; ?>
<?php if ($this->_tpl_vars['app']['params']['required']): ?><em class="required">※</em><?php endif; ?></dt>
					<dd><?php echo $this->_tpl_vars['app_ne']['form']; ?>
 <?php echo $this->_tpl_vars['app']['params']['suffix']; ?>
</dd>
<?php if ($this->_tpl_vars['app']['params']['example']): ?>
					<dd><?php echo ((is_array($_tmp=$this->_tpl_vars['app']['params']['example'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</dd>
<?php endif; ?>
			</dl>
		</fieldset>
	</form>
<?php endif; ?>
	<form action="<?php echo $this->_tpl_vars['script']; ?>
" method="post">
		<fieldset>
			<legend>フォーム詳細設定</legend>
			<input type="hidden" name="mode" value="project_form_modify_do" />
			<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['app']['params']['id']; ?>
" />
			<input type="hidden" name="index" value="<?php echo $this->_tpl_vars['app']['params']['index']; ?>
" />
			<p>
				<input type="button" value="前へ戻る" class="button" onclick="location.href='<?php echo $this->_tpl_vars['script']; ?>
?mode=project_form&amp;id=<?php echo $this->_tpl_vars['app']['params']['id']; ?>
&amp;index=<?php echo $this->_tpl_vars['app']['params']['index']; ?>
';return false;" onkeypress="return;" />
				<input type="submit" value="適用する" class="button" />
			</p>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_error.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<dl>
				<dt>名称<em class="required">※</em></dt>
					<dd><input type="text" id="name" name="name" size="50" value="<?php echo $this->_tpl_vars['app']['params']['name']; ?>
" style="ime-mode: active;" /></dd>
				<dt>必須にする</dt>
					<dd><?php echo smarty_function_html_radios(array('name' => 'required','options' => $this->_tpl_vars['app']['options'],'selected' => $this->_tpl_vars['app']['params']['required'],'label_ids' => true), $this);?>
</dd>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_modify_".($this->_tpl_vars['app']['params']['type_name']).".html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

				<dt>記入例や注意点</dt>
					<dd><textarea id="example" name="example" cols="50" rows="4"><?php echo $this->_tpl_vars['app']['params']['example']; ?>
</textarea></dd>
			</dl>
			<p>
				<input type="button" value="前へ戻る" class="button" onclick="location.href='<?php echo $this->_tpl_vars['script']; ?>
?mode=project_form&amp;id=<?php echo $this->_tpl_vars['app']['params']['id']; ?>
&amp;index=<?php echo $this->_tpl_vars['app']['params']['index']; ?>
';return false;" onkeypress="return;" />
				<input type="submit" value="適用する" class="button" />
			</p>
		</fieldset>
	</form>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_footer.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>