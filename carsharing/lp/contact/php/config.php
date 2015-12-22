<?php
	// 送信者名
	define ( 'ADMIN_NAME', 'ユーピーアール' );
	
	// メールアドレス
	define ( 'ADMIN_MAIL', 'cs-info@upr-net.co.jp' );
	
	// フィールド
	$field_name_arr = array ( 
		'company' => array ( '会社名' ),
		'name' => array ( '氏名' ),
		'kana' => array ( 'かな' ),
		'g1' => array (
			'住所',
			array (
				'g1_zip' => array ( '', '〒', ' ' ),
				'g1_area' => array ( '', '', '' ),
				'g1_address' => array ( '', '', '' ),
			)
		),
		'tel' => array ( '電話番号' ),
		'mail' => array ( 'メールアドレス' ),
		'body' => array ( 'お問い合わせ内容' ),
	);
?>