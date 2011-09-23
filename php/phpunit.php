#!/usr/bin/env php
<?php

require $_SERVER['PWD'] . '/.git/hooks/utils.php';

$files = files();

$status = 0;

foreach ($files as $file) {
	if (!preg_match('@\.php$@', $file)) {
		continue;
	}
	if (preg_match('@(?:\.test|Test)\.php$@', $file)) {
		$test = $file;
	} else {
		$test = preg_replace('@\.php$@', '.test.php', $file);
		if (!file_exists($test)) {
			$test = 'tests/' . preg_replace('@\.php$@', 'Test.php', $file);
			if (!file_exists($test)) {
				continue;
			}
		}
	}

	if (!file_exists($test)) {
		continue;
	}

	$cmd = "phpunit --stop-on-failure " . escapeshellarg($test);
	$output = array();
	echo "$cmd\n";
	exec($cmd, $output, $return);
	if ($return != 0) {
		echo implode("\n", $output), "\n";
		$status = 1;
	}
}

exit($status);
