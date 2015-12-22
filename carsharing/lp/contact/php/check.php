<?php
	/**
	 * 変数を定義
	 */
	$error_blank = false;
	$error_injustice = false;
	$error_over = false;
	
	
	
	/**
	 * 必須項目をチェック
	 */
	if ( is_array ( $_POST['required'] ) )
	{
		$required_arr = array_count_values ( $_POST['required'] );
		foreach ( $required_arr as $key => $count )
		{
			if ( empty ( $_POST[$key] ) )
			{
				if ( $count > 1 )
				{
					if ( preg_match ( '/^(g[0-9]+)_/', $key, $result ) )
					{
						$error_blank[$result[1]] = '1つ以上選択して下さい。';
					}
					else
					{
						$error_blank[$key] = '1つ以上選択して下さい。';
					}
				}
				else
				{
					if ( preg_match ( '/^(g[0-9]+)_/', $key, $result ) )
					{
						$error_blank[$result[1]] = '「' . $field_name_arr[$result[1]][0] . '」は必須項目です。';
					}
					else
					{
						$error_blank[$key] = '「' . $field_name_arr[$key][0] . '」は必須項目です。';
					}
				}
			}
		}
	}
	
	
	
	/**
	 * 入力チェック
	 */
	if ( is_array ( $_POST['check'] ) )
	{
		foreach ( $_POST['check'] as $key => $val )
		{
			if ( !empty ( $_POST[$key] ) )
			{
				if ( preg_match ( '/.+?,.+/', $val ) )
				{
					// 複合チェックの場合
					$val_arr = explode ( ',', $val );
					foreach ( $val_arr as $v )
					{
						// グループの場合
						if ( preg_match ( '/^(g[0-9]+)_/', $key, $result ) )
						{
							$k = $result[1];
						}
						else
						{
							$k = $key; 
						}
						
						if ( preg_match ( '/^[0-9]+$|-[0-9]+$|^[0-9]+-/', $v ) )
						{
							$error_injustice[$k] = check( $key, 'length', '', $v );
						}
						else
						{
							$error_injustice[$k] = check( $key, $v, '', '' );
						}
					}
				}
				else
				{
					if ( preg_match ( '/^[0-9]+$|-[0-9]+$|^[0-9]+-/', $val ) )
					{
						$error_injustice[$key] = check( $key, 'length', '', $val );
					}
					else
					{
						$error_injustice[$key] = check( $key, $val, '', '' );
					}
				}
			}
		}
	}
?>
