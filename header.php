<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cousateca
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<?php if (get_post_type() == 'cousa'){ ?>
		<meta property="og:url" content="<?php the_permalink(); ?>" />
		<meta property="og:type"               content="product" />
		<meta property="og:title"              content="<?php the_title(); ?>" />
		<meta property="og:image"              content="<?php the_post_thumbnail_url('full'); ?>" />
	<?php } ?>
	<script>$ = jQuery;</script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-110088291-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-110088291-1');
	</script>
</head>

<body <?php body_class(); ?>>
