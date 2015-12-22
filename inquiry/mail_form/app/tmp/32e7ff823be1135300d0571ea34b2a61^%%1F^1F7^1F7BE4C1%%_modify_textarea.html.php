<?php /* Smarty version 2.6.19, created on 2015-06-19 17:28:24
         compiled from _modify_textarea.html */ ?>
				<dt>
					独自チェックを行う場合の<span class="help" title="preg_match関数に与えるデリミタ付き正規表現">正規表現</span>
					<a href="http://jp.php.net/manual/ja/function.preg-match.php" target="_blank" title="PHPマニュアルを見る">man</a>
				</dt>
					<dd><input type="text" id="regexp" name="regexp" size="50" value="<?php echo $this->_tpl_vars['app']['params']['regexp']; ?>
" style="ime-mode: inactive;" /></dd>
				<dt>独自チェックのエラー文</dt>
					<dd><input type="text" id="regexp_error" name="regexp_error" size="50" value="<?php echo $this->_tpl_vars['app']['params']['regexp_error']; ?>
" style="ime-mode: active;" /></dd>
				<dt>style属性</dt>
					<dd>
						<a href="javascript:void(0);" onclick="paste('style', this.title);" title="ime-mode: active;">[ 全角入力モード ]</a>
						<a href="javascript:void(0);" onclick="paste('style', this.title);" title="ime-mode: inactive;">[ 半角入力モード ]</a>
						<a href="javascript:void(0);" onclick="paste('style', this.title);" title="ime-mode: disabled;">[ 半角入力限定モード ]</a>
					</dd>
					<dd><input type="text" id="style" name="style" size="50" value="<?php echo $this->_tpl_vars['app']['params']['style']; ?>
" /></dd>
				<dt>文字数制限（半角文字数）</dt>
					<dd><input type="text" id="max" name="max" size="10" value="<?php echo $this->_tpl_vars['app']['params']['max']; ?>
" /></dd>
				<dt>横幅</dt>
					<dd><input type="text" id="width" name="width" size="10" value="<?php echo $this->_tpl_vars['app']['params']['width']; ?>
" /></dd>
				<dt>縦幅</dt>
					<dd><input type="text" id="height" name="height" size="10" value="<?php echo $this->_tpl_vars['app']['params']['height']; ?>
" /></dd>