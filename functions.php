<?php

//register menus - this theme has two menus, but you can use more.
function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'extra-menu' => __( 'Extra Menu' )
    )
  );
}
add_action( 'init', 'register_my_menus' );

/**
* Register widget areas
* This theme has two, but you can add mode
 */
function arphabet_widgets_init() {

	register_sidebar( array(
		'name'          => 'Home right sidebar',
		'id'            => 'home_right_1',
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => 'Footer Widget Area',
		'id'            => 'footer_widget_area',
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );
	//example of a third widget area
	// register_sidebar( array(
	// 	'name'          => 'Third Widget Area',
	// 	'id'            => 'third_widget_area',
	// 	'before_widget' => '<div class="widget">',
	// 	'after_widget'  => '</div>',
	// 	'before_title'  => '<h2 class="rounded">',
	// 	'after_title'   => '</h2>',
	// ) );
}
add_action( 'widgets_init', 'arphabet_widgets_init' );


add_theme_support( 'post-thumbnails' );



function limit_posts_per_page() {
	if ( is_category('portfolio') ) //only 2 posts per page for portfolio
		return 2;
	else
		return 5; // default: 5 posts per page
}
add_filter('pre_option_posts_per_page', 'limit_posts_per_page');


//correctly install javascript, wordpress style

function my_scripts_method() {
  wp_enqueue_script( 'parralx', get_stylesheet_directory_uri().'/paralx.js',array( 'jquery' ));
  wp_enqueue_script( 'main', get_stylesheet_directory_uri().'/main.js',array( 'jquery' ));
}

add_action( 'wp_enqueue_scripts', 'my_scripts_method' );







?>
