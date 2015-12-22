{include file='_header.html'}

{include file='_menu.html'}

<div>
	<h2>テンプレート編集</h2>
	<form action="{$script}" method="post">
		<fieldset>
			<legend>編集フォーム</legend>
			<input type="hidden" name="mode" value="project_tmpl_modify_do" />
			<input type="hidden" name="id" value="{$app.id}" />
			<input type="hidden" name="index" value="{$app.index}" />
			<ul id="notice">
				<li>&lt;? ?&gt;で囲まれたPHPコードを消さない様に注意して下さい。</li>
				<li>テンプレートには「エラー画面」「完了画面」「確認画面」「入力画面」が含まれています。</li>
				<li>テンプレート「<a href="{$app.form_file}" target="_blank">{$app.form_file}</a>」をWEB作成ソフトで編集する事も可能です。</li>
				<li><a href="javascript:void(0);" onclick="toggle('option');return false;" onkeypress="return;" title="開閉します">ヒント↓</a></li>
			</ul>
			<dl id="option" style="display: none;">
{if $app.is_mobile}
				<dt>注意点</dt>
					<dd>
						ファイル送信フォームが含まれている場合は、&lt;form&gt;要素にenctype=&quot;multipart/form-data&quot;を追加して下さい。<br />
						主にSoftBank端末でファイル送信を行える様になりますが、AU端末で確認画面が文字化けする可能性があります。<br />
					</dd>
				<dt>メールアドレスのリンク</dt>
					<dd>
						<input value="&lt;p&gt;&lt;a href=&quot;mailto:{$app.mailto}&quot;&gt;携帯からﾒｰﾙする&lt;/a&gt;&lt;/p&gt;" size="100" onclick="this.select();" />
					</dd>
				<dt>QRコード</dt>
					<dd><a href="http://qr.quel.jp/" target="_blank">QRのススメ</a>にてQRコードを作成できます。</dd>
{else}
				<dt>メールアドレスのリンク</dt>
					<dd>
						巡回クローラに拾われにくい形でメールアドレスをリンクしておく事ができます。<br />
						<input value="&lt;p&gt;&lt;a href=&quot;javascript:void(0);&quot; onclick=&quot;mailer(&#039;&lt;?=obfuscate(&#039;{$app.mailto}&#039;)?&gt;&#039;);&quot;&gt;メールソフトで送信する&lt;/a&gt;&lt;/p&gt;" size="100" onclick="this.select();" />
					</dd>
				<dt>フォームの横にリンクしておくと便利になるサイト</dt>
					<dd>
						<input value="&lt;a href=&quot;http://www.post.japanpost.jp/zipcode/&quot; target=&quot;_blank&quot;&gt;郵便番号検索&lt;/a&gt;" size="50" onclick="this.select();" />
						<a href="http://www.post.japanpost.jp/zipcode/" target="_blank">郵便番号検索</a>
						<br />
						<input value="&lt;a href=&quot;http://www.d-dj.com/menu/4/hayami_age.php&quot; target=&quot;_blank&quot;&gt;干支年齢早見表&lt;/a&gt;" size="50" onclick="this.select();" />
						<a href="http://www.d-dj.com/menu/4/hayami_age.php" target="_blank">干支年齢早見表</a>
						<br />
						<input value="&lt;a href=&quot;http://www.cpn.ne.jp/how/nendo.html&quot; target=&quot;_blank&quot;&gt;卒業年度早見表&lt;/a&gt;" size="50" onclick="this.select();" />
						<a href="http://www.cpn.ne.jp/how/nendo.html" target="_blank">卒業年度早見表</a>
						<br />
						<input value="&lt;a href=&quot;http://resume.meieki.com/&quot; target=&quot;_blank&quot;&gt;履歴書メーカー&lt;/a&gt;" size="50" onclick="this.select();" />
						<a href="http://resume.meieki.com/" target="_blank">履歴書メーカー</a>（履歴書ファイルアップロード用）
					</dd>
{/if}
			</dl>
{include file='_error.html'}
			<dl>
				<dt>ソース</dt>
					<dd><textarea id="source" name="source" cols="90" rows="20" class="wide" wrap="off" style="ime-mode: inactive;">{$app.source}</textarea></dd>
			</dl>
			<p>
				<input type="button" value="前へ戻る" class="button" onclick="location.href='{$script}?mode=project_tmpl_publish&amp;id={$app.id}&amp;index={$app.index}';return false;" onkeypress="return;" />
				<input type="submit" value="保存する" class="button" />
			</p>
		</fieldset>
	</form>
</div>

<!--
<div id="preview">
	<iframe src="{$app.form_file}" width="100%" height="400px" scrolling="yes">
		この部分は iframe 対応のブラウザで見て下さい。
	</iframe>
</div>
-->

{include file='_footer.html'}
