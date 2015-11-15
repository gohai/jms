<?php

@require_once('config.inc.php');

function content_dir() {
	return rtrim(config('content_dir', 'JODI'), '/');
}

function format_class($s) {
	$s = strtolower($s);
	$s = str_replace(' ', '-', $s);
	$s = str_replace('&', '', $s);
	return $s;
}

function generate_browse() {
	$data = array();
	foreach (list_works() as $name) {
		$work = load_work($name);
		if ($work === false) {
			continue;
		}
		$data[] = $work;
	}
	return run_template('template-browse.php', $data);
}

function generate_work($name) {
	$data = load_work($name);
	if ($data === false) {
		return '';
	}
	return run_template('template-work.php', $data);
}

function get_name_from_url($url) {
	$names = list_works();
	foreach ($names as $name) {
		// same transformations as in get_url_from_name
		$transformed = strtolower($name);
		$transformed = str_replace(' ', '-', $transformed);
		$transformed = str_replace('?', '', $transformed);
		$transformed = str_replace('&', '', $transformed);
		if ($transformed === $url) {
			return $name;
		}
	}
	// not found
	return false;
}

function get_url_from_name($name) {
	$name = strtolower($name);
	$name = str_replace(' ', '-', $name);
	$name = str_replace('?', '', $name);
	$name = str_replace('&', '', $name);
	return 'index.php?object/' . $name;
}

function get_work_name_from_title($title) {
	$names = list_works();
	foreach ($names as $name) {
		$work = load_work($name);
		if ($work === false) {
			continue;
		}
		if (isset($work['title']) && $title === $work['title']) {
			return $name;
		}
	}
	return false;
}

function list_works() {
	$fns = @scandir(content_dir());
	if (!is_array($fns)) {
		$fns = array();
	}
	for ($i=0; $i < count($fns); $i++) {
		if (in_array($fns[$i], array('.', '..')) ||
			substr($fns[$i], 0, 1) == '_') {
				array_splice($fns, $i, 1);
				$i--;
		}
	}
	return $fns;
}

function load_work($name, $resolve_references = true) {
	$s = @file_get_contents(content_dir() . '/' . $name . '/meta.txt');
	if ($s === false) {
		return false;
	}

	$work = @json_decode($s, true);
	if (is_null($work)) {
		// be vocal about error
		echo 'Error decoding ' . $name . '/meta.txt';
		if (function_exists(json_last_error_msg())) {
			echo ': ' . json_last_error_msg();
		}
		echo '. Try validating the file with http://jsonlint.com/.';
		exit(1);
	} else if (!is_array($work)) {
		echo 'Error decoding ' . $name . '/meta.txt: Not an object.';
		exit(2);
	}

	/* set name */
	$work['name'] = $name;

	/* set description */
	$s = @file_get_contents(content_dir() . '/' . $name . '/description.html');
	if ($s !== false) {
		$work['description'] = $s;
	} else {
		$work['description'] = '';
	}

	/* normalize all other fields */
	$work = normalize_work($work, $resolve_references);

	return $work;
}

function normalize_work($work, $resolve_references = true) {
	/* handle "materials" */
	if (!@is_array($work['materials'])) {
		$work['materials'] = array();
	}

	/* handle "reference" */
	if (!@is_array($work['reference'])) {
		$work['reference'] = array();
	}
	if ($resolve_references) {
		$resolved = array();
		foreach ($work['reference'] as $reference) {
			// get title for each reference
			$referenced = load_work($reference, false);
			if ($referenced === false) {
				// reference not found
				continue;
			}
			$resolved[] = array(
				'name' => $reference,
				'title' => $referenced['title'],
				'url' => get_url_from_name($reference)
			);
		}
		$work['reference'] = $resolved;
	}

	/* handle "sortYear" */
	if (!isset($work['sortYear'])) {
		echo 'Field sortYear is not set in ' . $work['name'] . '/meta.txt';
		exit(3);
	} else if ($work['sortYear'] === 'ongoing') {
		// add one to the current year, so that "ongoing" works are always most recent
		$work['sortYear'] = intval(date('Y'))+1;
	} else {
		// force integer
		$work['sortYear'] = intval($work['sortYear']);
	}

	/* handle "title" */
	if (!@is_string($work['title'])) {
		$work['title'] = $work['name'];
	}

	/* handle "type" */
	if (!@is_string($work['type'])) {
		echo 'Field type is not set in ' . $work['name'] . '/meta.txt';
		exit(4);
	}

	/* handle "url_work" */
	if (!@is_array($work['url_work'])) {
		$work['url_work'] = array();
	}

	/* handle "year" */
	if (!@is_string($work['year'])) {
		$work['year'] = '';
	}

	return $work;
}

function run_template($fn, $data = array()) {
	@ob_start();
	@include($fn);
	$ret = @ob_get_contents();
	@ob_end_clean();
	return $ret;
}

function serve_404() {
	@header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
	if (is_file('template-404.php')) {
		echo run_template('template-404.php');
	}
	exit(3);
}
