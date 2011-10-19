#!/usr/bin/env php
<?php

require $_SERVER['PWD'] . '/.git/hooks/utils.php';

function testFile($file) {
	if (!preg_match('@\.php$@', $file) || preg_match('@(Config|test_app)[\\\/]@', $file)) {
		return false;
	}
	if (preg_match('@Test[\\\/]@', $file)) {
		if (!preg_match('@\Test\.php$@', $file)) {
			return false;
		}
		$file = str_replace('Test.php', '.php', $file);

		if (preg_match('@.*lib[\\\/]Cake[\\\/]@', $file)) {
			return preg_replace('@.*Test[\\\/]Case[\\\/]@', 'lib' . DIRECTORY_SEPARATOR . 'Cake' . DIRECTORY_SEPARATOR, $file);
		}
		return preg_replace('@.*Test[\\\/]Case[\\\/]@', '', $file);
	}
	return $file;
}

$files = files();
$toTest = array();
$exit = 0;

foreach ($files as $file) {
	$file = testFile($file);

	if (!$file) {
		continue;
	}
	$toTest[$file] = true;
}

if (file_exists('app/Console/cake')) {
	$prefix = 'app/Console/';
} elseif (file_exists('Console/cake')) {
	$prefix = 'Console/';
} else {
	$prefix = '';
}

foreach($toTest as $file => $_) {
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
