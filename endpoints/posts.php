<?php

header('Content-Type: application/json');

$args = array(
	'posts_per_page'   => 9999,
	'offset'           => 0,
	'post_type'        => 'post',
	'post_status'      => 'publish',
	'orderby' => 'publish_date', 
	'order' => 'DESC'
);
$posts = get_posts( $args );

//var_dump($posts);die;

foreach($posts as $post){
	$object = new stdClass();
	$object->id = $post->ID;
	$object->slug = $post->post_name;
	$object->title = $post->post_title;
	$object->content = $post->post_content;
	$object->post_modified = $post->post_modified;
	$object->excerpt = mb_substr(get_the_excerpt($post->ID),0,225);
	$object->meta_title = get_field('title', $post->ID);
	$object->meta_description = get_field('description', $post->ID);
	$object->meta_keywords = get_field('keywords', $post->ID);
	$results[] = $object;
}

echo json_encode($results);