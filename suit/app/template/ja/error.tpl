{include file='_header.html'}

<div>
	<h2>エラー</h2>
	<form action="{$script}" method="get">
		<fieldset>
			<legend>エラー</legend>
{include file='_error.html'}
			<p><input type="submit" value="前へ戻る" class="button" onclick="history.back();return false;" onkeypress="return;" /></p>
		</fieldset>
	</form>
</div>

{include file='_footer.html'}
