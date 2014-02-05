<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package shinebythree
 * @since shinebythree 1.0
 */

global $woocommerce;
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html xmlns:fb="http://ogp.me/ns/fb#" class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 7]>         <html xmlns:fb="http://ogp.me/ns/fb#" class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html xmlns:fb="http://ogp.me/ns/fb#" class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html xmlns:fb="http://ogp.me/ns/fb#" class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html xmlns:fb="http://ogp.me/ns/fb#" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link href="<?php echo get_template_directory_uri(); ?>/images/misc/favicon.png" rel="shortcut icon" type="image/x-icon">

    <script type="text/javascript">
		var themeUrl = '<?php bloginfo( 'template_url' ); ?>';
		var baseUrl = '<?php bloginfo( 'url' ); ?>';
	</script>
    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<div id="wrap">
	<header id="header" role="banner">
		<div class="top">
			<div class="inner container">
				<?php get_template_part('inc/social-links'); ?>
				<?php get_search_form(); ?>
			</div>	
		</div>
		<div class="bottom">
			<div class="inner container">
				<h1 class="logo-container">
					<a class="logo" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</h1>

				<div class="info">
					<nav class="navigation">
						<ul class="menu">
							<?php if($about_page = get_field('about_page', 'options')): ?>
							<li>
								<a href="<?php echo get_permalink($about_page->ID); ?>"><?php echo get_the_title($about_page->ID); ?></a>

								<div class="mega-sub-menu">
									<div class="scroller">
										<?php wp_nav_menu( array( 'theme_location' => 'about', 'menu_class' => 'clearfix menu', 'container' => 'nav', 'container_class' => 'scroller-pagination navigation' )); ?>
										<?php $menu_items = wp_get_nav_menu_items('about'); ?>
										<?php if(!empty($menu_items)): ?>
										<div class="scroller-mask">
											<?php foreach($menu_items as $menu_item): ?>
											<?php $page = get_post( $menu_item->object_id );  ?>
											<div class="scroll-item clearfix" data-id="<?php echo $menu_item->ID; ?>">
												<div class="featured-image">
													<?php echo get_the_post_thumbnail($menu_item->object_id); ?>
												</div>
												<?php if(isset($page->post_excerpt)): ?>
												<div class="content">
													<?php echo apply_filters('the_content', $page->post_excerpt); ?>
												</div>
												<?php endif; ?>
											</div>
											<?php endforeach; ?>
										</div>
										<?php endif; ?>
									</div>
								</div>
							</li>
							<?php endif; ?>
						</ul>
					</nav>
					<?php get_template_part('inc/social-links'); ?>
				</div>
				<?php wp_nav_menu( array( 'theme_location' => 'main', 'menu_class' => 'clearfix menu', 'container' => 'nav', 'container_class' => 'main-navigation navigation' )); ?>
				<button class="mobile-navigation-btn"></button>
			</div>
		</div>
	</header><!-- #header -->
	<div id="main" class="site-main" role="main">