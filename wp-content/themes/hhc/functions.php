<?php

// enqueue scripts and styles
function my_enqueue_scripts() {

	// map scripts
	wp_register_script( 'google-maps-js', 'https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyCuVaINYFmfBzecJ-9MvWwCsnWARgQQi8Y', array('jquery') );
	wp_enqueue_script( 'google-maps-js' );
	wp_register_script( 'map-style-js', get_stylesheet_directory_uri() . '/js/mapStyle.js', array('jquery') );
	wp_enqueue_script( 'map-style-js' );
	wp_register_script( 'map-js', get_stylesheet_directory_uri() . '/js/map.js', array('jquery') );
	wp_enqueue_script( 'map-js' );	

	// general scripts
	wp_register_script( 'slides-plugins', get_stylesheet_directory_uri() . '/js/plugins.js', array('jquery'), '5.5.0', true );
	wp_enqueue_script( 'slides-plugins' );	
	wp_register_script( 'slides', get_stylesheet_directory_uri() . '/js/slides.min.js', array('jquery'), '5.5.0', true );
	wp_enqueue_script( 'slides' );	
	wp_register_script( 'main', get_stylesheet_directory_uri() . '/js/main.js', array('jquery'), '5.5.0', true );
	wp_enqueue_script( 'main' );	

	// stylesheets
	wp_enqueue_style( 'default', get_stylesheet_uri() );
	wp_register_style( 'slides', get_template_directory_uri() . '/css/slides.min.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'slides' );
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


// fixes title tag for custom homepage
add_filter( 'wp_title', 'baw_hack_wp_title_for_home' );
function baw_hack_wp_title_for_home( $title ) {
	if (empty($title) || is_home() || is_front_page()) $title = "Home | " . get_bloginfo( 'name' );
	return $title;
}


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


// add title tag to wp_header output
add_theme_support( 'title-tag' );


// set max content width
if (!isset($content_width)) $content_width = 900;


// add excerpts to pages
function my_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'my_add_excerpts_to_pages' );


// add stylesheet for WYSIWYG editor
function my_theme_add_editor_styles() {
    add_editor_style( 'css/editor-style.css' );
}
add_action( 'admin_init', 'my_theme_add_editor_styles' );


// create custom post types
function addCPTs() {

	// slides
	$cpt_args = array(
		'menu_icon' => '',
		'label'	=> __('Slides'),
		'singular_label' =>	__('Slide'),
		'public'	=>	true,
		'show_ui'	=>	true,
		'taxonomies'  => array( 'category' ),
		'capability_type'	=>	'post',
		'hierarchical'	=>	false,
		'rewrite'	=>	true,
		'supports'	=>	array('title', 'thumbnail', 'editor', 'excerpt')
		);
	register_post_type('slide', $cpt_args);

	// blog
	$cpt_args = array(
		'menu_icon' => '',
		'label'	=> __('Blog'),
		'singular_label' =>	__('Blog Article'),
		'public'	=>	true,
		'show_ui'	=>	true,
		'taxonomies'  => array( 'category' ),
		'capability_type'	=>	'post',
		'hierarchical'	=>	false,
		'rewrite'	=>	true,
		'supports'	=>	array('title', 'thumbnail', 'editor', 'excerpt')
		);
	register_post_type('blog-article', $cpt_args);

	// partners
	$cpt_args = array(
		'menu_icon' => '',
		'label'	=> __('Partners'),
		'singular_label' =>	__('Partner'),
		'public'	=>	true,
		'show_ui'	=>	true,
		'taxonomies'  => array( 'category' ),
		'capability_type'	=>	'post',
		'hierarchical'	=>	false,
		'rewrite'	=>	true,
		'supports'	=>	array('title')
		);
	register_post_type('partner', $cpt_args);

	// global contacts
	$cpt_args = array(
		'menu_icon' => '',
		'label'	=> __('Global Contacts'),
		'singular_label' =>	__('Global Contact'),
		'public'	=>	true,
		'show_ui'	=>	true,
		'taxonomies'  => array( 'category' ),
		'capability_type'	=>	'post',
		'hierarchical'	=>	false,
		'rewrite'	=>	true,
		'supports'	=>	array('title', 'thumbnail', 'editor', 'excerpt')
		);
	register_post_type('global-contact', $cpt_args);

	// jobs
	$cpt_args = array(
		'menu_icon' => '',
		'label'	=> __('Jobs'),
		'singular_label' =>	__('Job'),
		'public'	=>	true,
		'show_ui'	=>	true,
		'taxonomies'  => array( 'category' ),
		'capability_type'	=>	'post',
		'hierarchical'	=>	false,
		'rewrite'	=>	true,
		'supports'	=>	array('title', 'thumbnail', 'editor', 'excerpt')
		);
	register_post_type('job', $cpt_args);

	// downloads
	$cpt_args = array(
		'menu_icon' => '',
		'label'	=> __('Downloads'),
		'singular_label' =>	__('Download'),
		'public'	=>	true,
		'show_ui'	=>	true,
		'taxonomies'  => array( 'category' ),
		'capability_type'	=>	'post',
		'hierarchical'	=>	false,
		'rewrite'	=>	true,
		'supports'	=>	array('title', 'excerpt')
		);
	register_post_type('download', $cpt_args);

	// points of interest
	$cpt_args = array(
		'menu_icon' => '',
		'label'	=> __('POIs'),
		'singular_label' =>	__('POI'),
		'public'	=>	true,
		'show_ui'	=>	true,
		'capability_type'	=>	'post',
		'hierarchical'	=>	false,
		'rewrite'	=>	true,
		'exclude_from_search'	=>	true,
		'supports'	=>	array('title', 'thumbnail', 'editor')
		);
	register_post_type('poi', $cpt_args);

}
add_action('init', 'addCPTs');
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 140, 75, true );


// customise admin menu icons (https://developer.wordpress.org/resource/dashicons/)
function add_menu_icons_styles() {
	?>
		<style>
			#adminmenu .menu-icon-slide div.wp-menu-image:before { content: '\f161'; }
			#adminmenu .menu-icon-blog-article div.wp-menu-image:before { content: '\f109'; }
			#adminmenu .menu-icon-partner div.wp-menu-image:before { content: '\f338'; }
			#adminmenu .menu-icon-global-contact div.wp-menu-image:before { content: '\f319'; }
			#adminmenu .menu-icon-job div.wp-menu-image:before { content: '\f337'; }
			#adminmenu .menu-icon-download div.wp-menu-image:before { content: '\f316'; }
			#adminmenu .menu-icon-poi div.wp-menu-image:before { content: '\f319'; }
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



// remove editor support from pages
function hide_editor() {
    remove_post_type_support('page', 'editor');
}
add_action( 'admin_init', 'hide_editor' );

// hide featured image and page attributes from pages
function remove_thumbnail_box() {
    remove_meta_box( 'postimagediv','page','side' );
    remove_meta_box('pageparentdiv', 'page', 'side');
}
add_action('do_meta_boxes', 'remove_thumbnail_box');

// enqueue admin stylesheet
function add_my_admin_scripts() {
    wp_enqueue_style( 'acf_styles', get_template_directory_uri() . '/css/acf.css');
}
add_action( 'admin_enqueue_scripts', 'add_my_admin_scripts');


// enhance PDF links
if ( !function_exists('customise_pdf_embed') ) :
    function customise_pdf_embed( $html, $id ) {
        $attachment = get_post( $id );
        $mime_type = $attachment->post_mime_type;

        if ($mime_type == 'application/pdf') {
            $src = wp_get_attachment_url($id);

            $att[] = wp_prepare_attachment_for_js($id);
            $title = $att[0]['title'];
            $caption = $att[0]['caption'];

            $html = 
            	'<div class="media-link">' .
            		'<a href="'. $src . '">Download ' . $title . '</a>' .
            		'<div class="media-caption">' . $caption . '</div>' .
            	'</div>';
        }
        return $html;
	}
endif;
add_filter('media_send_to_editor', 'customise_pdf_embed', 20, 3);



// Callback function to insert 'styleselect' into the $buttons array
function my_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
add_filter('mce_buttons_2', 'my_mce_buttons_2');

// Callback function to filter the MCE settings
function my_mce_before_init_insert_formats( $init_array ) {  
    $style_formats = array(
        array(  
            'title' => 'CTA',  
            'selector' => 'a',  
            'classes' => 'button'             
        )
    );  
    $init_array['style_formats'] = json_encode( $style_formats );  
    return $init_array;  
} 
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );





/* customise admin columns */
function my_post_columns($columns) {
	$columns = array(
		'cb'	 	=> '<input type="checkbox" />',
		'title' 	=> 'Title',
		'categories'	=>	'Categories',
		'slide_type'	=>	'Slide Type',
		'date'		=>	'Date',
	);
	return $columns;
}
function my_custom_columns($column) {
	global $post;
	if ($column == 'slide_type') echo get_field('slide_type', $post->ID);
}
add_action("manage_posts_custom_column", "my_custom_columns");
add_filter("manage_edit-slide_columns", "my_post_columns");

/* add sort functionality */
// function my_column_register_sortable( $columns ) {
// 	$columns['slide_type'] = 'slide_type';
// 	return $columns;
// }
// add_filter("manage_edit-slide_sortable_columns", "my_column_register_sortable" );



function remove_admin_menu_items() {
   //remove_menu_page('index.php');
   remove_menu_page('edit.php');
   //remove_menu_page('upload.php');
   remove_menu_page('edit-comments.php');
   //remove_menu_page('themes.php');
   //remove_menu_page('plugins.php');
   //remove_menu_page('tools.php');
   //remove_menu_page('users.php');
   //remove_menu_page('options-general.php');
}
add_action( 'admin_menu', 'remove_admin_menu_items' );

function style_backend() {
   // echo '
   // <style>
   //     #toplevel_page_edit-post_type-acf {
   //         display: none;
   //     }
   // </style>
   // ';
}
add_action( 'admin_head', 'style_backend' );


// make a string valid for use as an HTML ID attribute
function htmlID($string) {
    //Lower case everything
    $string = strtolower($string);
    //Make alphanumeric (removes all other characters)
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    //Clean up multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);
    //Convert whitespaces and underscore to dash
    $string = preg_replace("/[\s_]/", "-", $string);
    return $string;
}












/*****************************************************
******************************************************
****											  ****
****											  ****
****					AJAX 					  ****
****											  ****
****											  ****
******************************************************
*****************************************************/

add_action( 'wp_ajax_look_up_pois', 'look_up_pois' );
add_action( 'wp_ajax_nopriv_look_up_pois', 'look_up_pois' );
function look_up_pois() {

	// define variables
	global $wpdb;
	global $wp_query;

	// build query
	$args = array('post_type' => array('poi'), 'posts_per_page' => -1);

	// run the query
	$wp_query = new WP_Query($args);
	if( have_posts()) {
	    while ( have_posts()) {

			$post = the_post();

			// get POI data
			$poi_id = get_the_ID();
			$poi_name = get_the_title();
			$lat = get_field('latitude');
			$long = get_field('longitude');
			$json_pois[] = array(
				'poi_name' => $poi_name,
				'poi_id' => $poi_id, 
				'poi_lat' => $lat, 
				'poi_long' => $long
			);
	    }
	}

    echo json_encode($json_pois);
	die();
}









