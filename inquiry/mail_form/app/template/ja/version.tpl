{include file='_header.html'}

{include file='_menu.html'}

<div>
	<h2>バージョン情報</h2>
	<p>
		<input type="submit" value="前へ戻る" class="button" onclick="history.back();return false;" onkeypress="return;" />
	</p>
	<table summary="バージョン情報">
		<tr>
			<th style="width: 18%;">名称</th>
			<th style="width: 40%;">バージョン</th>
			<th style="width: suto;">サイト</th>
		</tr>
		<tr>
			<td>ES-FORM</td>
			<td>-</td>
			<td><a href="http://www.mt312.com/">http://www.mt312.com/</a></td>
		</tr>
		<tr>
			<td>Server</td>
			<td>{$smarty.server.SERVER_SOFTWARE|escape}</td>
			<td>-</td>
		</tr>
		<tr>
			<td>PHP</td>
			<td>{$smarty.const.PHP_VERSION}</td>
			<td><a href="http://jp.php.net/">http://jp.php.net/</a></td>
		</tr>
		<tr>
			<td>Ethna</td>
			<td>{$smarty.const.ETHNA_VERSION}</td>
			<td><a href="http://ethna.jp/">http://ethna.jp/</a></td>
		</tr>
		<tr>
			<td>Smarty</td>
			<td>{$smarty.version}</td>
			<td><a href="http://www.smarty.net/">http://www.smarty.net/</a></td>
		</tr>
		<tr>
			<td>prototype.js</td>
			<td>{$app.proto_version}</td>
			<td><a href="http://www.prototypejs.org/">http://www.prototypejs.org/</a></td>
		</tr>
	</table>
</div>

{include file='_footer.html'}
