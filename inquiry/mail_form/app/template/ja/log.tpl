{include file='_header.html'}

{include file='_menu.html'}

<div>
	<h2>送信ログ管理</h2>
	<p>
		<input type="button" value="前へ戻る" class="button" onclick="location.href='{$script}?mode=project&amp;index={$app.id}';return false;" onkeypress="return;" />
		<input type="button" value="削除する" class="button" onclick="if(confirm('このフォームの送信ログをすべて削除しますか？'))location.href='{$script}?mode=project_log_clear&amp;id={$app.id}';return false;" onkeypress="return;" />
	</p>
	<table summary="送信ログ一覧">
		<tr>
			<th style="width: 4%;">行</th>
			<th style="width: auto;">ファイル名</th>
			<th style="width: 17%;">ダウンロード</th>
			<th style="width: 17%;">削除</th>
			<th style="width: 24%;">送信時間</th>
		</tr>
{foreach from=$app.logs key=key item=item}
		<tr id="log{$key+1}">
			<td>{$key+1}</td>
			<td><a href="{$script}?mode=project_log_read&amp;file={$item.file}" target="_blank" title="別窓で開きます">{$item.file}</a></td>
			<td><a href="{$script}?mode=project_log_download&amp;file={$item.file}">ダウンロードする</a></td>
			<td><a href="{$script}?mode=project_log_delete&amp;file={$item.file}">削除する</a></td>
			<td>{$item.time|newmark:"%Y&#24180;%m&#26376;%d&#26085; %H:%M"}</td>
		</tr>
{/foreach}
	</table>
</div>

{include file='_footer.html'}
