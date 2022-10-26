<?php
/**
 * @package word count
 */
/*
Plugin Name: world count
Plugin URI: https://uzzaldev.com
Description: Used by millions
Version: 1.0.0
Author: uzzal Barmon
Author URI: https://uzzaldev.com
License: GPLv2 or later
Text Domain: word-count
Domain Path: /languages/
*/

// function wordcount_activation_hook(){

// }
// register_activation_hook(_FILE_,"wordcount_activation_hook");

// function wordcount_deactivation_hook(){

// }
// register_deactivation_hook(_FILE_,"wordcount_deactivation_hook");

function wordcount_load_textdomain(){
	load_plugin_textdomain('word-count',false, dirname(__FILE__)."/languages");
}

add_action("plugins_loaded",'wordcount_load_textdomain');

function wordcount_count_word($content){

$stripped_content = strip_tags($content);
$wordn = str_word_count($stripped_content);
$label = __('Total Number of words','word-count');
$label = apply_filters("wordcount_heading",$label);
$tag   = apply_filters("wordcount_tag",'h2');
$content .=sprintf('<%s>%s: %s</%s>',$tag,$label,$wordn,$tag);
return $content;

}
add_filter("the_content",'wordcount_count_word');


function wordcount_reading_time($content){
	$stripped_content = strip_tags($content);
	$wordn = str_word_count($stripped_content);
	$reding_minute = floor($wordn/200);
	$reding_seconds = floor($wordn %200 / (200/60));
	$is_visible = apply_filters('wordcount_display_readingtime',1);
	if ($is_visible) {
		$label = __('Total reading Time of words','word-count');
		$label = apply_filters("wordcount_readingtime_heading",$label);
		$tag   = apply_filters("wordcount_reading_tag",'h4');
		$content .=sprintf('<%s>%s:minute of %s seconds %s</%s>',$tag,$label,$reding_minute, $reding_seconds, $tag);
	}

	return $content;
}

add_filter("the_content",'wordcount_reading_time');