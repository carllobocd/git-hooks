#!/usr/bin/env php
<?php
require $_SERVER['PWD'] . '/.git/hooks/utils.php';

$files = files();
$tmp = copyFiles($files);
if (!is_dir($tmp['dir'])) {
	echo "{$tmp['dir']} doesn't exist, nothing to do\n";
	exit(0);
}

$config = config();
$args = $config['php']['phpcpd'];
$cmdline = array();

foreach ($args as $key => &$value) {
	if($key == "exclude") {
		foreach($value as $exclude) 
			$cmdline[] = "--exclude ".$exclude;
		continue;
	}
	if($key == "names") {
		$cmdline[] = "--names ".implode($value, ",");
		continue;
	}

	if ($value === true) {
		$cmdline[] = "--$key";
	} else {
		$cmdline[] = "--$key $value";
	}
}

$cmd = "phpcpd " . implode($cmdline, ' ') . " " . escapeshellarg($tmp['dir']);
echo "$cmd\n";
exec($cmd, $output, $return);
if ($return != 0) {
	$output = str_replace($tmp['dir'] . '/', '', $output);
	echo implode("\n", $output), "\n";
	exit(1);
}
