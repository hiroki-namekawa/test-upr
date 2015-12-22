{include file='_header.html'}

{include file='_menu.html'}

<div>
	<h2>フォーム詳細設定</h2>
{if isset($app.attr)}
	<form action="{$script}" method="post" style="margin-bottom: 12px;">
		<fieldset>
			<legend>プレビュー</legend>
			<dl>
				<dt>{$app.params.name}{if $app.params.required}<em class="required">※</em>{/if}</dt>
					<dd>{$app_ne.form} {$app.params.suffix}</dd>
{if $app.params.example}
					<dd>{$app.params.example|nl2br}</dd>
{/if}
			</dl>
		</fieldset>
	</form>
{/if}
	<form action="{$script}" method="post">
		<fieldset>
			<legend>フォーム詳細設定</legend>
			<input type="hidden" name="mode" value="project_form_modify_do" />
			<input type="hidden" name="id" value="{$app.params.id}" />
			<input type="hidden" name="index" value="{$app.params.index}" />
			<p>
				<input type="button" value="前へ戻る" class="button" onclick="location.href='{$script}?mode=project_form&amp;id={$app.params.id}&amp;index={$app.params.index}';return false;" onkeypress="return;" />
				<input type="submit" value="適用する" class="button" />
			</p>
{include file='_error.html'}
			<dl>
				<dt>名称<em class="required">※</em></dt>
					<dd><input type="text" id="name" name="name" size="50" value="{$app.params.name}" style="ime-mode: active;" /></dd>
				<dt>必須にする</dt>
					<dd>{html_radios name="required" options=$app.options selected=$app.params.required label_ids=true}</dd>
{include file="_modify_`$app.params.type_name`.html"}

				<dt>記入例や注意点</dt>
					<dd><textarea id="example" name="example" cols="50" rows="4">{$app.params.example}</textarea></dd>
			</dl>
			<p>
				<input type="button" value="前へ戻る" class="button" onclick="location.href='{$script}?mode=project_form&amp;id={$app.params.id}&amp;index={$app.params.index}';return false;" onkeypress="return;" />
				<input type="submit" value="適用する" class="button" />
			</p>
		</fieldset>
	</form>
</div>

{include file='_footer.html'}
