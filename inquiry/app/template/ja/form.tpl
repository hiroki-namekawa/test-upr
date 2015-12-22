{include file='_header.html'}

{include file='_menu.html'}

<div id="form">
	<h2>{$app.form_name}</h2>
	<form action="{$script}" method="post">
		<fieldset>
			<legend>追加フォーム</legend>
			<input type="hidden" name="mode" value="project_form_add" />
			<input type="hidden" name="id" value="{$app.id}" />
			<ul>
				<li><a href="javascript:void(0);" onclick="toggle('onepoint');return false;" onkeypress="return;" title="開閉します">ヒント↓</a></li>
			</ul>
			<ul id="onepoint" style="display: none;">
				<li>複数の選択肢からの単一選択にはラジオボタン、複数選択にはチェックボックスを使います。</li>
				<li>「郵便番号などを複数フォームに分けない」「確認の再入力をさせない」「必須項目を減らす」などすると送信率が上がります。</li>
{if $smarty.server.HTTPS != 'on'}
				<li>住所や経歴など大切な個人情報を扱う場合は<span class="help" title="サーバとブラウザを安全に通信する技術">SSL暗号</span>への対応をご検討下さい。（現在非対応）</li>
{/if}
			</ul>
{include file='_error.html'}
			<p>
				{html_radios name="type" options=$app.type_options selected=$app.type label_ids=true onclick="this.form.submit();"}
			</p>
			<p>
				<select id="index" name="index">
					{html_options options=$app.index_options selected=$app.index}
				</select>
				行目に追加
			</p>
			<p>
				<input type="button" value="前へ戻る" class="button" onclick="location.href='{$script}?mode=project&amp;index={$app.id}';return false;" onkeypress="return;" />
				<input type="submit" value="追加する" class="button" id="button" />
			</p>
		</fieldset>
	</form>
</div>

<script type="text/javascript">
// <![CDATA[
	document.getElementById('button').style.display = 'none';
// ]]>
</script>

<div>
	<table summary="フォーム要素一覧" onclick="ontouch(event, 'selected');" onkeydown="return;">
		<tr>
			<th style="width: 4%;"><span class="help" title="枠内クリックで行番号をセット">行</span></th>
			<th style="width: auto;">フォーム名</th>
			<th style="width: 13%;">イメージ</th>
			<th style="width: 16%;">設定</th>
			<th style="width: 11%;">上へ配置</th>
			<th style="width: 11%;">下へ配置</th>
			<th style="width: 11%;">削除</th>
		</tr>
{foreach from=$app_ne.forms key=key item=item name=forms}
		<tr id="forms{$key+1}"{if $app.index == $key+1} class="selected"{/if}>
			<td>{$key+1}</td>
			<td>{if $item.group == 2}↓ {elseif $item.group == 1}→ {/if}{$item.name}{if $item.required}<em class="required">※</em>{/if}</td>
<!--
			<td>{$item.form}</td>
-->
			<td><img src="{$config.template_dir}image/{$item.type_name}.gif" alt="{$item.type_name}" /> {$item.suffix}</td>
			<td><a href="{$script}?mode=project_form_modify&amp;id={$app.id}&amp;index={$key+1}">{$app.type_options[$item.type_name]}</a></td>
{if $smarty.foreach.forms.first}
			<td>上へ配置</td>
{else}
			<td><a href="{$script}?mode=project_form_up&amp;id={$app.id}&amp;index={$key+1}">上へ配置</a></td>
{/if}
{if $smarty.foreach.forms.last}
			<td>下へ配置</td>
{else}
			<td><a href="{$script}?mode=project_form_down&amp;id={$app.id}&amp;index={$key+1}">下へ配置</a></td>
{/if}
			<td><a href="{$script}?mode=project_form_delete&amp;id={$app.id}&amp;index={$key+1}">削除する</a></td>
		</tr>
{/foreach}
	</table>
</div>

{include file='_footer.html'}
