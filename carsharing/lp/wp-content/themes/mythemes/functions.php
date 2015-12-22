<?php
	/**
	 * メニューの配置換え（投稿を固定ページの上に）
	 */
	function move_menus()
	{
		global $menu;
		
		//var_dump ( $menu );
		
		// 投稿
		$menu[6] = $menu[5];
		unset( $menu[5] );
		
		// 固定ページ
		$menu[5] = $menu[20];
		unset( $menu[20] );
	}
	add_action( 'admin_menu', 'move_menus' );
	
	
	/**
	 * ビジュアルエディタ
	 */
	add_editor_style( 'editor-style.css' );
	
	function custom_editor_settings( $initArray )
	{
		// ビジュアルエディタにクラスを付与
		$initArray['body_class'] = 'editor-area';
		
		// <hr />とフォントサイズボタンを追加
		#$initArray['theme_advanced_buttons3'] = 'hr,fontsizeselect';
		return $initArray;
	}
	add_filter( 'tiny_mce_before_init', 'custom_editor_settings' );
	
	remove_action( 'wp_head', 'feed_links_extra', 3 );//<link rel="alternate" type="application/rss+xml" />
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'rsd_link' );//<link rel="EditURI" type="application/rsd+xml" />
	remove_action( 'wp_head', 'wlwmanifest_link' );//<link rel="wlwmanifest" type="application/wlwmanifest+xml" /> 
	remove_action( 'wp_head', 'index_rel_link' );//<link rel='index' />
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	remove_action( 'wp_head', 'rel_canonical' );//<link rel='canonical' />
	#remove_action( 'wp_head', 'wp_generator' );//<meta name="generator" content="WordPress ***" />
?>
