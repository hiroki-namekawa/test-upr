{include file='_header.html'}

<div>
	<h2>管理者用</h2>
	<form action="{$script}" method="post">
		<fieldset>
		<legend>認証フォーム</legend>
			<input type="hidden" name="mode" value="login" />
{include file='_error.html'}
			<dl>
				<dt>パスワード</dt>
					<dd><input type="password" id="pass" name="pass" size="16" value="" /></dd>
			</dl>
			<p><input type="submit" value="認証する" class="button" /></p>
		</fieldset>
	</form>
</div>

<div>
	<p><a href="{$script}" onclick="return addFavorite(this);">お気に入りに登録する</a></p>
</div>

{include file='_footer.html'}
