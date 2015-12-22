{include file='_header.html'}

{include file='_menu.html'}

<div>
	<h2>フォーム個別設定</h2>
	<form action="{$script}" method="post">
		<fieldset>
			<legend>フォーム個別設定</legend>
			<input type="hidden" name="mode" value="project_config_do" />
			<input type="hidden" name="id" value="{$app.id}" />
{include file='_error.html'}
			<dl>
				<dt>フォーム名<em class="required">※</em></dt>
					<dd><input type="text" id="name" name="name" size="50" value="{$app.name}" style="ime-mode: active;" /></dd>
				<dt>受信メールアドレス</dt>
					<dd>（カンマ区切りで複数指定可能、基本設定とは別の受信先にしたい場合だけ設定する。）</dd>
					<dd><input type="text" id="mailto" name="mailto" size="50" value="{$app.mailto}" /></dd>
			</dl>
			<p>
				<input type="button" value="前へ戻る" class="button" onclick="location.href='{$script}?mode=project&amp;index={$app.id}';return false;" onkeypress="return;" />
				<input type="submit" value="設定する" class="button" />
			</p>
		</fieldset>
	</form>
</div>

{include file='_footer.html'}
