#!/usr/bin/env php
<?php
require $_SERVER['PWD'] . '/.git/hooks/utils.php';

$cmd = 'cd deploy; phing migrate';

echo "$cmd\n";
exec($cmd, $output, $return);
if ($return != 0) {
	echo "WARNING: Database migration has failed\n";
	echo implode("\n", $output), "\n";
	exit(1);
}
