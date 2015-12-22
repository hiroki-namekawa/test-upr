<?php
	/**
	 * 外部変数を展開
	 */
	extract ( $_GET, EXTR_PREFIX_ALL, 'INPUT' );
	extract ( $_POST, EXTR_PREFIX_ALL, 'INPUT' );
	extract ( $_SESSION, EXTR_PREFIX_ALL, 'SESS' );
	extract ( $_COOKIE, EXTR_PREFIX_ALL, 'SESS' );
	
	
	
	/**
	 * 文字コード
	 */
	$charset = 'UTF-8';
	ini_set ( 'default_charset', '' );
	mb_detect_order ( 'UTF-8, EUC-JP, SJIS, JIS, ASCII' );
	mb_http_output ( 'pass' );
	mb_internal_encoding ( $charset );
	header ( 'Content-Type: text/html; charset:' . $charset );
	
	/**
	 * メール送信処理
	 */
	function send_mail( $from_name, $from_mail, $to_name, $to_mail, $subject, $body )
	{
		global $charset;
		
		// 差出人
		$from = mb_encode_mimeheader ( $from_name, 'ISO-2022-JP', 'B' ) . ' <' . $from_mail . '>';
		
		// 宛先
		$to = mb_encode_mimeheader ( $to_name, 'ISO-2022-JP', 'B' ) . ' <' . $to_mail . '>';
		
		// 件名
		$subject = mb_encode_mimeheader ( $subject, 'ISO-2022-JP', 'B' );
		
		// 本文
		$body = mb_convert_encoding ( $body, 'ISO-2022-JP', $charset );
		
		// ヘッダー
		$headers = 'Content-Type: text/plain; charset=ISO-2022-JP' . "\n" .
		'Content-Transfer-Encoding: 7bit' . "\n" .
		'MIME-Version: 1.0' . "\n" .
		'From: ' . $from . "\n" .
		'X-Mailer: PHP/' . phpversion() . "\n" .
		'Reply-To: ' . $from_mail;
		
		mail ( $to, $subject, $body, $headers );
	}
	
	/**
	 * 入力チェック
	 */
	function check( $key, $type, $option1, $option2 )
	{
		global $error_injustice, $charset;
		$text = false;
		
		// 既存のエラーを$textに入れておく
		if ( preg_match ( '/^(g[0-9]+)_/', $key, $result ) )
		{
			if ( !empty ( $error_injustice[$result[1]] ) ) $text = $error_injustice[$result[1]];
		}
		else
		{
			if ( !empty ( $error_injustice[$key] ) ) $text = $error_injustice[$key];
		}
		
		if ( $type == 'tel' )
		{
			if ( $_POST[$key] )
			{
				$_POST[$key] = mb_convert_kana ( $_POST[$key], 'a', $charset );
				$_POST[$key] = preg_replace ( '/\-/', '', $_POST[$key] );
				
				if ( !preg_match ( '/^[0-9]{10,11}$/', $_POST[$key] ) )
				{
					if ( $text ) $text .= '<br />' . "\n";
					
					if ( $option1 )
					{
						if ( !preg_match ( '/' . $option1 . '/', $text ) ) $text .= $option1 . "\n";
					}
					else
					{
						if ( !preg_match ( '/形式が不正です。/', $text ) ) $text .= '形式が不正です。';
					}
				}
			}
			
			return $text;
		}
		elseif ( $type == 'tel2' )
		{
			if ( $_POST[$key] )
			{
				$_POST[$key] = mb_convert_kana ( $_POST[$key], 'a', $charset );
				
				if ( !preg_match ( '/^[0-9]+-[0-9]+-[0-9]+$/', $_POST[$key] ) )
				{
					if ( $text ) $text .= '<br />' . "\n";
					
					if ( $option1 )
					{
						$text .= $option1 . "\n";
					}
					else
					{
						$text .= '形式が不正です。';
					}
				}
			}
			
			return $text;
		}
		elseif ( $type == 'mail' )
		{
			if ( $_POST[$key] )
			{
				$_POST[$key] = mb_convert_kana ( $_POST[$key], 'a', $charset );
				
				if ( !preg_match ( '/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $_POST[$key] ) )
				{
					if ( $text ) $text .= '<br />' . "\n";
					
					if ( $option1 )
					{
						$text .= $option1 . "\n";
					}
					else
					{
						$text .= '形式が不正です。';
					}
				}
			}
			
			return $text;
		}
		elseif ( $type == 'zip' )
		{
			if ( $_POST[$key] )
			{
				$_POST[$key] = mb_convert_kana ( $_POST[$key], 'a', $charset );
				
				if ( !preg_match ( '/^[0-9]{3}\-[0-9]{4}$/', $_POST[$key] ) && !preg_match ( '/^[0-9]{7}$/', $_POST[$key] ) )
				{
					if ( $text ) $text .= '<br />' . "\n";
					
					if ( $option1 )
					{
						$text .= $option1 . "\n";
					}
					else
					{
						$text .= '形式が不正です。';
					}
				}
				elseif ( preg_match ( '/^[0-9]{7}$/', $_POST[$key] ) )
				{
					$_POST[$key] = preg_replace ( '/^([0-9]{3})([0-9]{4})$/', '$1-$2', $_POST[$key] );
				}
			}
			
			return $text;
		}
		elseif ( $type == 'url' )
		{
			if ( $_POST[$key] )
			{
				$_POST[$key] = mb_convert_kana ( $_POST[$key], 'a', $charset );
				
				if ( !preg_match ( '/^(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)$/', $_POST[$key] ) )
				{
					if ( $text ) $text .= '<br />' . "\n";
					
					if ( $option1 )
					{
						$text .= $option1 . "\n";
					}
					else
					{
						$text .= '形式が不正です。';
					}
				}
			}
			
			return $text;
		}
		elseif ( $type == 'number' )
		{
			if ( $_POST[$key] )
			{
				$_POST[$key] = mb_convert_kana ( $_POST[$key], 'a', $charset );
				$_POST[$key] = str_replace( ',', '', $_POST[$key] );
				
				if ( preg_match ( '/[^0-9.]/', $_POST[$key] ) )
				{
					if ( $option1 )
					{
						$text .= $option1 . "\n";
					}
					else
					{
						$error_text = "形式が不正です。";
						if ( !preg_match ( '/' . $error_text . '/', $text ) )
						{
							if ( $text ) $text .= "<br />\n";
							$text .= $error_text;
						}
					}
				}
			}
			
			return $text;
		}
		elseif ( $type == 'length' )
		{
			if ( $_POST[$key] )
			{
				$flag = false;
				
				$tmp = $_POST[$key];
				// タグを除去
				$tmp = strip_tags( $tmp );
				// 改行を削除
				$tmp = preg_replace ( "/(\015\012)|(\015)|(\012)/","", $tmp );
				// 連続する半角スペースを半角スペース１としてカウント
				$tmp = preg_replace ( '!\s+!'," ", $tmp );
				// HTML特殊文字を半角1文字としてカウント
				$tmp = preg_replace ( "/&[a-zA-Z]{1,5};/"," ", $tmp );
				// Unicode10進文字を半角1文字としてカウント
				$tmp = preg_replace ( "/&#[0-9]{1,5};/"," ", $tmp );
				
				if ( preg_match ( "/^([0-9]+|)-([0-9]+|)$/i", $option2 ) )
				{
					$arr = explode( "-", $option2 );
					
					if ( $arr[0] && $arr[1] )
					{
						if ( mb_strlen( $tmp,$charset ) < $arr[0] || mb_strlen( $tmp,$charset ) > $arr[1] ) $flag = true;
					}
					elseif ( $arr[0] && !$arr[1] )
					{
						if ( mb_strlen( $tmp,$charset ) < $arr[0] ) $flag = true;
					}
					elseif ( !$arr[0] && $arr[1] )
					{
						if ( mb_strlen( $tmp,$charset ) > $arr[1] ) $flag = true;
					}
				}
				else
				{
					if ( mb_strlen( $tmp,$charset ) != $option2 ) $flag = true;
				}
				
				if ( $flag )
				{
					if ( $option1 )
					{
						$text .= $option1;
					}
					else
					{
						$error_text = "文字数制限を満たしていません。";
						if ( !preg_match ( '/' . $error_text . '/', $text ) )
						{
							if ( $text ) $text .= "<br />\n";
							$text .= $error_text;
						}
					}
				}
			}
			
			return $text;
		}
		elseif ( $type == 'file_type' )
		{
			if ( $_FILES[$key]["type"] )
			{
				//jpeg|gif|png
				if ( !preg_match ( "/^image\/.*(" . $option1 . ")$/i", $_FILES[$key]["type"] ) )
				{
					$option1 = preg_replace ( "/\|/",", ", $option1 );
					
					if ( $text ) $text .= '<br />' . "\n";
					$text .= "アップロードできるファイルは「";
					$text .= $option1;
					$text .= "」のみです。";
				}
			}
			
			return $text;
		}
		elseif ( $type == 'file_size' )
		{
			if ( $_FILES[$key]["size"] )
			{
				if ( $_FILES[$key]["size"] > 1024 * $option1 )
				{
					if ( $text ) $text .= '<br />' . "\n";
					$text .= "アップロードできるファイルサイズは" . $option1 . "KBまでです。";
				}
			}
			
			return $text;
		}
		elseif ( $type == 'date' )
		{
			foreach( $_POST[$key] as $key => $value )
			{
				if ( $value != NULL )
				{
					$_POST[$key][$key] = mb_convert_kana ( $_POST[$key][$key], 'a', $charset );
					
					if ( preg_match ( "/[^0-9]/", $_POST[$key][$key] ) )
					{
						$text = $option1 . "に不正な文字が含まれています。\n";
					}
				}
			}
			
			if ( $_POST[$key][0] && $_POST[$key][1] && $_POST[$key][2] && !$text && !checkdate( $_POST[$key][1], $_POST[$key][2], $_POST[$key][0] ) )
			{
				$text = $option1 . "が不正です。\n";
			}
			
			return array( $text, $_POST[$key] );
		}
		elseif ( $type == 'alphanumeric' )
		{
			if ( $_POST[$key] )
			{
				$_POST[$key] = mb_convert_kana ( $_POST[$key], 'a', $charset );
				
				if ( !preg_match ( "/^[a-zA-Z0-9_]+$/", $_POST[$key] ) )
				{
					if ( $text ) $text .= '<br />' . "\n";
					
					if ( $option1 )
					{
						$text .= $option1 . "\n";
					}
					else
					{
						$text .= '形式が不正です。';
					}
				}
			}
			
			return $text;
		}
	}
	
	/**
	 * 入力エラー処理
	 */
	function input_error( $error_blank, $error_injustice )
	{
		$error_array = array( $error_blank, $error_injustice );
		
		foreach( $error_array as $row )
		{
			if ( is_array ( $row ) )
			{
				foreach( $row as $key => $value )
				{
					if ( $value != NULL )
					{
						// グループの場合
						if ( preg_match ( '/^(g[0-9]+)_/', $key, $result ) ) $key = $result[1];
						
						if ( empty ( $error_html[$key] ) )
						{
							$error_html[$key] = "<span class=\"inputError\">" . $value . "</span><br />\n";
							$error_css[$key] = " class=\"inputError\"";
						}
						else
						{
							$error_html[$key] = rtrim ( $error_html[$key], "</span><br />\n" );
							$error_html[$key] .= "\n<br />" . $value . "</span><br />\n";
						}
					}
				}
			}
		}
		
		if ( empty ( $error_html ) ) $error_html = false;
		if ( empty ( $error_css ) ) $error_css = false;
		
		return array( $error_html, $error_css );
	}
	
	/**
	 * タグを除去
	 */
	function remove_tags( $post )
	{
		foreach( $post as $key => $value )
		{
			if ( !is_array ( $value ) ) $post[$key] = strip_tags( $value );
		}
		
		return $post;
	}
	
	/**
	 * データの整形
	 */
	function fix_data( $post )
	{
		global $charset;
		if ( is_array ( $post ) )
		{
			foreach( $post as $key => $value )
			{
				if ( is_array ( $value ) ) continue;
				$post[$key] = mb_convert_kana ( $post[$key],'KV',$charset );
				$post[$key] = mb_convert_encoding( $post[$key],$charset,"auto" );
				$post[$key] = strip_tags( $post[$key] );
				$post[$key] = stripslashes( $post[$key] );
				$post[$key] = preg_replace ( "/^(\s|　)+$/","", $post[$key] );
				$post[$key] = str_replace( "\n","<br />", $post[$key] );
				$post[$key] = str_replace( '"','”', $post[$key] );
				$post[$key] = str_replace( "\\","￥", $post[$key] );
				$post[$key] = str_replace( ",","，", $post[$key] );
			}
		}
		else
		{
			$post = mb_convert_kana ( $post,'KV',$charset );
			$post = mb_convert_encoding ( $post,$charset,"auto" );
			$post = strip_tags ( $post );
			$post = stripslashes ( $post );
			$post = preg_replace ( "/^(\s|　)+$/","", $post );
			$post = str_replace ( "\n","<br />", $post );
			$post = str_replace ( '"','”', $post );
			$post = str_replace ( "\\","￥", $post );
			$post = str_replace ( ",","，", $post );
		}
		
		return $post;
	}
	
	/**
	 * フィールドの作成
	 */
	function createField( $arg )
	{
		global $ex;
		
		if ( empty ( $_POST[$arg['name']] ) ) $_POST[$arg['name']] = false;
		
		if ( $arg['type'] == 'text' )
		{
			echo '<input type="text" name="' . $arg['name'] . '" value="';
			echo ( !empty( $_POST[$arg['name']] ) ) ? $_POST[$arg['name']] : $arg['value'];
			echo '" size="' . $arg['size'] . '"';
			if ( !empty ( $ex[$arg['name']] ) ) echo ' title="' . $ex[$arg['name']] . '"';
			if ( !empty ( $arg['id'] ) ) echo ' id="' . $arg['id'] . '"';
			if ( !empty ( $arg['class'] ) ) echo ' class="' . $arg['class'] . '"';
			if ( !empty ( $arg['free'] ) ) echo ' ' . $arg['free'];
			echo ' />' . "\n";
		
			// 入力チェック
			if ( !empty ( $arg['check'] ) ) echo '<input type="hidden" name="check[' . $arg['name'] . ']" value="' . $arg['check'] . '" />' . "\n";
		}
		
		if ( $arg['type'] == 'radio' )
		{
			echo '<input type="radio" name="' . $arg['name'] . '" value="' . $arg['value'] . '"';
			if ( !empty ( $arg['id'] ) ) echo ' id="' . $arg['id'] . '"';
			if ( !empty ( $arg['class'] ) ) echo ' class="' . $arg['class'] . '"';
			if ( !empty ( $arg['free'] ) ) echo ' ' . $arg['free'];
			if ( empty ( $_POST[$arg['name']] ) && !empty ( $arg['option1'] ) ) echo ' checked="checked"';
			elseif ( $_POST[$arg['name']] == $arg['value'] ) echo ' checked="checked"';
			echo ' /> <label for="' . $arg['id'] . '">' . $arg['value'] . '</label>' . "\n";
		}
		
		if ( $arg['type'] == 'checkbox' )
		{
			echo '<input type="checkbox" name="' . $arg['name'] . '[]" value="' . $arg['value'] . '"';
			if ( !empty ( $arg['id'] ) ) echo ' id="' . $arg['id'] . '"';
			if ( !empty ( $arg['class'] ) ) echo ' class="' . $arg['class'] . '"';
			if ( !empty ( $arg['free'] ) ) echo ' ' . $arg['free'];
			if ( empty ( $_POST[$arg['name']] ) )
			{
				if ( !empty ( $arg['option1'] ) ) echo ' checked="checked"';
			}
			else
			{
				foreach ( $_POST[$arg['name']] as $value )
				{
					if ( $arg['value'] == $value ) echo ' checked="checked"';
				}
			}
			echo ' /> <label for="' . $arg['id'] . '">' . $arg['value'] . '</label>' . "\n";
		}
		
		if ( $arg['type'] == 'select' )
		{
			if ( $arg['value'] == 'area' ) $arg['value'] = array( $arg['option1']=>0,'北海道'=>1,'青森県'=>1,'岩手県'=>1,'宮城県'=>1,'秋田県'=>1,'山形県'=>1,'福島県'=>1,'新潟県'=>1,'富山県'=>1,'石川県'=>1,'福井県'=>1,'長野県'=>1,'山梨県'=>1,'茨城県'=>1,'栃木県'=>1,'群馬県'=>1,'埼玉県'=>1,'千葉県'=>1,'東京都'=>1,'神奈川県'=>1,'岐阜県'=>1,'静岡県'=>1,'愛知県'=>1,'三重県'=>1,'滋賀県'=>1,'京都府'=>1,'大阪府'=>1,'兵庫県'=>1,'奈良県'=>1,'和歌山県'=>1,'鳥取県'=>1,'島根県'=>1,'岡山県'=>1,'広島県'=>1,'山口県'=>1,'徳島県'=>1,'香川県'=>1,'愛媛県'=>1,'高知県'=>1,'福岡県'=>1,'佐賀県'=>1,'長崎県'=>1,'熊本県'=>1,'大分県'=>1,'宮崎県'=>1,'鹿児島県'=>1,'沖縄県'=>1 );
			
			echo '<select name="' . $arg['name'] . '"';
			if ( !empty ( $arg['id'] ) ) echo ' id="' . $arg['id'] . '"';
			if ( !empty ( $arg['class'] ) ) echo ' class="' . $arg['class'] . '"';
			if ( !empty ( $arg['free'] ) ) echo ' ' . $arg['free'];
			echo '>' . "\n";
			foreach( $arg['value'] as $key => $row )
			{
				echo '<option value="';
				if ( $row == 1 ) echo $key;
				echo '"';
				if ( !$_POST[$arg['name']] && ( $arg['option1'] == $key ) ) echo ' selected="selected"';
				elseif ( $_POST[$arg['name']] == $key ) echo ' selected="selected"';
				echo '>' . $key . '</option>' . "\n";
			}
			echo '</select>' . "\n";
		}
		
		/*
		if ( $arg['type'] == 'file' )
		{
			echo "<input type=\"file\" name=\"{$arg['name']}\" size=\"{$arg['option1']}\" id=\"{$arg['id']}\" />\n";
		}
		*/
		
		if ( $arg['type'] == 'textarea' )
		{
			echo '<textarea name="' . $arg['name'] . '" cols="' . $arg['option1'] . '" rows="' . $arg['option2'] . '"';
			if ( !empty ( $arg['id'] ) ) echo ' id="' . $arg['id'] . '"';
			if ( !empty ( $arg['class'] ) ) echo ' class="' . $arg['class'] . '"';
			if ( !empty ( $arg['free'] ) ) echo ' ' . $arg['free'];
			echo '>' . $_POST[$arg['name']] . '</textarea>' . "\n";
		
			// 入力チェック
			if ( !empty ( $arg['check'] ) ) echo '<input type="hidden" name="check[' . $arg['name'] . ']" value="' . $arg['check'] . '" />' . "\n";
		}
		
		// 必須項目
		if ( !empty ( $arg['required'] ) )
		{
			echo '<input type="hidden" name="required[]" value="' . $arg['name'] . '" />' . "\n";
		}
	}
	
	/**
	 * 不可視フィールドを作成
	 */
	function hidden_field()
	{
		$hidden = false;
		
		foreach( $_POST as $key => $value )
		{
			if ( $key == "mode" ) continue;
			if ( is_array ( $value ) )
			{
				$i = 0;
				foreach( $value as $value2 )
				{
					if ( is_array ( $value2 ) )
					{
						foreach( $value2 as $value3 )
						{
							$hidden .= "<input type=\"hidden\" name=\"{$key}[{$i}][]\" value=\"{$value3}\" />\n";
						}
					}
					else
					{
						$hidden .= "<input type=\"hidden\" name=\"{$key}[]\" value=\"{$value2}\" />\n";
					}
					$i++;
				}
			}
			else
			{
				$hidden .= "<input type=\"hidden\" name=\"{$key}\" value=\"{$value}\" />\n";
			}
		}
		
		return $hidden;
	}
	
	/**
	 * 自動リンク
	 */
	function auto_link( $post, $target_array )
	{
		foreach( $post as $key => $value )
		{
			foreach( $target_array as $value2 )
			{
				if ( $key == $value2 )
				{
					$post[$key] = preg_replace ( "/(https?|ftp|news)(:\/\/[[:alnum:]\+\$\;\?\.%,!#~*\/:@&=_-]+)/",'<a href="\\1\\2" target="_blank">\\1\\2</a>', $value );
					
					if ( preg_match_all( "[>(https?|ftp|news)(://[[:alnum:]\+\$\;\?\.%,!#~*/:@&=_-]+)<]", $post[$key], $url_array,PREG_SET_ORDER ) )
					{
						foreach( $url_array as $url )
						{
							$wbr_url = preg_replace ( "/\//","/<wbr />", $url[0] );
							$url[0] = preg_quote( $url[0] );
							$url[0] = preg_replace ( "/\//","\/", $url[0] );
							$post[$key] = preg_replace ( "/" . $url[0] . "/", $wbr_url, $post[$key] );
						}
					}
				}
			}
		}
		
		return $post;
	}
?>
