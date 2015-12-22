<?php
	$title = get_the_title();
	$description = esc_html ( post_custom( 'description' ) );
	$keword = esc_html ( post_custom( 'keword' ) );
	
	//$css = '';
	//$js = '';
	
	get_header();
	
	the_post();
?>

<?php the_content(); ?>

<div class="btnContact"><a href="/carsharing/lp/contact/?id=<?php the_ID(); ?>"><img src="<?php bloginfo('template_url'); ?>/images/btn_contact.gif" alt="お問い合わせはこちら" class="over" /></a></div>

<?php get_footer(); ?>
