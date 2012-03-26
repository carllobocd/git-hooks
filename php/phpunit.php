#!/usr/bin/env php
<?php
/**
 * A generic PHPUnit test hook
 *
 * Will recurse up the path of a file looking for a test file matching the current file if it does
 * not find a specific test file - it will run all tests in whatever is the nearest test suite it
 * can identify.
 *
 * Example: the file edited is one/two/three/four/five/File.php. This hook will check the following
 * paths for a test file (tests dir, and .test.php files ommitted for berevity):
 *
 *      one/two/three/four/five/FileTest.php
 *      one/two/three/four/five/Tests/FileTest.php
 *      one/two/three/four/Tests/five/FileTest.php
 *      one/two/three/Tests/four/five/FileTest.php
 *      one/two/Tests/three/four/five/FileTest.php
 *      one/Tests/two/three/four/five/FileTest.php
 *      Tests/one/two/three/four/five/FileTest.php
 *
 * If none of those files exist, but for example these test folders exist:
 *      one/two/Tests
 *      Tests
 *
 * The most specific test suite will be run in its entirety instead, in this case `one/two/Tests`
 *
 */
require $_SERVER['PWD'] . '/.git/hooks/utils.php';

$alreadyRan = array();
$files = files();

$testDirs = array('tests', 'Tests', 'test', 'Test');
$suffixes = array('.test.php', 'Test.php');
$status = 0;

foreach ($files as $file) {
	if (!preg_match('@\.php$@', $file)) {
		continue;
	}
	if (preg_match('@(?:\.test|Test)\.php$@', $file)) {
		$test = $file;
	} else {
		$test = null;
		$path = explode(DIRECTORY_SEPARATOR, $file);
		$filename = array_pop($path);
		$originalPath = implode('/', $path) . '/';
		$allPathsChecked = array();

		foreach($suffixes as $suffix) {
			$testFile = substr($filename, 0, -4) . $suffix;
			$test = $originalPath . $testFile;
			$allPathsChecked[] = $test;
			if (file_exists($test)) {
				break 2;
			}
		}

		$testRoots = array();
		$testPaths = array();

		for($i = count($path); $i >= 0; $i--) {

			foreach($testDirs as $dir) {
				$testPath = $path;

				$root = implode('/', array_slice($testPath, 0, $i));
				if ($root) {
					$root .= '/';
				}
				$root .= $dir . '/';
				$testRoots[] = $root;

				array_splice($testPath, $i, 0, $dir);
				$testPaths[] = implode('/', $testPath) . '/';
			}
		}

		$testRoots = array_filter($testRoots, 'is_dir');
		$testPaths = array_filter($testPaths, 'is_dir');

		foreach($testPaths as $testPath) {
			foreach($suffixes as $suffix) {
				$testFile = substr($filename, 0, -4) . $suffix;
				$test = $testPath . $testFile;
				$allPathsChecked[] = $test;
				if (file_exists($test)) {
					break 2;
				}
			}
		}
	}

	if (in_array($test, $alreadyRan)) {
		continue;
	}

	if (!$test || !file_exists($test)) {
		if (!$testRoots) {
			continue;
		}
		$test = rtrim(array_pop($testRoots), '/');
	}

	$cmd = "phpunit --stop-on-failure " . escapeshellarg($test);
	$output = array();
	echo "$cmd\n";
	exec($cmd, $output, $return);
	if ($return != 0) {
		echo implode("\n", $output), "\n";
		$status = 1;
	}
	$alreadyRan[] = $test;
}

exit($status);
