<?php 

/*** Includes ***/

include_once(dirname(__FILE__).'/acf/loader.php');

/*** Configurations ***/

add_theme_support('post-thumbnails');
add_post_type_support( 'member', 'thumbnail' );   

function add_custom_post_type() {
    $args = array(
		'public' => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'label'  => 'Members',
		'show_in_rest' => true,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt')
    );
    register_post_type( 'member', $args );
}
add_action( 'init', 'add_custom_post_type' );

//Disable wordpress 5 editor
//add_filter('use_block_editor_for_post', '__return_false', 10);

//Add HTML in post-edit page:
function wpdocs_register_meta_boxes(){
    add_meta_box( 
		'my-profile-image', 
		'Profile Image', 
		'my_profile_image_display_callback', 
		'member'
	);
}
add_action( 'add_meta_boxes', 'wpdocs_register_meta_boxes' );
function my_profile_image_display_callback($post){
	$member_id = $post->ID;
	$profile_image = trim( get_field('profile_image', $member_id) );
	if( $profile_image ){
		echo '<img style="border:1px solid #e2e4e7;" width="200" src="' . $profile_image . '" />';
	}
	else{
		echo '<img style="border:1px solid #e2e4e7;" width="200" src="https://www.ajactraining.org/wp-content/uploads/2019/09/image-placeholder.jpg" />';
	}
}

