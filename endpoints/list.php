<?php

global $wpdb;

$results = $wpdb->get_results("
	SELECT * FROM cz_signups ORDER BY id DESC
");

foreach( $results as $result ){
	echo '<pre>';
	var_dump( json_decode($result->content) );
	echo '</pre>';
	echo '<hr>';
}