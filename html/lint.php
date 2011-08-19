#!/usr/bin/env php
<?php

require $_SERVER['PWD'] . '/.git/hooks/utils.php';

$files = files();
$tmp = copyFiles($files);

if (empty($tmp['files'])) {
	echo "No files to check\n";
	exit(0);
}
if ($tmp['dir'] && !is_dir($tmp['dir'])) {
	echo "{$tmp['dir']} doesn't exist, nothing to do\n";
	exit(0);
}

$status = 0;

foreach ($tmp['files'] as $file) {
	if (!preg_match('@\.htm?l$@', $file)) {
		continue;
	}

	$cmd = "tidy -e -q -utf8 " . escapeshellarg($file);
	$output = array();
	echo "$cmd\n";
	exec($cmd, $output, $return);
	if ($return) {
		echo implode("\n", $output), "\n";
		$status = 1;
	}
}

exit($status);
