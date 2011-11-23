#!/usr/bin/env php
<?php

require $_SERVER['PWD'] . '/.git/hooks/utils.php';

$file = '.git/COMMIT_EDITMSG';
if (!empty($argv[1])) {
	$file = $argv[1];
}

if (strpos($file, 'MERGE') !== false || strpos($file, 'SQUASH') !== false) {
	return;
}

exec('git branch', $branches);

$currentBranch = '';
$usingGitFlow = false;
foreach($branches as $branch) {
	if (strpos($branch, 'develop') !== false) {
		$usingGitFlow = true;
	}
	if (strpos($branch, '*') === 0) {
		$currentBranch = substr($branch, 2);
	}
}

if (!$usingGitFlow) {
	return;
}

if (in_array($currentBranch, array('develop', 'master'))) {
	$commitMessage = file($file);
	array_unshift($commitMessage, "# YOU ARE ON $currentBranch - USE A FEATURE BRANCH\n\n");
	$commitMessage = implode($commitMessage);
	file_put_contents($file, $commitMessage);
}
