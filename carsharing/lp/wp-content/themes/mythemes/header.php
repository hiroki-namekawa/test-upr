<?php

	global $title, $description, $keword, $css, $js;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja" dir="ltr">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta http-equiv="Content-Style-Type" content="text/css" />

<meta http-equiv="Content-Script-Type" content="text/javascript" />

<title><?php if ( !empty ( $title ) ) echo $title; ?></title>

<meta name="description" content="<?php if ( !empty ( $description ) ) echo $description; ?>" />

<meta name="keywords" content="<?php if ( !empty ( $keword ) ) echo $keword; ?>" />

<link href="<?php bloginfo('template_url'); ?>/css/import.css" rel="stylesheet" type="text/css" media="screen,print" />

<?php if ( !empty ( $css ) ) echo $css . "\n"; ?>

<link href="<?php bloginfo('template_url'); ?>/css/print.css" rel="stylesheet" type="text/css" media="print" />

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery-1.7.1.min.js"></script>

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/script-top.js"></script>

<?php if ( !empty ( $js ) ) echo $js . "\n"; ?>

<link rel="contents" href="/" title="ホーム" />

<?php wp_head(); ?>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-31234214-1']);
  _gaq.push(['_setDomainName', 'upr-net.co.jp']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>



<body>

<div id="layout">

<div id="header">

<div id="logo"><a href="/"><img src="<?php bloginfo('template_url'); ?>/images/logo.gif" alt="ユーピーアール株式会社" /></a></div>

<div id="contact"><img src="<?php bloginfo('template_url'); ?>/images/img_contact.gif" alt="お気軽にお電話下さい 03-3593-1723 受付時間 9:00～17:30 ※土日・祝日・年末年始を除く" /></div>

<!-- / id header --></div>

<hr />

<div id="pageBody">

<div id="content">

