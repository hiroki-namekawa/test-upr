<form action="./" method="post">
<table class="form" summary="お問い合わせ内容">
<tr>
<th>対象記事</th>
<td><p class="target"><a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></p></td>
</tr>
<tr>
<th>
<img src="images/ico_required.gif" alt="必須" class="icnRequired" />
<label for="fld-company">会社名</label>
</th>
<td>
<?php if ( !empty ( $error_html['company'] ) ) echo $error_html['company']; ?>
<?php
	$arg = array (
		'type' => 'text',
		'name' => 'company',
		'size' => '50',
		'id' => 'fld-company',
		'required' => 1,
	);
	createField( $arg );
?>
</td>
</tr>
<tr>
<th>
<img src="images/ico_required.gif" alt="必須" class="icnRequired" />
<label for="fld-name">氏名</label>
</th>
<td>
<?php if ( !empty ( $error_html['name'] ) ) echo $error_html['name']; ?>
<?php
	$arg = array (
		'type' => 'text',
		'name' => 'name',
		'size' => '50',
		'id' => 'fld-name',
		'required' => 1,
	);
	createField( $arg );
?>
</td>
</tr>
<tr>
<th>
<img src="images/ico_required.gif" alt="必須" class="icnRequired" />
<label for="fld-kana">かな</label>
</th>
<td>
<?php if ( !empty ( $error_html['kana'] ) ) echo $error_html['kana']; ?>
<?php
	$arg = array (
		'type' => 'text',
		'name' => 'kana',
		'size' => '50',
		'id' => 'fld-kana',
		'required' => 1,
	);
	createField( $arg );
?>
</td>
</tr>
<tr>
<th>
<label for="fld-zip">住所</label>
</th>
<td>
<?php if ( !empty ( $error_html['g1'] ) ) echo $error_html['g1']; ?>
〒
<?php
	$arg = array (
		'type' => 'text',
		'name' => 'g1_zip',
		'size' => '50',
		'id' => 'fld-zip',
		'check' => 'zip',
	);
	createField( $arg );
?><br />
<?php
	$arg = array (
		'type' => 'select',
		'name' => 'g1_area',
		'id' => 'fld-area',
		'value' => 'area',
	);
	createField( $arg );
?><br />
<?php
	$arg = array (
		'type' => 'text',
		'name' => 'g1_address',
		'size' => '50',
		'id' => 'fld-address',
	);
	createField( $arg );
?>
</td>
</tr>
<tr>
<th>
<img src="images/ico_required.gif" alt="必須" class="icnRequired" />
<label for="fld-tel">電話番号</label>
</th>
<td>
<?php if ( !empty ( $error_html['tel'] ) ) echo $error_html['tel']; ?>
<?php
	$arg = array (
		'type' => 'text',
		'name' => 'tel',
		'size' => '50',
		'id' => 'fld-tel',
		'check' => 'tel',
		'required' => 1,
	);
	createField( $arg );
?>
</td>
</tr>
<tr>
<th>
<img src="images/ico_required.gif" alt="必須" class="icnRequired" />
<label for="fld-mail">メールアドレス</label>
</th>
<td>
<?php if ( !empty ( $error_html['mail'] ) ) echo $error_html['mail']; ?>
<?php
	$arg = array (
		'type' => 'text',
		'name' => 'mail',
		'size' => '50',
		'id' => 'fld-mail',
		'check' => 'mail',
		'required' => 1,
	);
	createField( $arg );
?>
</td>
</tr>
<tr>
<th>
<img src="images/ico_required.gif" alt="必須" class="icnRequired" />
<label for="fld-body">お問い合わせ内容</label>
</th>
<td>
<?php if ( !empty ( $error_html['body'] ) ) echo $error_html['body']; ?>
<?php
	$arg = array (
		'type' => 'textarea',
		'name' => 'body',
		'id' => 'fld-body',
		'check' => '-1000',
		'required' => 1,
		'option1' => 80, // cols
		'option2' => 20, // rows
	);
	createField( $arg );
?>
</td>
</tr>
</table>

<div id="submit">
<input type="image" src="/carsharing/lp/contact/images/btn_confirm.gif" alt="入力内容を確認する" class="btnConfirm" />
<!-- / id submit --></div>
<input type="hidden" name="mode" value="check" />
<input type="hidden" name="id" value="<?php echo $INPUT_id; ?>" />

</form>