{include file='_header.html'}

{include file='_menu.html'}

<div>
	<h2>{$app.heading}メール文面編集</h2>
	<form action="{$script}" method="post">
		<fieldset>
			<legend>編集フォーム</legend>
			<input type="hidden" name="mode" value="project_{$app.mode}_modify_do" />
			<input type="hidden" name="id" value="{$app.id}" />
{if $app.mode == 'receipt'}
			<ul>
				<li>控えメールは一行入力フォーマットに「控え対応メールアドレス」を設定した場合に送信されます。</li>
			</ul>
{/if}
{include file='_error.html'}
			<dl>
				<dt>オプション項目</dt>
					<dd>
						<a href="javascript:void(0);" onclick="paste_textarea('body',
							'■IPアドレス\n{ldelim}$ip{rdelim}');"title="{$smarty.server.REMOTE_ADDR|escape}">[ IPアドレス ]</a>
						<a href="javascript:void(0);" onclick="paste_textarea('body',
							'■ホスト名\n{ldelim}$host{rdelim}');" title="{$smarty.server.REMOTE_HOST|escape}">[ ホスト名 ]</a>
						<a href="javascript:void(0);" onclick="paste_textarea('body',
							'■ブラウザ\n{ldelim}$browser{rdelim}');" title="{$smarty.server.HTTP_USER_AGENT|escape}">[ ブラウザ ]</a>
						<a href="javascript:void(0);" onclick="paste_textarea('body',
							'■端末情報\n{ldelim}$carrier{rdelim}');" title="ドコモやAUなどの情報">[ 端末情報 ]</a>
						<a href="javascript:void(0);" onclick="paste_textarea('body',
							'■リファラ\n{ldelim}$referer{rdelim}');" title="送信元フォームのURL">[ リファラ ]</a>
						<a href="javascript:void(0);" onclick="paste_textarea('body',
							'■送信日付\n{ldelim}$date{rdelim}');" title="{$smarty.now|date_format:"%y&#24180;%m&#26376;%d&#26085; %H:%M"}">[ 送信日付 ]</a>
						<a href="javascript:void(0);" onclick="paste_textarea('body',
							'■送信元情報\nIPアドレス: {ldelim}$ip{rdelim}\nホスト名: {ldelim}$host{rdelim}\nブラウザ: {ldelim}$browser{rdelim}\n端末情報: {ldelim}$carrier{rdelim}\nリファラ: {ldelim}$referer{rdelim}\n送信日付: {ldelim}$date{rdelim}');"
							title="左の項目をまとめて">[ 送信者情報一括 ]</a>
						<br />
						<a href="javascript:void(0);" onclick="paste_textarea('body', '■シリアル番号\n{ldelim}$serial{rdelim}');"
							title="A5D4162GRZ8T">[ シリアル番号 ]</a> （注文番号や問い合わせ番号として利用できるメール固有の12桁の英数字）
					</dd>
				<dt>装飾枠</dt>
					<dd>
						<a href="javascript:void(0);" onclick="paste_textarea('body',
'┌──────────────────────────────┐\n│　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　│\n└──────────────────────────────┘'
							);" title="───">[ 細枠 ]</a>
						<a href="javascript:void(0);" onclick="paste_textarea('body',
'┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓\n┃　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　┃\n┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┛'
							);" title="━━━">[ 太枠 ]</a>
					</dd>
				<dt>{$app.heading}メール文面</dt>
					<dd><textarea id="body" name="body" cols="90" rows="20" class="wide">{$app.body}</textarea></dd>
			</dl>
			<p>
				<input type="button" value="前へ戻る" class="button" onclick="location.href='{$script}?mode=project&amp;index={$app.id}';return false;" onkeypress="return;" />
				<input type="submit" value="保存する" class="button" />
			</p>
		</fieldset>
	</form>
</div>

{include file='_footer.html'}
