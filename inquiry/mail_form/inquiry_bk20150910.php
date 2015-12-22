<? $id=1;require_once 'app/postman.php'; ?>
<<?='?'?>xml version="1.0" encoding="utf-8"<?='?'?>>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja" dir="ltr">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-style-type" content="text/css" />
	<meta http-equiv="content-script-type" content="text/javascript" />
	<meta name="viewport" content="width=device-width" />
	<title>お問い合わせフォーム</title>
	<link rel="stylesheet" type="text/css" href="app/common.css" media="all" />
	<script type="text/javascript" src="app/prototype.js"></script>
	<script type="text/javascript" src="app/common.js"></script>
</head>

<body>

<div id="container">

<div id="contents">
<? IF ($ERROR) : ?>
	<h2>お問い合わせフォーム [エラー]</h2>
	<p><a href="/">ホームページへ</a></p>
	<div class="box">
		<ul class="error">
			<li><?=$ERROR?>。</li>
		</ul>
		<p><a href="./inquiry.php" onclick="history.go(-2);return false;" onkeypress="return;">入力画面へ戻る</a></p>
	</div>
<? ELSEIF ($DONE) : ?>
	<h2>お問い合わせフォーム [完了]</h2>
	<p><a href="/">ホームページへ戻る</a></p>
	<p class="navi">1 入力画面<span>&raquo;</span>2 確認画面<span>&raquo;</span><em>3 完了画面</em></p>
	<div class="box">
		<ul>
			<li>メールを送信しました。</li>
			<li>返信されるまで、しばらくお待ち下さい。</li>
			<li>1週間後の<?=mb_date(86400 * 7)?>になっても返信されない場合は届いていない可能性がありますので、再度送信して下さい。</li>
		</ul>
	</div>
<? ELSEIF ($CONFIRM) : ?>
	<h2>お問い合わせフォーム [確認]</h2>
	<p><a href="/">ホームページへ</a></p>
	<p class="navi">1 入力画面<span>&raquo;</span><em>2 確認画面</em><span>&raquo;</span>3 完了画面</p>
	<table summary="確認内容">
<?/* confirm_part_p */?>
		<tr class="zebra0">
			<th>御社名<em class="required">※</em></th>
			<td>
				<div>
					<?=$t1ar_c?> 
				</div>
			</td>
		</tr>
		<tr class="zebra1">
			<th>部署名<em class="required">※</em></th>
			<td>
				<div>
					<?=$t1zo_c?> 
				</div>
			</td>
		</tr>
		<tr class="zebra0">
			<th>ご氏名<em class="required">※</em></th>
			<td>
				<div>
					<?=$t4di_c?> 
				</div>
			</td>
		</tr>
		<tr class="zebra1">
			<th>郵便番号<em class="required">※</em></th>
			<td>
				<div>
					<?=$t9kb_c?> 
				</div>
			</td>
		</tr>
		<tr class="zebra0">
			<th>都道府県<em class="required">※</em></th>
			<td>
				<div>
					<?=$s3cj_c?> 
				</div>
			</td>
		</tr>
		<tr class="zebra1">
			<th>市区町村・番地<em class="required">※</em></th>
			<td>
				<div>
					<?=$t5qk_c?> 
				</div>
			</td>
		</tr>
		<tr class="zebra0">
			<th>マンション・ビル名<em class="required">※</em></th>
			<td>
				<div>
					<?=$t4kf_c?> 
				</div>
			</td>
		</tr>
		<tr class="zebra1">
			<th>電話番号<em class="required">※</em></th>
			<td>
				<div>
					<?=$t9dx_c?> 
				</div>
			</td>
		</tr>
		<tr class="zebra0">
			<th>メールアドレス（半角）<em class="required">※</em></th>
			<td>
				<div>
					<?=$t6xa_c?> 
				</div>
			</td>
		</tr>
		<tr class="zebra1">
			<th>お問い合わせの種類<em class="required">※</em></th>
			<td>
				<div>
					<?=$c1wf_c?> 
				</div>
			</td>
		</tr>
		<tr class="zebra0">
			<th>お問い合わせ内容<em class="required">※</em></th>
			<td>
				<div>
					<?=$t3wr_c?> 
				</div>
			</td>
		</tr>
<?/* confirm_part_p */?>
	</table>
	<form action="./inquiry.php" method="post">
		<fieldset>
			<legend>お問い合わせフォーム</legend>
			<?=$hidden?>
			<p class="button">
				<input type="button" value="やり直す" class="button cancel" onclick="history.back();return false;" onkeypress="return;" />
				<input type="submit" value="内容を送信する" class="button submit" />
			</p>
		</fieldset>
	</form>
<? ELSE : ?>
	<h2>お問い合わせフォーム</h2>
	<p><a href="/">ホームページへ</a></p>
	<p class="navi"><em>1 入力画面</em><span>&raquo;</span>2 確認画面<span>&raquo;</span>3 完了画面</p>
	<form action="./inquiry.php" method="post" enctype="multipart/form-data" accept-charset="utf-8" id="inputform">
		<fieldset>
			<legend>お問い合わせフォーム</legend>
			<table summary="入力フォーム">
<?/* form_part_p */?>
				<tr class="zebra0">
					<th>御社名<em class="required">※</em></th>
					<td>
						<div>
							<?error($vars, 't1ar')?>
							<input type="text" id="t1ar" name="t1ar" size="50" value="<?=$t1ar_v?>" style="ime-mode: auto;" />
						</div>
					</td>
				</tr>
				<tr class="zebra1">
					<th>部署名<em class="required">※</em></th>
					<td>
						<div>
							<?error($vars, 't1zo')?>
							<input type="text" id="t1zo" name="t1zo" size="50" value="<?=$t1zo_v?>" style="ime-mode: auto;" />
						</div>
					</td>
				</tr>
				<tr class="zebra0">
					<th>ご氏名<em class="required">※</em></th>
					<td>
						<div>
							<?error($vars, 't4di')?>
							<input type="text" id="t4di" name="t4di" size="50" value="<?=$t4di_v?>" style="ime-mode: auto;" />
						</div>
					</td>
				</tr>
				<tr class="zebra1">
					<th>郵便番号<em class="required">※</em></th>
					<td>
						<div>
							<?error($vars, 't9kb')?>
							<input type="text" id="t9kb" name="t9kb" size="50" value="<?=$t9kb_v?>" style="ime-mode: auto;" /><br />
							<em class="example">例： 000-1111</em>
						</div>
					</td>
				</tr>
				<tr class="zebra0">
					<th>都道府県<em class="required">※</em></th>
					<td>
						<div>
							<?error($vars, 's3cj')?>
							<select id="s3cj" name="s3cj">
		<option value=""<?=$s3cj0_v?>>選択して下さい</option>
		<option value="北海道"<?=$s3cj1_v?>>北海道</option>
		<option value="青森県"<?=$s3cj2_v?>>青森県</option>
		<option value="岩手県"<?=$s3cj3_v?>>岩手県</option>
		<option value="宮城県"<?=$s3cj4_v?>>宮城県</option>
		<option value="秋田県"<?=$s3cj5_v?>>秋田県</option>
		<option value="山形県"<?=$s3cj6_v?>>山形県</option>
		<option value="福島県"<?=$s3cj7_v?>>福島県</option>
		<option value="茨城県"<?=$s3cj8_v?>>茨城県</option>
		<option value="栃木県"<?=$s3cj9_v?>>栃木県</option>
		<option value="群馬県"<?=$s3cj10_v?>>群馬県</option>
		<option value="埼玉県"<?=$s3cj11_v?>>埼玉県</option>
		<option value="千葉県"<?=$s3cj12_v?>>千葉県</option>
		<option value="東京都"<?=$s3cj13_v?>>東京都</option>
		<option value="神奈川県"<?=$s3cj14_v?>>神奈川県</option>
		<option value="山梨県"<?=$s3cj15_v?>>山梨県</option>
		<option value="長野県"<?=$s3cj16_v?>>長野県</option>
		<option value="新潟県"<?=$s3cj17_v?>>新潟県</option>
		<option value="富山県"<?=$s3cj18_v?>>富山県</option>
		<option value="石川県"<?=$s3cj19_v?>>石川県</option>
		<option value="福井県"<?=$s3cj20_v?>>福井県</option>
		<option value="岐阜県"<?=$s3cj21_v?>>岐阜県</option>
		<option value="静岡県"<?=$s3cj22_v?>>静岡県</option>
		<option value="愛知県"<?=$s3cj23_v?>>愛知県</option>
		<option value="三重県"<?=$s3cj24_v?>>三重県</option>
		<option value="滋賀県"<?=$s3cj25_v?>>滋賀県</option>
		<option value="京都府"<?=$s3cj26_v?>>京都府</option>
		<option value="大阪府"<?=$s3cj27_v?>>大阪府</option>
		<option value="兵庫県"<?=$s3cj28_v?>>兵庫県</option>
		<option value="奈良県"<?=$s3cj29_v?>>奈良県</option>
		<option value="和歌山県"<?=$s3cj30_v?>>和歌山県</option>
		<option value="鳥取県"<?=$s3cj31_v?>>鳥取県</option>
		<option value="島根県"<?=$s3cj32_v?>>島根県</option>
		<option value="岡山県"<?=$s3cj33_v?>>岡山県</option>
		<option value="広島県"<?=$s3cj34_v?>>広島県</option>
		<option value="山口県"<?=$s3cj35_v?>>山口県</option>
		<option value="徳島県"<?=$s3cj36_v?>>徳島県</option>
		<option value="香川県"<?=$s3cj37_v?>>香川県</option>
		<option value="愛媛県"<?=$s3cj38_v?>>愛媛県</option>
		<option value="高知県"<?=$s3cj39_v?>>高知県</option>
		<option value="福岡県"<?=$s3cj40_v?>>福岡県</option>
		<option value="佐賀県"<?=$s3cj41_v?>>佐賀県</option>
		<option value="長崎県"<?=$s3cj42_v?>>長崎県</option>
		<option value="熊本県"<?=$s3cj43_v?>>熊本県</option>
		<option value="大分県"<?=$s3cj44_v?>>大分県</option>
		<option value="宮崎県"<?=$s3cj45_v?>>宮崎県</option>
		<option value="鹿児島県"<?=$s3cj46_v?>>鹿児島県</option>
		<option value="沖縄県"<?=$s3cj47_v?>>沖縄県</option>
		<option value="海外"<?=$s3cj48_v?>>海外</option>
</select>
						</div>
					</td>
				</tr>
				<tr class="zebra1">
					<th>市区町村・番地<em class="required">※</em></th>
					<td>
						<div>
							<?error($vars, 't5qk')?>
							<input type="text" id="t5qk" name="t5qk" size="75" value="<?=$t5qk_v?>" style="ime-mode: auto;" />
						</div>
					</td>
				</tr>
				<tr class="zebra0">
					<th>マンション・ビル名<em class="required">※</em></th>
					<td>
						<div>
							<?error($vars, 't4kf')?>
							<input type="text" id="t4kf" name="t4kf" size="75" value="<?=$t4kf_v?>" style="ime-mode: auto;" />
						</div>
					</td>
				</tr>
				<tr class="zebra1">
					<th>電話番号<em class="required">※</em></th>
					<td>
						<div>
							<?error($vars, 't9dx')?>
							<input type="text" id="t9dx" name="t9dx" size="50" value="<?=$t9dx_v?>" style="ime-mode: auto;" /><br />
							<em class="example">例： 03-111-2222</em>
						</div>
					</td>
				</tr>
				<tr class="zebra0">
					<th>メールアドレス（半角）<em class="required">※</em></th>
					<td>
						<div>
							<?error($vars, 't6xa')?>
							<input type="text" id="t6xa" name="t6xa" size="50" value="<?=$t6xa_v?>" style="ime-mode: auto;" /><br />
							<em class="example">例： info@example.com</em>
						</div>
					</td>
				</tr>
				<tr class="zebra1">
					<th>お問い合わせの種類<em class="required">※</em></th>
					<td>
						<div>
							<?error($vars, 'c1wf')?>
							<span id="c1wf" class="checkbox">
		<label for="c1wf1"><input type="checkbox" id="c1wf1" name="c1wf[]" value="パレット及び物流機器のレンタル・販売"<?=$c1wf1_v?> />パレット及び物流機器のレンタル・販売</label>
		<label for="c1wf2"><input type="checkbox" id="c1wf2" name="c1wf[]" value="なんでも追跡システム「なんつい」"<?=$c1wf2_v?> />なんでも追跡システム「なんつい」</label>
		<label for="c1wf3"><input type="checkbox" id="c1wf3" name="c1wf[]" value="ワールドキーパー"<?=$c1wf3_v?> />ワールドキーパー</label><br />
		<label for="c1wf4"><input type="checkbox" id="c1wf4" name="c1wf[]" value="遠隔監視制御システム「なんモニ」"<?=$c1wf4_v?> />遠隔監視制御システム「なんモニ」</label>
		<label for="c1wf5"><input type="checkbox" id="c1wf5" name="c1wf[]" value="カーシェアリング"<?=$c1wf5_v?> />カーシェアリング</label>
		<label for="c1wf6"><input type="checkbox" id="c1wf6" name="c1wf[]" value="その他"<?=$c1wf6_v?> />その他</label>
</span>
						</div>
					</td>
				</tr>
				<tr class="zebra0">
					<th>お問い合わせ内容<em class="required">※</em></th>
					<td>
						<div>
							<?error($vars, 't3wr')?>
							<textarea id="t3wr" name="t3wr" cols="75" rows="5" style="ime-mode: auto;"><?=$t3wr_v?></textarea>
						</div>
					</td>
				</tr>
<?/* form_part_p */?>
			</table>
			<p class="button">
				<input type="reset" value="やり直す" class="button cancel" />
				<input type="submit" value="確認画面へ" class="button submit" />
			</p>
		</fieldset>
	</form>
	<p class="scrltop"><a href="#">↑先頭へ</a></p>
<? ENDIF; ?>
</div>

<?/* 改変禁止 */?>
<div id="copyright">
	<address><a href="http://www.mt312.com/">ES-FORM</a></address>
</div>

</div>

</body>
</html>