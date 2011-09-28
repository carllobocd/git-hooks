#!/usr/bin/env php
<?php
require $_SERVER['PWD'] . '/.git/hooks/utils.php';
$config = config();

$files = files();
$tmp = copyFiles($files);
if (!is_dir($tmp['dir'])) {
	echo "{$tmp['dir']} doesn't exist, nothing to do\n";
	exit(0);
}

$args = $config['php']['phpcs'];
foreach($args as $key => &$value) {
	if ($value === true) {
		$value = "$key";
	} else {
		$value = "$key=$value";
	}
}

$cmd = "phpcs " . implode($args, ' ') . " " . escapeshellarg($tmp['dir']);
echo "$cmd\n";
exec($cmd, $output, $return);
if ($return != 0) {
    $output = str_replace($tmp['dir'] . '/', '', $output);
	echo implode("\n", $output), "\n";
	exit(1);
}
