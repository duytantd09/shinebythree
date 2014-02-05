<?php

define('THEME_NAME', 'shinebythree');

$template_directory = get_template_directory();

$template_directory_uri = get_template_directory_uri();

require( $template_directory . '/inc/default/functions.php' );

require( $template_directory . '/inc/default/hooks.php' );

require( $template_directory . '/inc/default/shortcodes.php' );


// Custom Actions



//gforms_datepicker

add_action( 'after_setup_theme', 'custom_setup_theme' );

add_action( 'init', 'custom_init');

add_action( 'wp', 'custom_wp');

add_action( 'admin_menu', 'custom_remove_menus');

add_action( 'widgets_init', 'custom_widgets_init' );

add_action( 'wp_enqueue_scripts', 'custom_scripts', 30);

add_action( 'wp_print_styles', 'custom_styles', 30);

add_action('admin_head', 'custom_admin_head');

// Custom Filters

add_filter( 'dynamic_sidebar_params', 'custom_dynamic_sidebar_params' );

add_filter( 'date_rewrite_rules', 'custom_date_rewrite_rules');

add_filter( 'month_link', 'custom_month_link', 10, 3);

add_filter( 'template_include', 'custom_template_include');

add_filter( 'the_content', 'custom_the_content');

add_filter( 'pre_get_posts', 'custom_pre_get_posts');

add_filter( 'nav_menu_link_attributes', 'custom_nav_menu_link_attributes', 10, 3);

//Custom shortcodes

//add_shortcode( 'phone_number', 'custom_phone_number');


function custom_setup_theme() {
	
	add_theme_support( 'automatic-feed-links' );
	
	add_theme_support( 'post-thumbnails' );

	add_theme_support('woocommerce');

	add_theme_support('editor_style');

	add_post_type_support('page', 'excerpt');

	//add_theme_support( 'post-formats', array( 'gallery' ) );

	add_image_size( 'full_width', 1200, 999999);
	add_image_size( 'thumbnail_medium', 300, 150, true);
	add_image_size( 'thumbnail_large', 300, 300, true);
	add_image_size( 'post_portrait', 600, 800, true);


	register_nav_menus( array(
		'main' => __( 'Main', THEME_NAME ),
		'about' => __( 'About', THEME_NAME )
	) );

	add_editor_style('css/editor-style.css');

	//add_rewrite_rule('archive','index.php?year=2014,2013,2012,2011,2010','top');
}

function custom_init(){
	global $template_directory;

	require( $template_directory . '/inc/classes/custom-post-type.php' );
	if(function_exists('get_field')) {
		// $press_releases_page = get_field('press_releases_page', 'options');
		// $press_releases_url = get_page_uri($press_releases_page->ID);
		// $press_release = new Custom_Post_Type( 'Press release', 
	 // 		array(
	 // 			'rewrite' => array( 'with_front' => false, 'slug' => $press_releases_url ),
	 // 			'capability_type' => 'post',
	 // 		 	'publicly_queryable' => true,
	 //   			'has_archive' => true, 
	 //    		'hierarchical' => false,
	 //    		'exclude_from_search' => false,
	 //    		'menu_position' => null,
	 //    		'supports' => array('title', 'editor', 'page-attributes', 'thumbnail'),
	 //    		'plural' => 'Press Releases'
	 //   		)
	 //   	);

	 //   	$press_release->add_taxonomy('press_category', 
	 //   		array('hierarchical' => true, 'rewrite' => array( 'slug' => 'press-category')), 
	 //   		array('plural' => __("Categories", THEME_NAME), 'singular_name' => __("Category", THEME_NAME))
	 //   	);
	}

}

function custom_wp(){
	
}

function custom_widgets_init() {
	global $template_directory;

	require( $template_directory . '/inc/widgets/post.php' );

	require( $template_directory . '/inc/widgets/twitter/feed.php' );
	
	// 	/********************** Sidebars ***********************/

	// register_sidebar( array(
	// 	'name' => __( 'Default', THEME_NAME ),
	// 	'id' => 'default',
	// 	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	// 	'after_widget' => '</aside>',
	// 	'before_title' => '<h5 class="widget-title">',
	// 	'after_title' => '</h5>',	
	// ) );

	register_sidebar( array(
		'name' => __( 'Spotlight', THEME_NAME ),
		'id' => 'spotlight',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>'
	) );

	// 	/********************** Content ***********************/

	// register_sidebar( array(
	// 	'name' => __( 'Homepage Content', THEME_NAME ),
	// 	'id' => 'homepage_content',
	// 	'before_widget' => '<aside id="%1$s" class="widget span one-third %2$s">',
	// 	'after_widget' => '</aside>',
	// 	'before_title' => '<h5 class="widget-title text-center light-brown uppercase">',
	// 	'after_title' => '</h5>',
	// ) );
}

function custom_remove_menus() {
	global $menu;
	$restricted = array(__('Links'));
	end ($menu);
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:'' , $restricted)) unset($menu[key($menu)]);
	}
}

function custom_scripts() {
	global $template_directory_uri;
	// wp_dequeue_script('prettyPhoto');
	// wp_dequeue_script('prettyPhoto-init');
	// wp_dequeue_script('woocommerce-wishlists');
	// wp_dequeue_script('wc-single-product');
	// wp_register_script('fancybox', $template_directory_uri.'/js/plugins/jquery.fancybox.min.js', array('jquery'), '', true);
	
	wp_enqueue_script('jquery');

	wp_enqueue_script('modernizr', $template_directory_uri.'/js/libs/modernizr.min.js');
	wp_enqueue_script('plugins', $template_directory_uri.'/js/plugins.min.js', array('jquery', 'modernizr'), '', true);
	wp_enqueue_script('main', $template_directory_uri.'/js/main.js', array('jquery', 'modernizr', 'plugins'), '', true);

	wp_register_script('masonry', $template_directory_uri.'/js/plugins/jquery.masonry.min.js', array('jquery', 'modernizr'), '', true);
}


function custom_styles() {
	global $wp_styles, $template_directory_uri;
	wp_enqueue_style( 'style', $template_directory_uri . '/css/style.css' );	
}



function custom_admin_head() {
  echo '<style>
    table.acf_input tbody tr td.label {
    	width: 10%;
    }
  </style>';
}

function custom_dynamic_sidebar_params($params){
	

	global $wp_registered_widgets, $widget_number;
	$sidebar_id             = $params[0]['id'];
	$arr_registered_widgets = wp_get_sidebars_widgets();
	$widget_id              = $params[0]['widget_id'];
	$widget_obj             = $wp_registered_widgets[$widget_id];
	$widget_num             = $widget_obj['params'][0]['number'];
	$widget_opt = get_option( $widget_obj['callback'][0]->option_name );
	if(isset($widget_opt[$widget_num]['size'])) {
		$params[0]['before_widget'] = preg_replace( '/class="/', "class=\"{$widget_opt[$widget_num]['size']} ", $params[0]['before_widget'], 1 );
	}
	return $params;
}

function custom_date_rewrite_rules($rewrites){
	$archive_page = get_field('archive_page', 'options');
	foreach($rewrites as $key => $value){
		$rewrites[$archive_page->post_name.'/'.$key] = $value;
		unset($rewrites[$key]);
	}

	return $rewrites;
}

function custom_month_link($url, $year, $month) {
	global $wp_rewrite;
	$archive_page = get_field('archive_page', 'options');
	$monthlink = $archive_page->post_name.$wp_rewrite->get_month_permastruct();
	if ( !empty($monthlink) ) {
		$monthlink = str_replace('%year%', $year, $monthlink);
		$monthlink = str_replace('%monthnum%', zeroise(intval($month), 2), $monthlink);
		return home_url( user_trailingslashit($monthlink, 'month') );
	}
	return $url;
}


// add_filter('parse_query', 'custom_parse_query');

// function custom_parse_query( $query ) {

// 	$archive_page = get_field('archive_page', 'options');
// 	if($archive_page->post_name == $query->query_vars['pagename']) {
// 		$query->is_archive = true;
// 		$query->is_posts_page = true;
// 	}
// 	return $query;
// }

function custom_template_include($template){
	global $wp_query;
	if(is_archive_page()) {
		$template = get_archive_template();
	}

	return $template;
}

// add_filter('pre_get_posts', 'custom_pre_get_posts');
// function custom_pre_get_posts($query){
// 	if(is_archive_page()) {
// 		unset($query->query_vars['page']);
// 		unset($query->query_vars['pagename']);
// 		unset($query->query['pagename']);
// 		$query->is_archive = true;
// 		$query->is_posts_page = true;
// 	}
// 	return $query;
// }

function is_archive_page(){
	global $wp_query;
	$archive_page = get_field('archive_page', 'options');
	if($archive_page->post_name == $wp_query->query_vars['pagename']) return true;
	return false;
}

function custom_pre_get_posts($query){
	if(!is_admin()){
		if(is_archive_page() || is_date()){
			$query->query_vars['posts_per_page'] = 17;	
		}
	}
	return $query;
}

function custom_the_content($content){
	if (preg_match_all('/<img[^>]+>/i', $content, $images)) {
		$images = isset($images[0]) ? $images[0] : NULL;
		if($images) {
			foreach($images as $image) {
				$attributes = simplexml_load_string($image);
				$orientation = (isset($attributes['data-orientation'])) ? $attributes['data-orientation'][0] : '';
				$id = get_attachment_id_from_url($attributes['src']);
				$size = 'large';
			
				switch($orientation) {
					case 'portrait':
				 		$size = 'post_portrait';
				 		break;
				 	case 'landscape':
				 	default:
				 		$size = 'large';
				 		break;
				}
				$new_image = wp_get_attachment_image_src($id, $size);
				if($new_image[0]){
			 		$content = str_replace($attributes['src'], $new_image[0], $content);
			 	}
			}
		}
	}
	return $content;
}


function custom_nav_menu_link_attributes($atts, $item, $args){
	if($args->theme_location == 'about') {
		$atts['data-id'] = $item->ID;
		$atts['class'] = 'btn';
	}

	return $atts;
}
