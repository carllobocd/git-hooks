#!/usr/bin/env php
<?php

require $_SERVER['PWD'] . '/.git/hooks/utils.php';
$config = config();

$files = files();
$tmp = copyFiles($files);

if ($tmp['dir'] && !is_dir($tmp['dir'])) {
	echo "{$tmp['dir']} doesn't exist, nothing to do\n";
	exit(0);
}

$config = $config['php']['lint'];

$status = 0;

foreach ($tmp['files'] as $file) {
	if (!preg_match($config['pattern'], $file)) {
		continue;
	}

	$cmd = "php -l " . escapeshellarg($file);
	$output = array();
	echo "$cmd\n";
	exec($cmd, $output, $return);
	if ($return != 0) {
		echo implode("\n", $output), "\n";
		$status = 1;
	}
}

exit($status);
