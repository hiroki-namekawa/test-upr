{include file='_header.html'}

{include file='_menu.html'}

<div id="form">
	<h2>フォーム管理</h2>
	<form action="{$script}" method="post">
		<fieldset>
			<legend>作成フォーム</legend>
			<input type="hidden" name="mode" value="project_add" />
{include file='_error.html'}
			<dl>
				<dt>フォーム名<em class="required">※</em></dt>
					<dd>（注文フォームなど）</dd>
					<dd><input type="text" id="name" name="name" size="50" value="{$app.name}" style="ime-mode: active;" /></dd>
				<dt>ファイル名</dt>
					<dd>（英数小文字と記号_-）</dd>
					<dd><input type="text" id="file" name="file" size="50" value="{$app.file}" /></dd>
			</dl>
			<p>
				<input type="submit" value="作成する" class="button" />
			</p>
		</fieldset>
	</form>
</div>

<div>
	<table summary="フォーム一覧">
		<tr>
			<th style="width: auto;"><span class="help" title="フォームの個別設定">フォーム名</span></th>
			<th style="width: 6%;"><span class="help" title="送信ログの一覧">ログ</span></th>
			<th style="width: 6%;"><span class="help" title="選択項目の集計結果">集計</span></th>
			<th style="width: 9%;"><span class="help" title="設定を反映させたフォームファイルの作成">ﾃﾝﾌﾟﾚｰﾄ</span></th>
			<th style="width: 7%;"><span class="help" title="メール文面の作成">ﾒｰﾙ</span></th>
			<th style="width: 9%;"><span class="help" title="控えメール文面の作成">控えﾒｰﾙ</span></th>
			<th style="width: 7%;"><span class="help" title="フォームを構成する要素の設定">設定</span></th>
			<th style="width: 7%;"><span class="help" title="フォームの完全削除">削除</span></th>
			<th style="width: 5%;"><span class="help" title="フォームを構成する要素数">要素</span></th>
			<th style="width: 15%;"><span class="help" title="設定ファイルの更新時間">更新時間</span></th>
		</tr>
{foreach from=$app.projects key=key item=item}
		<tr id="project{$item.id}"{if $app.index == $item.id} class="selected"{/if}>
			<td style="line-height: 1.3em;">
				<a href="{$script}?mode=project_config&amp;id={$item.id}">{$item.name|truncate_i18n:40}</a><br />
{if $item.published_p}
				<a href="{$item.form_file_p}" title="{$item.form_file_p}">PC用</a>
{else}
				<span style="color: #AAA;" title="{$item.form_file_p}">PC用</span>
{/if}
|
{if $item.published_m}
				<a href="{$item.form_file_m}" title="{$item.form_file_m}">携帯用</a>
{else}
				<span style="color: #AAA;" title="{$item.form_file_m}">携帯用</span>
{/if}
			</td>
			<td><a href="{$script}?mode=project_log&amp;id={$item.id}">見る</a></td>
			<td><a href="{$script}?mode=project_enquete&amp;id={$item.id}">見る</a></td>
			<td><a href="{$script}?mode=project_tmpl_publish&amp;id={$item.id}">作成</a></td>
			<td><a href="{$script}?mode=project_mail_modify&amp;id={$item.id}">編集</a></td>
			<td><a href="{$script}?mode=project_receipt_modify&amp;id={$item.id}">編集</a></td>
			<td><a href="{$script}?mode=project_form&amp;id={$item.id}">設定</a></td>
			<td><a href="{$script}?mode=project_delete&amp;id={$item.id}" onclick="return confirm('このフォームを本当に削除しますか？');" onkeypress="return;">削除</a></td>
			<td>{$item.count}</td>
			<td>{$item.time|newmark:"%m&#26376;%d&#26085; %H:%M"}</td>
		</tr>
{/foreach}
	</table>
</div>

{include file='_footer.html'}
