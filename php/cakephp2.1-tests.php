#!/usr/bin/env php
<?php

require $_SERVER['PWD'] . '/.git/hooks/utils.php';

function getSUT($file) {
	if (!preg_match('@\.php$@', $file) || preg_match('@(Config|test_app)[\\\/]@', $file)) {
		return false;
	}

	if (preg_match('@Test[\\\/]@', $file)) {
		if (substr($file, -8) !== 'Test.php') {
			return false;
		}

		if (preg_match('@.*lib[\\\/]Cake[\\\/]@', $file)) {
			$file = preg_replace('@^(.*)Test([\\\/])Case[\\\/]@', '\1lib\2Cake\2', $file); // Untested
		} else {
			$file = preg_replace('@^(.*)Test[\\\/]Case[\\\/](.*)Test.php$@', '\1\2.php', $file);
		}
	}
	return $file;
}

$files = files();
$toTest = array();
$exit = 0;

foreach ($files as $file) {
	$file = getSUT($file);

	if (!$file) {
		continue;
	}
	$toTest[$file] = true;
}

if (file_exists('app/Console/cake')) {
	$prefix = 'cd app; Console/';
} elseif (file_exists('Console/cake')) {
	$prefix = 'Console/';
} else {
	$prefix = '';
}

foreach (array_keys($toTest) as $file) {
	$output = array();
	$cmd = "{$prefix}cake test $file --stderr 2>&1";
	echo "$cmd\n";
	exec($cmd, $output, $return);

	if ($return != 0) {
		echo implode("\n", $output), "\n";
		$exit = 1;
	}
}

exit($exit);
