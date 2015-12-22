<? $id=2;require_once 'app/postman.php'; ?>
<<?='?'?>xml version="1.0" encoding="utf-8"<?='?'?>>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja" dir="ltr">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-style-type" content="text/css" />
	<meta http-equiv="content-script-type" content="text/javascript" />
	<meta name="viewport" content="width=device-width" />
	<title>パワーアシストスーツお問い合わせフォーム</title>
	<link rel="stylesheet" type="text/css" href="app/common.css" media="all" />
	<script type="text/javascript" src="app/prototype.js"></script>
	<script type="text/javascript" src="app/common.js"></script>
    
        <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-25422367-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type =
'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' :
'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>

<body>

<div id="container">

<div id="contents">
<? IF ($ERROR) : ?>
	<h2>パワーアシストスーツお問い合わせフォーム [エラー]</h2>
	<p><a href="/">ホームページへ</a></p>
	<div class="box">
		<ul class="error">
			<li><?=$ERROR?>。</li>
		</ul>
		<p><a href="./suit_contact.php" onclick="history.go(-2);return false;" onkeypress="return;">入力画面へ戻る</a></p>
	</div>
<? ELSEIF ($DONE) : ?>
	<h2>パワーアシストスーツお問い合わせフォーム [完了]</h2>
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
	<h2>パワーアシストスーツお問い合わせフォーム [確認]</h2>
	<p><a href="/">ホームページへ</a></p>
	<p class="navi">1 入力画面<span>&raquo;</span><em>2 確認画面</em><span>&raquo;</span>3 完了画面</p>
	<table summary="確認内容">
<?/* confirm_part_p */?>
		<tr class="zebra0">
			<th>御社名<em class="required">※</em></th>
			<td>
				<div>
					<?=$t0sb_c?> 
				</div>
			</td>
		</tr>
		<tr class="zebra1">
			<th>部署名<em class="required">※</em></th>
			<td>
				<div>
					<?=$t5vm_c?> 
				</div>
			</td>
		</tr>
		<tr class="zebra0">
			<th>ご氏名<em class="required">※</em></th>
			<td>
				<div>
					<?=$t5ym_c?> 
				</div>
			</td>
		</tr>
		<tr class="zebra1">
			<th>郵便番号<em class="required">※</em></th>
			<td>
				<div>
					<?=$t1ww_c?> 
				</div>
			</td>
		</tr>
		<tr class="zebra0">
			<th>都道府県<em class="required">※</em></th>
			<td>
				<div>
					<?=$s0vl_c?> 
				</div>
			</td>
		</tr>
		<tr class="zebra1">
			<th>市区町村・番地<em class="required">※</em></th>
			<td>
				<div>
					<?=$t2ls_c?> 
				</div>
			</td>
		</tr>
		<tr class="zebra0">
			<th>マンション・ビル名</th>
			<td>
				<div>
					<?=$t5kz_c?> 
				</div>
			</td>
		</tr>
		<tr class="zebra1">
			<th>電話番号<em class="required">※</em></th>
			<td>
				<div>
					<?=$t8qv_c?> 
				</div>
			</td>
		</tr>
		<tr class="zebra0">
			<th>メールアドレス<em class="required">※</em></th>
			<td>
				<div>
					<?=$t8pi_c?> 
				</div>
			</td>
		</tr>
		<tr class="zebra1">
			<th>お問い合わせ種別<em class="required">※</em></th>
			<td>
				<div>
					<?=$r5jr_c?> 
				</div>
			</td>
		</tr>
		<tr class="zebra0">
			<th>お問い合わせ商品<em class="required">※</em></th>
			<td>
				<div>
					<?=$c4bi_c?> 
				</div>
			</td>
		</tr>
		<tr class="zebra1">
			<th>お問い合わせ内容<em class="required">※</em></th>
			<td>
				<div>
					<?=$t2eh_c?> 
				</div>
			</td>
		</tr>
		<tr class="zebra0">
			<th>作業内容</th>
			<td>
				<div>
					<?=$t3kv_c?> 
				</div>
			</td>
		</tr>
<?/* confirm_part_p */?>
	</table>
	<form action="./suit_contact.php" method="post">
		<fieldset>
			<legend>パワーアシストスーツお問い合わせフォーム</legend>
			<?=$hidden?>
			<p class="button">
				<input type="button" value="やり直す" class="button cancel" onclick="history.back();return false;" onkeypress="return;" />
				<input type="submit" value="内容を送信する" class="button submit" />
			</p>
		</fieldset>
	</form>
<? ELSE : ?>
	<h2>パワーアシストスーツお問い合わせフォーム</h2>
	<p><a href="/">ホームページへ</a></p>
	<p class="navi"><em>1 入力画面</em><span>&raquo;</span>2 確認画面<span>&raquo;</span>3 完了画面</p>
	<form action="./suit_contact.php" method="post" enctype="multipart/form-data" accept-charset="utf-8" id="inputform">
		<fieldset>
			<legend>パワーアシストスーツお問い合わせフォーム</legend>
			<table summary="入力フォーム">
<?/* form_part_p */?>
				<tr class="zebra0">
					<th>御社名<em class="required">※</em></th>
					<td>
						<div>
							<?error($vars, 't0sb')?>
							<input type="text" id="t0sb" name="t0sb" size="50" value="<?=$t0sb_v?>" style="ime-mode: auto;" />
						</div>
					</td>
				</tr>
				<tr class="zebra1">
					<th>部署名<em class="required">※</em></th>
					<td>
						<div>
							<?error($vars, 't5vm')?>
							<input type="text" id="t5vm" name="t5vm" size="50" value="<?=$t5vm_v?>" style="ime-mode: auto;" />
						</div>
					</td>
				</tr>
				<tr class="zebra0">
					<th>ご氏名<em class="required">※</em></th>
					<td>
						<div>
							<?error($vars, 't5ym')?>
							<input type="text" id="t5ym" name="t5ym" size="50" value="<?=$t5ym_v?>" style="ime-mode: auto;" />
						</div>
					</td>
				</tr>
				<tr class="zebra1">
					<th>郵便番号<em class="required">※</em></th>
					<td>
						<div>
							<?error($vars, 't1ww')?>
							<input type="text" id="t1ww" name="t1ww" size="12" value="<?=$t1ww_v?>" style="ime-mode: auto;" />
						</div>
					</td>
				</tr>
				<tr class="zebra0">
					<th>都道府県<em class="required">※</em></th>
					<td>
						<div>
							<?error($vars, 's0vl')?>
							<select id="s0vl" name="s0vl">
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
					</td>
				</tr>
				<tr class="zebra1">
					<th>市区町村・番地<em class="required">※</em></th>
					<td>
						<div>
							<?error($vars, 't2ls')?>
							<input type="text" id="t2ls" name="t2ls" size="50" value="<?=$t2ls_v?>" style="ime-mode: auto;" />
						</div>
					</td>
				</tr>
				<tr class="zebra0">
					<th>マンション・ビル名</th>
					<td>
						<div>
							<?error($vars, 't5kz')?>
							<input type="text" id="t5kz" name="t5kz" size="50" value="<?=$t5kz_v?>" style="ime-mode: auto;" />
						</div>
					</td>
				</tr>
				<tr class="zebra1">
					<th>電話番号<em class="required">※</em></th>
					<td>
						<div>
							<?error($vars, 't8qv')?>
							<input type="text" id="t8qv" name="t8qv" size="50" value="<?=$t8qv_v?>" style="ime-mode: auto;" />
						</div>
					</td>
				</tr>
				<tr class="zebra0">
					<th>メールアドレス<em class="required">※</em></th>
					<td>
						<div>
							<?error($vars, 't8pi')?>
							<input type="text" id="t8pi" name="t8pi" size="50" value="<?=$t8pi_v?>" style="ime-mode: auto;" /><br />
							<em class="example">例： info@example.com</em>
						</div>
					</td>
				</tr>
				<tr class="zebra1">
					<th>お問い合わせ種別<em class="required">※</em></th>
					<td>
						<div>
							<?error($vars, 'r5jr')?>
							<span id="r5jr" class="radio">
		<label for="r5jr0"><input type="radio" id="r5jr0" name="r5jr" value="お問い合わせ"<?=$r5jr0_v?> />お問い合わせ</label>
		<label for="r5jr1"><input type="radio" id="r5jr1" name="r5jr" value="デモ依頼"<?=$r5jr1_v?> />デモ依頼</label>
		<label for="r5jr2"><input type="radio" id="r5jr2" name="r5jr" value="体験会来社希望"<?=$r5jr2_v?> />体験会来社希望</label>
</span>
						</div>
					</td>
				</tr>
				<tr class="zebra0">
					<th>お問い合わせ商品<em class="required">※</em></th>
					<td>
						<div>
							<?error($vars, 'c4bi')?>
							<span id="c4bi" class="checkbox">
		<label for="c4bi0"><input type="checkbox" id="c4bi0" name="c4bi[]" value="マッスルスーツ®"<?=$c4bi0_v?> />マッスルスーツ®</label>
		<label for="c4bi1"><input type="checkbox" id="c4bi1" name="c4bi[]" value="アクティブパワースーツ®"<?=$c4bi1_v?> />アクティブパワースーツ®</label>
</span>
						</div>
					</td>
				</tr>
				<tr class="zebra1">
					<th>お問い合わせ内容<em class="required">※</em></th>
					<td>
						<div>
							<?error($vars, 't2eh')?>
							<textarea id="t2eh" name="t2eh" cols="50" rows="5" style="ime-mode: auto;"><?=$t2eh_v?></textarea>
						</div>
					</td>
				</tr>
				<tr class="zebra0">
					<th>作業内容</th>
					<td>
						<div>
							<?error($vars, 't3kv')?>
							<textarea id="t3kv" name="t3kv" cols="50" rows="5" style="ime-mode: auto;"><?=$t3kv_v?></textarea>
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

<script type="text/javascript">var s_cid="UPR_11233524";</script> 
<script type="text/javascript" src="http://v4.dbfocus.jp/script/as3.js"></script>

<!-- Google Code for &#12362;&#21839;&#21512;&#12431;&#12379; Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 971149673;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "3eshCLWO814Q6aKKzwM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/971149673/?label=3eshCLWO814Q6aKKzwM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<!-- Yahoo Code for your Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var yahoo_conversion_id = 1000119599;
var yahoo_conversion_label = "f2hWCM-Z814Q8-epzQM";
var yahoo_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="https://s.yimg.jp/images/listing/tool/cv/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="https://b91.yahoo.co.jp/pagead/conversion/1000119599/?value=0&amp;label=f2hWCM-Z814Q8-epzQM&amp;guid=ON&amp;script=0&amp;disvt=true"/>
</div>
</noscript>

</body>
</html>
