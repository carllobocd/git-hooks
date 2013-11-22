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

$releaseBranches = array(
	'pre-commit' => array(
		'php/lint.php' => true,
		'js/lint.php' => true,
		'php/phpcs.php' => true,
		'images/optimize.php' => true,
		'php/phpcpd.php' => true,
		//'php/phpunit.php',
	),
	'post-commit' => array(
		'misc/playSuccess',
	),
);

$developBranches = array(
	'pre-commit' => array(
		'php/lint.php' => true,
		'js/lint.php' => true,
	),
);

$config = array(
	'master' => array(
             'pre-commit' => array(
		'js/minify.php' => true,
             )
	),
	'brazil' => array(),
	'india' => array(),
	'indonesia' => array(),
	'poland' => array(),
	'turkey' => array(),
	'develop' => $releaseBranches,
	'feature/*' => $developBranches,
	'release/*' => $releaseBranches,
	'hotfix/*' => $developBranches,
	'support/*' => $developBranches,
	'*' => array(
		'prepare-commit-msg' => array(
				'flow/commitMessageWarn.php'
		),
		'post-merge' => array(
				'db/dbdeploy.php'
		),
		'php' => array(
			'lint' => array(
				'pattern' => '/\.php$/'
			),
			'phpcpd' => array(
				'exclude' => array(
					'classes/facebook-php-sdk',
					'classes/PHPMailer',
					'classes/PHPExcel',
					'classes/DB',
					'classes/DB.php',
				)
			),
			'phpcs' => array(
				'-n' => true,
				'-s' => true,
				'--extensions' => 'php,ctp,js,css',
				'--encoding' => 'UTF-8',
				'--standard' => '.git/hooks/standard/ruleset.xml',
				'--report-width' => 80 
			)
		),
		'js' => array(
			'lint' => array(
				'pattern' => '/\.js$/',
				'predef' => array(
					'\'$\'',
					'document',
				)
			),
			'minify' => array(
				'pattern' => '/\.js$/',
			)
		)
	)
);
