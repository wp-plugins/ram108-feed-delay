<?php
/*
Plugin Name: [ram108] Feed Delay
Plugin URI: http://wordpress.org/plugins/ram108-feed-delay/
Description: Delay posts from being appear in the RSS feed immediately after publication.
Version: 0.1
Author: ram108
Author URI: http://profiles.wordpress.org/ram108
Author Email: plugin@ram108.ru
License: GPL3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
===========================================================
Copyright 2015 by Kirill Borodin plugin@ram108.ru
http://www.ram108.ru/donate
OM SAI RAM
*/

function ram108_feed_delay( $where ) {

	if ( !is_feed() ) return $where;

	global $wpdb;

	$wait = 3;
	$unit = 'HOUR'; // MINUTE, HOUR, DAY, WEEK, MONTH, YEAR

	$now = gmdate('Y-m-d H:i:s');
	$where .= " AND TIMESTAMPDIFF( {$unit}, {$wpdb->posts}.post_date_gmt, '{$now}' ) > {$wait} ";

	return $where;
}

add_filter( 'posts_where', 'ram108_feed_delay' );
