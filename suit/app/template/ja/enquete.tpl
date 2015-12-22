{include file='_header.html'}

{include file='_menu.html'}

<div>
	<h2>{$app.form_name}集計結果（投票者{$app.count}名）</h2>
	<p>
		<input type="button" value="前へ戻る" class="button" onclick="location.href='{$script}?mode=project&amp;index={$app.id}';return false;" onkeypress="return;" />
		<input type="button" value="削除する" class="button" onclick="if(confirm('この集計結果を本当に削除しますか？'))location.href='{$script}?mode=project_enquete_delete&amp;id={$app.id}';return false;" onkeypress="return;" />
	</p>
{foreach from=$app.list key=key item=item}
	<table summary="{$item.name}" style="margin-top: 20px;">
		<tr>
			<th style="width: 5%;">順位</th>
			<th style="width: 40%;">{$item.name}（{$item.type}）</th>
			<th style="width: 9%;">投票数</th>
			<th style="width: auto;">投票率（計{$item.total}票）</th>
		</tr>
{foreach from=$item.vote key=key item=vote name=vote}
		<tr>
			<td>{$smarty.foreach.vote.iteration}</td>
			<td>{$key|escape}{$item.suffix}</td>
			<td>{$vote.vote}票</td>
			<td class="graph"><em style="width: {$vote.width}%;"><span>{$vote.rate}%</span></em></td>
		</tr>
{/foreach}
	</table>
{/foreach}
</div>

{include file='_footer.html'}
