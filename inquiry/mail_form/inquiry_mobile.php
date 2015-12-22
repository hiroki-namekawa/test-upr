<? $id=1;require_once 'app/postman.php'; ?>
<<?='?'?>xml version="1.0" encoding="utf-8"<?='?'?>>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-style-type" content="text/css" />
	<meta http-equiv="cache-control" content="no-cache" />
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />
	<title>お問い合わせﾌｫｰﾑ</title>
	<style type="text/css"><!--
		* {
			font-size: 9pt;
			font-style: normal;
		}
		*.group-name {
			display: block;
			font-weight: bold;
		}
		*.error {
			display: block;
		}
		*.error, *.required {
			color: #F60;
			background-color: inherit;
		}
	--></style>
</head>

<body>

<div>
<? IF ($ERROR) : ?>
	<h2>お問い合わせﾌｫｰﾑ [ｴﾗｰ]</h2>
	<p><a href="/">ﾎｰﾑﾍﾟｰｼﾞへ戻る</a></p>
	<ul class="error">
		<li><?=$ERROR?>｡</li>
	</ul>
	<form action="./inquiry_mobile.php" method="post">
		<p><input type="submit" value="入力画面へ戻る" /></p>
	</form>
<? ELSEIF ($DONE) : ?>
	<h2>お問い合わせﾌｫｰﾑ [完了]</h2>
	<p><a href="/">ﾎｰﾑﾍﾟｰｼﾞへ</a></p>
	<ul>
		<li>ﾒｰﾙを送信しました｡</li>
		<li>返信されるまで､しばらくお待ち下さい｡</li>
		<li>1週間後の<?=mb_date(86400 * 7)?>になっても返信されない場合は届いていない可能性がありますので､再度送信して下さい｡</li>
	</ul>
<? ELSEIF ($CONFIRM) : ?>
	<h2>お問い合わせﾌｫｰﾑ [確認]</h2>
	<p><a href="/">ﾎｰﾑﾍﾟｰｼﾞへ</a></p>
<?/* confirm_part_m */?>
	<div>
		■御社名<em class="required">※</em><br />
		<?=$t1ar_c?> 
	</div>
	<hr />
	<div>
		■部署名<em class="required">※</em><br />
		<?=$t1zo_c?> 
	</div>
	<hr />
	<div>
		■ご氏名<em class="required">※</em><br />
		<?=$t4di_c?> 
	</div>
	<hr />
	<div>
		■郵便番号<em class="required">※</em><br />
		<?=$t9kb_c?> 
	</div>
	<hr />
	<div>
		■都道府県<em class="required">※</em><br />
		<?=$s3cj_c?> 
	</div>
	<hr />
	<div>
		■市区町村・番地<em class="required">※</em><br />
		<?=$t5qk_c?> 
	</div>
	<hr />
	<div>
		■マンション・ビル名<em class="required">※</em><br />
		<?=$t4kf_c?> 
	</div>
	<hr />
	<div>
		■電話番号<em class="required">※</em><br />
		<?=$t9dx_c?> 
	</div>
	<hr />
	<div>
		■メールアドレス（半角）<em class="required">※</em><br />
		<?=$t6xa_c?> 
	</div>
	<hr />
	<div>
		■お問い合わせの種類<em class="required">※</em><br />
		<?=$c1wf_c?> 
	</div>
	<hr />
	<div>
		■お問い合わせ内容<em class="required">※</em><br />
		<?=$t3wr_c?> 
	</div>
<?/* confirm_part_m */?>
	<form action="./inquiry_mobile.php" method="post">
		<p>
			<?=$hidden?>
			<input type="submit" value="送信する" />
		</p>
	</form>
<? ELSE : ?>
	<h2>お問い合わせﾌｫｰﾑ</h2>
	<p><a href="/">ﾎｰﾑﾍﾟｰｼﾞへ</a></p>
	<form action="./inquiry_mobile.php" method="post">
<?/* form_part_m */?>
		<div>
			■御社名<em class="required">※</em><br />
			<?error($vars, 't1ar')?>
			<input type="text" name="t1ar" size="14" value="<?=$t1ar_v?>" istyle="3" />
		</div>
		<hr />
		<div>
			■部署名<em class="required">※</em><br />
			<?error($vars, 't1zo')?>
			<input type="text" name="t1zo" size="14" value="<?=$t1zo_v?>" istyle="3" />
		</div>
		<hr />
		<div>
			■ご氏名<em class="required">※</em><br />
			<?error($vars, 't4di')?>
			<input type="text" name="t4di" size="14" value="<?=$t4di_v?>" istyle="3" />
		</div>
		<hr />
		<div>
			■郵便番号<em class="required">※</em><br />
			<?error($vars, 't9kb')?>
			<input type="text" name="t9kb" size="14" value="<?=$t9kb_v?>" istyle="3" /><br />
			<em class="example">例： 000-1111</em>
		</div>
		<hr />
		<div>
			■都道府県<em class="required">※</em><br />
			<?error($vars, 's3cj')?>
			<select name="s3cj">
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
		<hr />
		<div>
			■市区町村・番地<em class="required">※</em><br />
			<?error($vars, 't5qk')?>
			<input type="text" name="t5qk" size="14" value="<?=$t5qk_v?>" istyle="3" />
		</div>
		<hr />
		<div>
			■マンション・ビル名<em class="required">※</em><br />
			<?error($vars, 't4kf')?>
			<input type="text" name="t4kf" size="14" value="<?=$t4kf_v?>" istyle="3" />
		</div>
		<hr />
		<div>
			■電話番号<em class="required">※</em><br />
			<?error($vars, 't9dx')?>
			<input type="text" name="t9dx" size="14" value="<?=$t9dx_v?>" istyle="3" /><br />
			<em class="example">例： 03-111-2222</em>
		</div>
		<hr />
		<div>
			■メールアドレス（半角）<em class="required">※</em><br />
			<?error($vars, 't6xa')?>
			<input type="text" name="t6xa" size="14" value="<?=$t6xa_v?>" istyle="3" /><br />
			<em class="example">このアドレスに控えメールを送信します。</em>
		</div>
		<hr />
		<div>
			■お問い合わせの種類<em class="required">※</em><br />
			<?error($vars, 'c1wf')?>
			<span class="checkbox">
		<input type="checkbox" name="c1wf[]" value="パレット及び物流機器のレンタル・販売"<?=$c1wf0_v?> />パレット及び物流機器のレンタル・販売
		<input type="checkbox" name="c1wf[]" value="なんでも追跡システム「なんつい」"<?=$c1wf1_v?> />なんでも追跡システム「なんつい」
		<input type="checkbox" name="c1wf[]" value="ワールドキーパー"<?=$c1wf2_v?> />ワールドキーパー
		<input type="checkbox" name="c1wf[]" value="遠隔監視制御システム「なんモニ」"<?=$c1wf3_v?> />遠隔監視制御システム「なんモニ」
		<input type="checkbox" name="c1wf[]" value="カーシェアリング"<?=$c1wf4_v?> />カーシェアリング
		<input type="checkbox" name="c1wf[]" value="パワーアシストスーツ"<?=$c1wf5_v?> />パワーアシストスーツ
		<input type="checkbox" name="c1wf[]" value="その他"<?=$c1wf6_v?> />その他
</span>
		</div>
		<hr />
		<div>
			■お問い合わせ内容<em class="required">※</em><br />
			<?error($vars, 't3wr')?>
			<textarea name="t3wr" cols="14" rows="2" istyle="3"><?=$t3wr_v?></textarea>
		</div>
<?/* form_part_m */?>
		<p>
			<input type="submit" value="確認画面へ" />
		</p>
	</form>
<? ENDIF; ?>
</div>

<?/* 改変禁止 */?>
<div>
	<address><a href="http://www.mt312.com/">ES-FORM</a></address>
</div>

</body>
</html>