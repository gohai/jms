<?php

@require_once('config.inc.php');
require_once('jms.inc.php');

$query_string = (isset($_SERVER['QUERY_STRING'])) ? $_SERVER['QUERY_STRING'] : '';
$tmp = explode('&', $query_string);

if (substr($tmp[0], 0, 7) === 'object/') {
	/* show the work template if the parameter starts with "object/" */
	$name = get_name_from_url(substr($tmp[0], 7));
	if ($name === false) {
		/* url doesn't exist, show a 404 */
		serve_404();
	}
	echo generate_work($name);
} else if ($tmp[0] === 'browse') {
	/* show the browse template if the parameter is "browse" */
	echo generate_browse();
} else if (is_file('template-' . $tmp[0] . '.php')) {
	/* show any other static file (template) if it exists */
	echo run_template('template-' . $tmp[0] . '.php');
} else if (empty($tmp[0])) {
	/* if no parameter is given, show either the intro or browse */
	/* depending on a configuration setting */
	if (config('show_intro', true)) {
		echo run_template('template-intro.php');
	} else {
		echo generate_browse();
	}
} else {
	/* unknown parameter, show a 404 */
	serve_404();
}
