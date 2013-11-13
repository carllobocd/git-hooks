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

$config = $config['js']['lint'];
$status = 0;
$predef = "";

if(isset($config['predef'])) {
	if(is_array($config['predef'])) {
		foreach($config['predef'] as $pre) 
			$predef .= " --predef ".$pre;
	} else {
		$predef = "--predef ".$config['predef'];
	}
}

foreach ($tmp['files'] as $file) {
	if (!preg_match($config['pattern'], $file)) {
		continue;
	}

	$cmd = "jslint $predef " . escapeshellarg($file);
	$output = array();
	echo "$cmd\n";
	exec($cmd, $output, $return);
	if (count($output) > 0) {
		echo implode("\n", $output), "\n";
		$status = 1;
	}
}

exit($status);
