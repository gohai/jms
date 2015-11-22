<?php

/*
 * Don't modify configuration values in this file, as it will be
 * overwritten by updates. Instead, create a new file named
 * user_config.inc.php in the same directory, and use it to set
 * values in the same manner as it done here.
 */

$config = array();


// show errors (might be good to disable for release)
error_reporting(E_ALL);

// path to store content
$config['content_dir'] = 'JODI';
// desired sort order and descriptions for media categories (work subfolders)
$config['media_categories'] = array(
	'artwork' => 'Artwork',
	'exhibitionview' => 'Exhibition view',
	'ephemera' => 'Ephemera'
);
// show intro page
$config['show_intro'] = true;


// Overwrites
@include('user_config.inc.php');

/**
 *	Return the value of a configuration option
 *	@param $key configuration option
 *	@param $default default value to return if option is not set
 *	@return value
 */
function config($key, $default = false) {
	global $config;
	if (isset($config[$key])) {
		return $config[$key];
	} else {
		return $default;
	}
}
