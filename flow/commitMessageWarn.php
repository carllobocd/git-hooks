#!/usr/bin/env php
<?php

require $_SERVER['PWD'] . '/.git/hooks/utils.php';

$file = '.git/COMMIT_EDITMSG';
if (!empty($argv[1])) {
	$file = $argv[1];
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

if (in_array($currentBranch, array('master', 'brazil', 'india', 'indonesia', 'poland', 'turkey'))) {
	$commitMessage = file($file);
	array_unshift($commitMessage, "# YOU ARE ON $currentBranch\n# Committing to this branch requires authorization and you could be PENALIZED\n# I hope you know what you're doing\n\n");
	$commitMessage = implode($commitMessage);
	file_put_contents($file, $commitMessage);
}

if (file_exists('.git/MERGE_MSG') || file_exists('.git/SQUASH_MSG')) {
	return;
}

if (!$usingGitFlow) {
	return;
}

if (in_array($currentBranch, array('develop'))) {
	$commitMessage = file($file);
	array_unshift($commitMessage, "# YOU ARE ON $currentBranch - USE A FEATURE BRANCH\n\n");
	$commitMessage = implode($commitMessage);
	file_put_contents($file, $commitMessage);
}

