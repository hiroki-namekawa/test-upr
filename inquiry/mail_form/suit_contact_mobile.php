<? $id=2;require_once 'app/postman.php'; ?>
<<?='?'?>xml version="1.0" encoding="utf-8"<?='?'?>>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-style-type" content="text/css" />
	<meta http-equiv="cache-control" content="no-cache" />
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />
	<title>ﾊﾟﾜｰｱｼｽﾄｽｰﾂお問い合わせﾌｫｰﾑ</title>
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
	<h2>ﾊﾟﾜｰｱｼｽﾄｽｰﾂお問い合わせﾌｫｰﾑ [ｴﾗｰ]</h2>
	<p><a href="/">ﾎｰﾑﾍﾟｰｼﾞへ戻る</a></p>
	<ul class="error">
		<li><?=$ERROR?>｡</li>
	</ul>
	<form action="./suit_contact_mobile.php" method="post">
		<p><input type="submit" value="入力画面へ戻る" /></p>
	</form>
<? ELSEIF ($DONE) : ?>
	<h2>ﾊﾟﾜｰｱｼｽﾄｽｰﾂお問い合わせﾌｫｰﾑ [完了]</h2>
	<p><a href="/">ﾎｰﾑﾍﾟｰｼﾞへ</a></p>
	<ul>
		<li>ﾒｰﾙを送信しました｡</li>
		<li>返信されるまで､しばらくお待ち下さい｡</li>
		<li>1週間後の<?=mb_date(86400 * 7)?>になっても返信されない場合は届いていない可能性がありますので､再度送信して下さい｡</li>
	</ul>
<? ELSEIF ($CONFIRM) : ?>
	<h2>ﾊﾟﾜｰｱｼｽﾄｽｰﾂお問い合わせﾌｫｰﾑ [確認]</h2>
	<p><a href="/">ﾎｰﾑﾍﾟｰｼﾞへ</a></p>
<?/* confirm_part_m */?>
	<div>
		■御社名<em class="required">※</em><br />
		<?=$t0sb_c?> 
	</div>
	<hr />
	<div>
		■部署名<em class="required">※</em><br />
		<?=$t5vm_c?> 
	</div>
	<hr />
	<div>
		■ご氏名<em class="required">※</em><br />
		<?=$t5ym_c?> 
	</div>
	<hr />
	<div>
		■郵便番号<em class="required">※</em><br />
		<?=$t1ww_c?> 
	</div>
	<hr />
	<div>
		■都道府県<em class="required">※</em><br />
		<?=$s0vl_c?> 
	</div>
	<hr />
	<div>
		■市区町村・番地<em class="required">※</em><br />
		<?=$t2ls_c?> 
	</div>
	<hr />
	<div>
		■マンション・ビル名<br />
		<?=$t5kz_c?> 
	</div>
	<hr />
	<div>
		■電話番号<em class="required">※</em><br />
		<?=$t8qv_c?> 
	</div>
	<hr />
	<div>
		■メールアドレス<em class="required">※</em><br />
		<?=$t8pi_c?> 
	</div>
	<hr />
	<div>
		■お問い合わせ種別<em class="required">※</em><br />
		<?=$r5jr_c?> 
	</div>
	<hr />
	<div>
		■お問い合わせ商品<em class="required">※</em><br />
		<?=$c4bi_c?> 
	</div>
	<hr />
	<div>
		■お問い合わせ内容<em class="required">※</em><br />
		<?=$t2eh_c?> 
	</div>
	<hr />
	<div>
		■作業内容<br />
		<?=$t3kv_c?> 
	</div>
<?/* confirm_part_m */?>
	<form action="./suit_contact_mobile.php" method="post">
		<p>
			<?=$hidden?>
			<input type="submit" value="送信する" />
		</p>
	</form>
<? ELSE : ?>
	<h2>ﾊﾟﾜｰｱｼｽﾄｽｰﾂお問い合わせﾌｫｰﾑ</h2>
	<p><a href="/">ﾎｰﾑﾍﾟｰｼﾞへ</a></p>
	<form action="./suit_contact_mobile.php" method="post">
<?/* form_part_m */?>
		<div>
			■御社名<em class="required">※</em><br />
			<?error($vars, 't0sb')?>
			<input type="text" name="t0sb" size="14" value="<?=$t0sb_v?>" istyle="3" />
		</div>
		<hr />
		<div>
			■部署名<em class="required">※</em><br />
			<?error($vars, 't5vm')?>
			<input type="text" name="t5vm" size="14" value="<?=$t5vm_v?>" istyle="3" />
		</div>
		<hr />
		<div>
			■ご氏名<em class="required">※</em><br />
			<?error($vars, 't5ym')?>
			<input type="text" name="t5ym" size="14" value="<?=$t5ym_v?>" istyle="3" />
		</div>
		<hr />
		<div>
			■郵便番号<em class="required">※</em><br />
			<?error($vars, 't1ww')?>
			<input type="text" name="t1ww" size="14" value="<?=$t1ww_v?>" istyle="3" />
		</div>
		<hr />
		<div>
			■都道府県<em class="required">※</em><br />
			<?error($vars, 's0vl')?>
			<select name="s0vl">
		<option value=""<?=$s0vl0_v?>>選択して下さい</option>
		<option value="北海道"<?=$s0vl1_v?>>北海道</option>
		<option value="青森県"<?=$s0vl2_v?>>青森県</option>
		<option value="岩手県"<?=$s0vl3_v?>>岩手県</option>
		<option value="宮城県"<?=$s0vl4_v?>>宮城県</option>
		<option value="秋田県"<?=$s0vl5_v?>>秋田県</option>
		<option value="山形県"<?=$s0vl6_v?>>山形県</option>
		<option value="福島県"<?=$s0vl7_v?>>福島県</option>
		<option value="茨城県"<?=$s0vl8_v?>>茨城県</option>
		<option value="栃木県"<?=$s0vl9_v?>>栃木県</option>
		<option value="群馬県"<?=$s0vl10_v?>>群馬県</option>
		<option value="埼玉県"<?=$s0vl11_v?>>埼玉県</option>
		<option value="千葉県"<?=$s0vl12_v?>>千葉県</option>
		<option value="東京都"<?=$s0vl13_v?>>東京都</option>
		<option value="神奈川県"<?=$s0vl14_v?>>神奈川県</option>
		<option value="山梨県"<?=$s0vl15_v?>>山梨県</option>
		<option value="長野県"<?=$s0vl16_v?>>長野県</option>
		<option value="新潟県"<?=$s0vl17_v?>>新潟県</option>
		<option value="富山県"<?=$s0vl18_v?>>富山県</option>
		<option value="石川県"<?=$s0vl19_v?>>石川県</option>
		<option value="福井県"<?=$s0vl20_v?>>福井県</option>
		<option value="岐阜県"<?=$s0vl21_v?>>岐阜県</option>
		<option value="静岡県"<?=$s0vl22_v?>>静岡県</option>
		<option value="愛知県"<?=$s0vl23_v?>>愛知県</option>
		<option value="三重県"<?=$s0vl24_v?>>三重県</option>
		<option value="滋賀県"<?=$s0vl25_v?>>滋賀県</option>
		<option value="京都府"<?=$s0vl26_v?>>京都府</option>
		<option value="大阪府"<?=$s0vl27_v?>>大阪府</option>
		<option value="兵庫県"<?=$s0vl28_v?>>兵庫県</option>
		<option value="奈良県"<?=$s0vl29_v?>>奈良県</option>
		<option value="和歌山県"<?=$s0vl30_v?>>和歌山県</option>
		<option value="鳥取県"<?=$s0vl31_v?>>鳥取県</option>
		<option value="島根県"<?=$s0vl32_v?>>島根県</option>
		<option value="岡山県"<?=$s0vl33_v?>>岡山県</option>
		<option value="広島県"<?=$s0vl34_v?>>広島県</option>
		<option value="山口県"<?=$s0vl35_v?>>山口県</option>
		<option value="徳島県"<?=$s0vl36_v?>>徳島県</option>
		<option value="香川県"<?=$s0vl37_v?>>香川県</option>
		<option value="愛媛県"<?=$s0vl38_v?>>愛媛県</option>
		<option value="高知県"<?=$s0vl39_v?>>高知県</option>
		<option value="福岡県"<?=$s0vl40_v?>>福岡県</option>
		<option value="佐賀県"<?=$s0vl41_v?>>佐賀県</option>
		<option value="長崎県"<?=$s0vl42_v?>>長崎県</option>
		<option value="熊本県"<?=$s0vl43_v?>>熊本県</option>
		<option value="大分県"<?=$s0vl44_v?>>大分県</option>
		<option value="宮崎県"<?=$s0vl45_v?>>宮崎県</option>
		<option value="鹿児島県"<?=$s0vl46_v?>>鹿児島県</option>
		<option value="沖縄県"<?=$s0vl47_v?>>沖縄県</option>
		<option value="海外"<?=$s0vl48_v?>>海外</option>
</select>
		</div>
		<hr />
		<div>
			■市区町村・番地<em class="required">※</em><br />
			<?error($vars, 't2ls')?>
			<input type="text" name="t2ls" size="14" value="<?=$t2ls_v?>" istyle="3" />
		</div>
		<hr />
		<div>
			■マンション・ビル名<br />
			<?error($vars, 't5kz')?>
			<input type="text" name="t5kz" size="14" value="<?=$t5kz_v?>" istyle="3" />
		</div>
		<hr />
		<div>
			■電話番号<em class="required">※</em><br />
			<?error($vars, 't8qv')?>
			<input type="text" name="t8qv" size="14" value="<?=$t8qv_v?>" istyle="3" />
		</div>
		<hr />
		<div>
			■メールアドレス<em class="required">※</em><br />
			<?error($vars, 't8pi')?>
			<input type="text" name="t8pi" size="14" value="<?=$t8pi_v?>" istyle="3" /><br />
			<em class="example">例： info@example.com</em>
		</div>
		<hr />
		<div>
			■お問い合わせ種別<em class="required">※</em><br />
			<?error($vars, 'r5jr')?>
			<span class="radio">
		<input type="radio" name="r5jr" value="お問い合わせ"<?=$r5jr0_v?> />お問い合わせ
		<input type="radio" name="r5jr" value="デモ依頼"<?=$r5jr1_v?> />デモ依頼
		<input type="radio" name="r5jr" value="体験会来社希望"<?=$r5jr2_v?> />体験会来社希望
</span>
		</div>
		<hr />
		<div>
			■お問い合わせ商品<em class="required">※</em><br />
			<?error($vars, 'c4bi')?>
			<span class="checkbox">
		<input type="checkbox" name="c4bi[]" value="マッスルスーツ®"<?=$c4bi0_v?> />マッスルスーツ®
		<input type="checkbox" name="c4bi[]" value="アクティブパワースーツ®"<?=$c4bi1_v?> />アクティブパワースーツ®
</span>
		</div>
		<hr />
		<div>
			■お問い合わせ内容<em class="required">※</em><br />
			<?error($vars, 't2eh')?>
			<textarea name="t2eh" cols="14" rows="2" istyle="3"><?=$t2eh_v?></textarea>
		</div>
		<hr />
		<div>
			■作業内容<br />
			<?error($vars, 't3kv')?>
			<textarea name="t3kv" cols="14" rows="2" istyle="3"><?=$t3kv_v?></textarea>
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
