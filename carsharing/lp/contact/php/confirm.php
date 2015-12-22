<table class="table_01" summary="お問い合わせ内容">
<tr>
<th>対象記事</th>
<td><a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></td>
</tr>
<tr>
<th>会社名</th>
<td><?php if ( !empty ( $_POST['company'] ) ) echo $_POST['company']; ?></td>
</tr>
<tr>
<th>氏名</th>
<td><?php if ( !empty ( $_POST['name'] ) ) echo $_POST['name']; ?></td>
</tr>
<tr>
<th>かな</th>
<td><?php if ( !empty ( $_POST['kana'] ) ) echo $_POST['kana']; ?></td>
</tr>
<tr>
<th>住所</th>
<td><?php
	if ( !empty ( $_POST['g1_zip'] ) ) echo '〒' . $_POST['g1_zip'] . ' ';
	if ( !empty ( $_POST['g1_area'] ) ) echo $_POST['g1_area'];
	if ( !empty ( $_POST['g1_address'] ) ) echo $_POST['g1_address'];
?></td>
</tr>
<tr>
<th>電話番号</th>
<td><?php if ( !empty ( $_POST['tel'] ) ) echo $_POST['tel']; ?></td>
</tr>
<tr>
<th>メールアドレス</th>
<td><?php if ( !empty ( $_POST['mail'] ) ) echo $_POST['mail']; ?></td>
</tr>
<tr>
<th>お問い合わせ内容</th>
<td><?php if ( !empty ( $_POST['body'] ) ) echo $_POST['body']; ?></td>
</tr>
</table>

<div id="submit">
<form action="./" method="post" class="left">
<input type="image" src="/carsharing/lp/contact/images/btn_back.gif" alt="戻る" class="btnBack" />
<?php echo $hidden ?>
</form>

<form action="./" method="post" class="right">
<input type="image" src="/carsharing/lp/contact/images/btn_send.gif" alt="送信" class="btnSend" />
<input type="hidden" name="mode" value="send" />
<?php echo $hidden ?>
</form>
<!-- / id submit --></div>