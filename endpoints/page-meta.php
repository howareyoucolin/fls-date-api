<?php

$pagename = $matches[1];

header('Content-Type: application/json');

$post = get_page_by_title($pagename);

$result = new stdClass();
$result->title = get_field( 'title', $post->ID );
$result->description = get_field( 'description', $post->ID );
$result->keywords = get_field( 'keywords', $post->ID );

echo json_encode($result);