<?php

header('Content-Type: application/json');

$args = array(
	'posts_per_page'   => -1,
	'offset'           => 0,
	'post_type'        => 'member',
	'post_status'      => 'publish',
	'orderby'		   => 'ID',
	'order'			   => 'ASC',
);
$posts = get_posts( $args );

$results = array();

foreach($posts as $post){
	$object = new stdClass();
	$object->id = $post->ID;
	$object->title = $post->post_title;
	$object->content = $post->post_content;
	$object->post_modified = $post->post_modified;
	$object->excerpt = mb_substr(get_the_excerpt($post->ID),0,225);
	$object->profile = get_the_post_thumbnail_url( $post->ID, 'medium' );
	$object->status = get_field( 'status', $post->ID );
	$object->vip = get_field( 'vip', $post->ID );
	$object->vip_expiration = get_field( 'vip_expiration', $post->ID );
	$object->gender = get_field( 'gender', $post->ID );
	$object->dob = get_field( 'dob', $post->ID );
	$object->super_title = get_field( 'super_title', $post->ID );
	$object->intro = get_field( 'intro', $post->ID );
	$object->wechat = get_field( 'wechat', $post->ID );
	$object->phone = get_field( 'phone', $post->ID );
	$object->email = get_field( 'email', $post->ID );
	$object->award = get_field( 'award', $post->ID );
	$results[] = $object;
}

echo json_encode($results);