<?php /* Smarty version 2.6.19, created on 2015-11-05 13:26:54
         compiled from mailModify.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'mailModify.tpl', 22, false),array('modifier', 'date_format', 'mailModify.tpl', 32, false),)), $this); ?>
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
	<h2><?php echo $this->_tpl_vars['app']['heading']; ?>
メール文面編集</h2>
	<form action="<?php echo $this->_tpl_vars['script']; ?>
" method="post">
		<fieldset>
			<legend>編集フォーム</legend>
			<input type="hidden" name="mode" value="project_<?php echo $this->_tpl_vars['app']['mode']; ?>
_modify_do" />
			<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['app']['id']; ?>
" />
<?php if ($this->_tpl_vars['app']['mode'] == 'receipt'): ?>
			<ul>
				<li>控えメールは一行入力フォーマットに「控え対応メールアドレス」を設定した場合に送信されます。</li>
			</ul>
<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_error.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<dl>
				<dt>オプション項目</dt>
					<dd>
						<a href="javascript:void(0);" onclick="paste_textarea('body',
							'■IPアドレス\n{$ip}');"title="<?php echo ((is_array($_tmp=$_SERVER['REMOTE_ADDR'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">[ IPアドレス ]</a>
						<a href="javascript:void(0);" onclick="paste_textarea('body',
							'■ホスト名\n{$host}');" title="<?php echo ((is_array($_tmp=$_SERVER['REMOTE_HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">[ ホスト名 ]</a>
						<a href="javascript:void(0);" onclick="paste_textarea('body',
							'■ブラウザ\n{$browser}');" title="<?php echo ((is_array($_tmp=$_SERVER['HTTP_USER_AGENT'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">[ ブラウザ ]</a>
						<a href="javascript:void(0);" onclick="paste_textarea('body',
							'■端末情報\n{$carrier}');" title="ドコモやAUなどの情報">[ 端末情報 ]</a>
						<a href="javascript:void(0);" onclick="paste_textarea('body',
							'■リファラ\n{$referer}');" title="送信元フォームのURL">[ リファラ ]</a>
						<a href="javascript:void(0);" onclick="paste_textarea('body',
							'■送信日付\n{$date}');" title="<?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%y&#24180;%m&#26376;%d&#26085; %H:%M") : smarty_modifier_date_format($_tmp, "%y&#24180;%m&#26376;%d&#26085; %H:%M")); ?>
">[ 送信日付 ]</a>
						<a href="javascript:void(0);" onclick="paste_textarea('body',
							'■送信元情報\nIPアドレス: {$ip}\nホスト名: {$host}\nブラウザ: {$browser}\n端末情報: {$carrier}\nリファラ: {$referer}\n送信日付: {$date}');"
							title="左の項目をまとめて">[ 送信者情報一括 ]</a>
						<br />
						<a href="javascript:void(0);" onclick="paste_textarea('body', '■シリアル番号\n{$serial}');"
							title="A5D4162GRZ8T">[ シリアル番号 ]</a> （注文番号や問い合わせ番号として利用できるメール固有の12桁の英数字）
					</dd>
				<dt>装飾枠</dt>
					<dd>
						<a href="javascript:void(0);" onclick="paste_textarea('body',
'┌──────────────────────────────┐\n│　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　│\n└──────────────────────────────┘'
							);" title="───">[ 細枠 ]</a>
						<a href="javascript:void(0);" onclick="paste_textarea('body',
'┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓\n┃　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　┃\n┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┛'
							);" title="━━━">[ 太枠 ]</a>
					</dd>
				<dt><?php echo $this->_tpl_vars['app']['heading']; ?>
メール文面</dt>
					<dd><textarea id="body" name="body" cols="90" rows="20" class="wide"><?php echo $this->_tpl_vars['app']['body']; ?>
</textarea></dd>
			</dl>
			<p>
				<input type="button" value="前へ戻る" class="button" onclick="location.href='<?php echo $this->_tpl_vars['script']; ?>
?mode=project&amp;index=<?php echo $this->_tpl_vars['app']['id']; ?>
';return false;" onkeypress="return;" />
				<input type="submit" value="保存する" class="button" />
			</p>
		</fieldset>
	</form>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_footer.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>