<?php /* Smarty version 2.6.19, created on 2015-10-28 14:40:26
         compiled from _modify_select.html */ ?>
				<dt>選択項目</dt>
					<dd>（「-」で始まる行は空の値がセットされます。「選択して下さい」などに使用。）</dd>
					<dd>（「+」で始まる行はグループ名になり、以降のリストがグループ化されます。）</dd>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_modify_options.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<dd><textarea id="values" name="values" cols="50" rows="9"><?php echo $this->_tpl_vars['app']['params']['values']; ?>
</textarea></dd>
				<dt>フォーム右側に付ける単位</dt>
					<dd><input type="text" id="suffix" name="suffix" size="10" value="<?php echo $this->_tpl_vars['app']['params']['suffix']; ?>
" style="ime-mode: active;" /></dd>