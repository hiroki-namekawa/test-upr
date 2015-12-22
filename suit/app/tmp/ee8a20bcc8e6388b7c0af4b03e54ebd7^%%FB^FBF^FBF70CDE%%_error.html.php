<?php /* Smarty version 2.6.19, created on 2015-11-05 14:59:29
         compiled from _error.html */ ?>
<?php if (count ( $this->_tpl_vars['errors'] ) > 0): ?>
			<ul class="error">
<?php $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['error']):
?>
				<li><?php echo $this->_tpl_vars['error']; ?>
。</li>
<?php endforeach; endif; unset($_from); ?>
			</ul>
<?php endif; ?>