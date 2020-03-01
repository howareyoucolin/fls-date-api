<?php 

/*** Schema ***/
global $wpdb;
$wpdb->query("
	CREATE TABLE IF NOT EXISTS cz_signups (
		id int(11) NOT NULL auto_increment,
		content TEXT default '',
		PRIMARY KEY (id)
	)
");

/*** Includes ***/

include_once(dirname(__FILE__).'/acf/main.php');

/*** API Endpoints ***/

if($_SERVER['REQUEST_URI'] === '/posts'){
	include_once(dirname(__FILE__).'/endpoints/posts.php');
	exit(1);
}
elseif(preg_match('/^\/page-meta\/(\w+)$/', $_SERVER['REQUEST_URI'], $matches)){
	include_once(dirname(__FILE__).'/endpoints/page-meta.php');
	exit(1);
}
else if($_SERVER['REQUEST_URI'] === '/members'){
	include_once(dirname(__FILE__).'/endpoints/members.php');
	exit(1);
}
else if($_SERVER['REQUEST_URI'] === '/signup'){
	include_once(dirname(__FILE__).'/endpoints/signup.php');
	exit(1);
}
else if($_SERVER['REQUEST_URI'] === '/list'){
	include_once(dirname(__FILE__).'/endpoints/list.php');
	exit(1);
}
else if($_SERVER['REQUEST_URI'] === '/test'){
	include_once(dirname(__FILE__).'/test.php');
	exit(1);
}
else if($_SERVER['REQUEST_URI'] === '/long'){
	include_once(dirname(__FILE__).'/long.php');
	exit(1);
}

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

