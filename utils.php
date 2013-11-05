<?php

/**
 * Finds the config for the current branch.
 *
 * config.php can either contain a $config array to be directly used, or an array of $config arrays
 * indexed by branch name/pattern. If there exists the array key pre-commit, it is assumed that a
 * 1 dimensional config array has been specified in the config variable. Otherwise, loop on all
 * defined configs, and return the merged/combined config for the current branch.
 *
 * @param mixed $branch
 * @access public
 * @return array()
 */
function config($branch = null) {
	if (!$branch) {
		$branch = trim(`git symbolic-ref --short -q HEAD`);
	}
	require '.git/hooks/config.php';

	if (!empty($config['pre-commit'])) {
		return $config;
	}

	$return = array();

	foreach ($config as $pattern => $c) {
		$pattern = str_replace('*', '.*', $pattern);
		if (preg_match("@$pattern@", $branch)) {
			$return += $c;
		}
	}

	return $return;
}

/**
 * Returns an array of updated references
 *
 * pre-receive and post-receive are passed on standard input
 *    rev-old rev-new ref
 *    xxxxxxx yyyyyyy refs/heads/master
 *
 * The update receives as positional args:
 *    ref rev-old rev-new
 *
 * Normalizes these outputs and returns an array of
 *    rev-old rev-new ref
 */
function updatedRefs() {
	global $argv;

	if (count($argv) === 4) {
		return array(
			array(
				$argv[2],
				$argv[3],
				$argv[1]
			)
		);
	}

	$return = file("php://stdin");
	foreach ($return as &$string) {
		$string = explode(trim($string), ' ');
	}
	return $return;
}

/**
 * Return an array of relative file paths for files contained in the commit
 *
 * If the file doesn't exist - it's stripped from the returned list of files
 *
 * If called outside the context of a git hook, return all files
 *
 */
function files() {
	if (!empty($_SERVER['argv'][1])) {
		$files = $_SERVER['argv'];
		array_shift($files);

		$break = false;
		foreach ($files as $file) {
			if (!is_file($file)) {
				$break = true;
				break;
			}
		}

		if (!$break) {
			return $files;
		}
	}
	if (!trim(`echo \$GIT_DIR`) && !trim(`echo \$GIT_AUTHOR_NAME`)) {
		$where = '.';
		$locations = func_get_args();
		if (!$locations) {
			$locations = $_SERVER['argv'];
			array_shift($locations);
		}
		if ($locations) {
			$where = implode($locations, ' ');
		}
		exec("find $where -type f ! -name '*~' ! -wholename '*.git/*' ! -wholename '*/tmp/*'", $output);
		foreach ($output as $i => &$file) {
			if (in_array($i, array('.', '..'))) {
				unset ($output[$i]);
				continue;
			}
			$file = preg_replace('@^\./@', '', $file);
		}
		sort($output);
		return array_filter($output);
	}

	exec('git rev-parse --verify HEAD 2> /dev/null', $output, $return);
	if ($return === 0) {
		$against = 'HEAD';
	} else {
		$against = '4b825dc642cb6eb9a060e54bf8d69288fbee4904';
	}

	$output = array();
	exec("git diff-index --cached --name-only $against", $output);

	if (!$output && $against === 'HEAD') {
		exec("git diff-index --cached --name-only HEAD^", $output);
	}

	return array_filter($output, 'file_exists');
}

/**
 * Return an array of absolute file paths to copies of files contained in the commit
 * A copy is useful to ignore unstage changes
 *
 */
function copyFiles($files, $name = null) {
	if (!$name) {
		$name = trim(basename($_SERVER['PWD']));
	}

	$tmpDir = "/tmp/$name-git-hooks";

	$return = array(
		'dir' => $tmpDir,
		'files' => array()
	);

	foreach ($files as $i => $file) {
		if (!file_exists($file)) {
			unset($files[$i]);
			continue;
		}
		$return['files'][] = "$tmpDir/$file";
	}
	if (
		file_exists("/$tmpDir.lock") &&
		is_dir($tmpDir) &&
		(filemtime($tmpDir) >= filemtime("$tmpDir.lock"))
	) {
		return $return;
	}

	`rm -rf $tmpDir`;

	foreach ($files as $file) {
		$dir = dirname($file);
		$dir = ($dir === '.') ? '' : $dir;

		if (!is_dir("$tmpDir/$dir")) {
 			echo `mkdir -p $tmpDir/$dir`;
		}

		$file = escapeshellarg($file);

		if (!trim(`echo \$GIT_DIR`) && !trim(`echo \$GIT_AUTHOR_NAME`)) {
			`cp $file $tmpDir/$file`;
		} else {
			$blob = trim(`git diff-index --cached HEAD $file | cut -d " " -f4`);
			if ($blob) {
				`git cat-file blob $blob > $tmpDir/$file`;
			} else { // Probably a merge, there is no cached file
				`git show HEAD:$file > $tmpDir/$file`;
			}
		}
	}

	return $return;
}
