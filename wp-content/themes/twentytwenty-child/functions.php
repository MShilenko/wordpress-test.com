<?
// Register css
function twentytwenty_child_theme_styles() {
	wp_enqueue_style('parent-theme', get_template_directory_uri() .'/style.css'); //Parent theme style.css 
	//wp_enqueue_style('custom-theme', get_stylesheet_directory_uri() .'/custom.css'); //Child theme custom.css
}
add_action( 'wp_enqueue_scripts', 'twentytwenty_child_theme_styles' );

//Register keiwords in head area
register_meta( 'post, page', 'seo_keywords', [
	'type'              => 'string',
	'description'       => 'keywords',
	'single'            => true,
	'sanitize_callback' => function( $meta_value, $meta_key, $object_type ){
		return wp_strip_all_tags( $meta_value ); // delete html tags
	},
	'auth_callback'     => function( $false, $meta_key, $postID, $user_id, $cap, $caps ){
		// only admin can write
		return current_user_can('manage_options');
	},
	'show_in_rest'      => false,
] );

function addKeywords() {
	if($seo_keywords = get_metadata( get_post_type(), get_the_ID(), 'keywords', true )){
    	echo '<meta name="keywords" content="'. $seo_keywords .'" />';
	}
}
add_action ( 'wp_head', 'addKeywords' );