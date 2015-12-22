<?php /* Smarty version 2.6.19, created on 2015-06-22 11:33:09
         compiled from version.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'version.tpl', 23, false),)), $this); ?>
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
	<h2>バージョン情報</h2>
	<p>
		<input type="submit" value="前へ戻る" class="button" onclick="history.back();return false;" onkeypress="return;" />
	</p>
	<table summary="バージョン情報">
		<tr>
			<th style="width: 18%;">名称</th>
			<th style="width: 40%;">バージョン</th>
			<th style="width: suto;">サイト</th>
		</tr>
		<tr>
			<td>ES-FORM</td>
			<td>-</td>
			<td><a href="http://www.mt312.com/">http://www.mt312.com/</a></td>
		</tr>
		<tr>
			<td>Server</td>
			<td><?php echo ((is_array($_tmp=$_SERVER['SERVER_SOFTWARE'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
			<td>-</td>
		</tr>
		<tr>
			<td>PHP</td>
			<td><?php echo @PHP_VERSION; ?>
</td>
			<td><a href="http://jp.php.net/">http://jp.php.net/</a></td>
		</tr>
		<tr>
			<td>Ethna</td>
			<td><?php echo @ETHNA_VERSION; ?>
</td>
			<td><a href="http://ethna.jp/">http://ethna.jp/</a></td>
		</tr>
		<tr>
			<td>Smarty</td>
			<td><?php echo '2.6.19'; ?>
</td>
			<td><a href="http://www.smarty.net/">http://www.smarty.net/</a></td>
		</tr>
		<tr>
			<td>prototype.js</td>
			<td><?php echo $this->_tpl_vars['app']['proto_version']; ?>
</td>
			<td><a href="http://www.prototypejs.org/">http://www.prototypejs.org/</a></td>
		</tr>
	</table>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_footer.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>