<?php

// enqueue scripts and styles
function my_enqueue_scripts() {

	// scripts
	// wp_register_script( 'modernizr', get_stylesheet_directory_uri() . '/js/modernizr.custom.js', array('jquery'), '5.5.0', true );
	// wp_enqueue_script( 'modernizr' ); 
	// wp_register_script( 'selectivizr', get_stylesheet_directory_uri() . '/js/selectivizr.min.js', array('jquery'), '5.5.0', true );
	// wp_enqueue_script( 'selectivizr' ); 
	// wp_register_script( 'imagesloaded', get_stylesheet_directory_uri() . '/js/imagesloaded.pkgd.min.js', array('jquery'), '5.5.0', true );
	// wp_enqueue_script( 'imagesloaded' );
	// wp_register_script( 'imagefill', get_stylesheet_directory_uri() . '/js/jquery-imagefill.js', array('jquery'), '5.5.0', true );
	// wp_enqueue_script( 'imagefill' ); 
	wp_register_script( 'main', get_stylesheet_directory_uri() . '/js/main.js', array('jquery'), '5.5.0', true );
	wp_enqueue_script( 'main' );	

	// stylesheets
	wp_enqueue_style( 'default', get_stylesheet_uri() );
	// wp_register_style( 'base', get_template_directory_uri() . '/css/base.css', array(), '1.0', 'all' );
	// wp_enqueue_style( 'base' );
	wp_register_style( 'main', get_template_directory_uri() . '/css/main.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'main' );
	wp_register_style( 'responsive', get_template_directory_uri() . '/css/responsive.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'responsive' );

	// comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
}
add_action('wp_enqueue_scripts', 'my_enqueue_scripts');


// add widget support
function arphabet_widgets_init() {
	register_sidebar( array('name' => 'Main Sidebar', 'id' => 'main-sidebar') );
}
add_action('widgets_init', 'arphabet_widgets_init');


// add feed links
add_theme_support('automatic-feed-links');


// remove the admin bar
add_action( 'admin_print_scripts-profile.php', 'hide_admin_bar_prefs' );
function hide_admin_bar_prefs() { 
	?>
		<style type="text/css">
			.show-admin-bar {display: none;}
		</style>
	<?php
}
add_filter('show_admin_bar', '__return_false');


// disable paragraph tag wrapping
function filter_ptags_on_images($content) {
    return preg_replace('/<p>\\s*?(<a .*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s', '\1', $content);
}
add_filter('the_content', 'filter_ptags_on_images');


// attach a class to linked images' parent anchors
function give_linked_images_class($html, $id, $caption, $title, $align, $url, $size, $alt = '' ){
  $classes = 'lightbox-link'; // separated by spaces, e.g. 'img image-link'

  // check if there are already classes assigned to the anchor
  if ( preg_match('/<a.*? class=".*?">/', $html) ) {
    $html = preg_replace('/(<a.*? class=".*?)(".*?>)/', '$1 ' . $classes . '$2', $html);
  } else {
    $html = preg_replace('/(<a.*?)>/', '$1 class="' . $classes . '" >', $html);
  }
  return $html;
}
add_filter('image_send_to_editor','give_linked_images_class',10,8);


// add stylesheet for WYSIWYG editor
function my_theme_add_editor_styles() {
    add_editor_style( 'css/editor-style.css' );
}
add_action( 'admin_init', 'my_theme_add_editor_styles' );


// create custom post types
function addCPTs() {
/*
	// case studies
	$cpt_args = array(
		'menu_icon' => '',
		'label'	=> __('Case Studies'),
		'singular_label' =>	__('Case Study'),
		'public'	=>	true,
		'show_ui'	=>	true,
		'capability_type'	=>	'post',
		'hierarchical'	=>	false,
		'rewrite'	=>	true,
		'supports'	=>	array('title', 'thumbnail')
		);
	register_post_type('case-study', $cpt_args);
*/
}
add_action('init', 'addCPTs');
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 140, 75, true );


// customise admin menu icons (https://developer.wordpress.org/resource/dashicons/)
function add_menu_icons_styles() {
	?>
		<style>
			#adminmenu .menu-icon-case-study div.wp-menu-image:before { content: '\f175'; }
		</style>
	<?php
}
add_action( 'admin_head', 'add_menu_icons_styles' );


// add custom taxonomies
function custom_taxonomy_init() {

	/*
	register_taxonomy(
		'destinations',
		array('road-trip', 'great-adventure', 'travel-experience', 'poi'),
		array(
			'label' => __( 'Destinations' ),
			'rewrite' => array( 'slug' => 'destinations' ),
			'hierarchical'      => true,
			'capabilities' => array(
			    'manage__terms' => 'edit_posts',
			    'edit_terms' => 'manage_categories',
			    'delete_terms' => 'manage_categories',
			    'assign_terms' => 'edit_posts'
			)
		)
	);
	*/
}
add_action( 'init', 'custom_taxonomy_init' );












