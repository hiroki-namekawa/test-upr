<?php
	/**
	 * キャッシュの設定と開始
	 */
	session_cache_limiter ( 'private, must-revalidate' );
	session_start ();
	
	/**
	 * 外部ファイルの読み込み
	 */
	include ( '../wp-load.php' );
	include ( 'php/config.php' );
	include ( 'php/function.php' );
	
	$title = 'お問い合わせ';
	//$description = '';
	//$keword = '';
	
	$css = '<link href="/carsharing/lp/contact/css/contact.css" rel="stylesheet" type="text/css" media="screen,print" />';
	//$js = '';
	
	get_header();
	
	if ( $INPUT_id )
	{
		$args = array(
			'page_id' => $INPUT_id,
		);
		query_posts( $args );
		
		if ( have_posts() )
		{
			the_post();
			
			if ( post_custom( 'pdf' ) )
			{
				$file_arr = get_imagefield( 'pdf' );
				$pdf_url = $file_arr['url'];
			}
			
			$permalink = get_permalink( $post->ID );
		}
		wp_reset_query();
	}
?>

<?php
	/**
	 * 入力チェック
	 */
	$flag_check = false;
	if ( !empty ( $INPUT_mode ) && $INPUT_mode == 'check' )
	{
		// データの整形
		$_POST = fix_data( $_POST );
		
		// 必須項目のチェック
		include ( 'php/check.php' );
		
		// 入力エラー処理
		list ( $error_html, $error_css ) = input_error( $error_blank, $error_injustice );
		
		if ( !$error_html && !$error_css )
		{
			$flag_check = true;
		}
		
		if ( $flag_check )
		{
			// チケット発行
			if ( empty ( $_SESSION['ticket'] ) ) $_SESSION['ticket'] = md5 ( uniqid ().mt_rand () );
			
			// 不可視フィールドを生成
			$hidden = hidden_field();
			
			// URLは自動リンク
			$_POST = auto_link( $_POST, array ( 'body' ) );
			
			include ( 'php/confirm.php' );
		}
	}
?>

<?php
	/**
	 * 送信
	 */
	if ( !empty ( $INPUT_mode ) && $INPUT_mode == 'send' )
	{
		$flag_check = true;
		
		if ( $_SESSION['ticket'] )
		{
			// タグを除去
			$_POST = remove_tags( $_POST );
			
			// 日付
			$_POST['date'] = date ( 'Y-m-d H:i:s' );
			
			// 対象記事
			$_POST['target'] = get_the_title();
			
			// メール本文作成
			function mail_contents( $post, $val )
			{
				$result = '';
				
				if ( !empty ( $post ) )
				{
					if ( is_array ( $post ) )
					{
						foreach ( $post as $val )
						{
							$result .= $val . '、';
						}
						$result = rtrim ( $result, '、' );
						if ( !empty ( $val[1] ) ) $result .= $val[1];
						if ( !empty ( $val[2] ) ) $result .= $val[2];
					}
					else
					{
						if ( !empty ( $val[1] ) ) $result .= $val[1];
						$result .= $post;
						if ( !empty ( $val[2] ) ) $result .= $val[2];
					}
				}
				
				return $result;
			}
			
			$mail_contents = '';
			foreach ( $field_name_arr as $key => $value )
			{
				if ( preg_match ( '/^g[0-9]+$/', $key ) )
				{
					// グループの場合
					$mail_contents .= "\n\n";
					$mail_contents .= "【" . $value[0] . "】\n";
					
					foreach ( $value[1] as $k => $val )
					{
						$mail_contents .= mail_contents( $_POST[$k], $val );
					}
				}
				else
				{
					$mail_contents .= "\n\n";
					$mail_contents .= "【" . $value[0] . "】\n";
					$mail_contents .= mail_contents( $_POST[$key], $value );
				}
			}
			
			/** ユーザー宛て */
			// 送信者
			$from_name = ADMIN_NAME;
			$from_mail = ADMIN_MAIL;
			
			// 宛先
			$to_name = $_POST['name'];
			$to_mail = $_POST['mail'];
			
			// 件名
			$subject = 'お問い合せありがとうございます。';
			
			// 本文
			$body = <<<_EOT_
{$mail_contents}

【添付資料】
{$pdf_url}
_EOT_;

			send_mail( $from_name, $from_mail, $to_name, $to_mail, $subject, $body );
			
			/** 管理者宛て */
			// 送信者
			$from_name = $_POST['name'];
			$from_mail = $_POST['mail'];
			
			// 宛先
			$to_name = ADMIN_NAME;
			$to_mail = ADMIN_MAIL;
			
			// 件名
			$subject = 'Webサイトよりお問い合わせがありました。';
			
			// 本文
			$body = <<<_EOT_
{$mail_contents}
_EOT_;

			send_mail( $from_name, $from_mail, $to_name, $to_mail, $subject, $body );
			
			// ログ書き込み
			$_POST['body'] = preg_replace ( "/\n|\s/", '', $_POST['body'] );
			$key_list = array ( 'date', 'target', 'company', 'name', 'kana', 'g1_zip', 'g1_area', 'g1_address', 'tel', 'mail', 'body' );
			foreach ( $key_list as $key )
			{
				$csv_txt .= $_POST[$key] . ',';
			}
			$csv_txt = rtrim ( $csv_txt, ',' );
			$csv_txt .= "\n";
			$csv_txt = mb_convert_encoding ( $csv_txt, 'SJIS', 'auto' );
			$fp = fopen ( 'log.csv', 'a' );
			flock( $fp, LOCK_EX );
			$result = fwrite ( $fp, $csv_txt );
			flock ( $fp, LOCK_UN );
			fclose ( $fp );
?>

<p>お問い合わせを承りました。</p>

<p class="alignCenter"><a href="<?php echo $permalink; ?>"><img src="/carsharing/lp/contact/images/btn_back_lp.gif" alt="戻る" /></a></p>

<?php
			// チケットの破棄
			unset ( $_SESSION['ticket'] );
		}
		else
		{
			echo '<script type="text/javascript">location.href = "' . $permalink . '/";</script>' . "\n";
		}
	}
?>

<?php
	/**
	 * 入力フォーム
	 */
	if ( !$flag_check )
	{
		if ( !empty ( $_POST ) )
		{
			// タグを除去
			$_POST = remove_tags( $_POST );
		}
?>

<!-- 入力フォーム -->

<?php
		include ( "php/form.php" );
	}
?>

<?php get_footer(); ?>
