<?php
/**
 * The format for this array is:
 * 	branchnamepattern
 * 		git-hook
 *			script to run
 * 			OR
 *			script to run => halt on error
 *
 * the branch name pattern is optional, if you want one set of hooks for all branches
 * you can remove that level from the array.
 *
 * Anything else present in $config is ignored by the one-hook script, but can be
 * picked up by the individual scripts
 */
$config = array(
	'master' => array(),
	'develop' => array(),
	'feature/*' => array(),
	'release/*' => array(),
	'hotfix/*' => array(),
	'support/*' => array(),
	'*' => array(
		'pre-commit' => array(
			'php/lint.php' => true,
			'js/lint.php' => true,
			'php/phpcs.php',
			'php/phpunit.php',
			'images/optimize.php',
		),
		'prepare-commit-msg' => array(
			//'flow/commitMessageWarn.php'
		),
		'post-commit' => array(
			'misc/playSuccess',
		),
		'post-merge' => array(
			'php/lint.php',
			'js/lint.php'
		),
		'php' => array(
			'lint' => array(
				'pattern' => '/\.php$/'
			),
			'phpcs' => array(
				'-n' => true,
				'-s' => true,
				'--extensions' => 'php,ctp',
				'--encoding' => 'UTF-8',
				'--standard' => 'Cake',
				'--report-width' => trim(`tput cols`)
			)
		),
		'js' => array(
			'lint' => array(
				'pattern' => '/\.js$/'
			)
		)
	)
);
