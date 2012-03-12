# Git hooks. ![Project status](http://stillmaintained.com/AD7six/git-hooks.png?20120106)

Various git hooks, mix and match however you want on a project by project (and even branch by
branch) basis.


# Install

Installing this repo is comprised of two steps.

1) Installing the git-hooks command

	cd this/repo
	make install

OR manually symlink the script git-hooks into any folder within your path
OR include this repo in your path

2) Using on any project

	cd /any/project/you/like
	git hooks install

This will symlink the commands you might want to use into your .git/hooks folder, link all git
hooks to the one-hook file, and create a config file which you can use to customize how the hooks
work for each project

#Getting hooked, pre-commit

The most common hook is the `pre-commit` hook; a hook which is triggered immediately before you
commit code to a repository. Why would you use a `pre-commit` hook, well, have you ever accidentally
committed a blatant code error, such as a parse error? I'm sure you have - I have :). You can
prevent committing such cardinal sins simply by using a git hook to automatically check for errors
as you commit. There's more you can do, the example config file is written with php and js
development in mind, and runs linting, code standard checks, and runs test cases on commit.

What if you don't want hooks to run for _this_ commit? Easy: `git commit --no-verify` will skip
running your `pre-commit` hooks. This is useful when merging in changes from someone else and you
either trust any discrepancies are not fatal, or don't want to review them.

Once a project has been git-hooked - open the `.git/hooks/config.php` file and configure what hooks
you want to run. You can configure hooks to run only for a specific branch if you wish, but by
default all hooks are defined to run for all branches. The following config files are equivalent:

	<?php
	$config = array(
		'pre-commit' => array(
			'misc/checkMyShizzle'
		)
	);

This is the simpler config file format that will run the `pre-commit` hook on all branches

	<?php
	$config = array(
		'*' => array(
			'pre-commit' => array(
				'misc/checkMyShizzle'
			)
		)
	);

This is the slightly more flexible config file format that permits configuring branch-specific
hooks. Branch-specific tests allow you to be quite selective, for example:

	<?php
	$config = array(
		'develop' => array(
			'pre-commit' => array(
				'project/testCommitedFiles'
			)
		),
		'feature/*' => array(
			'pre-commit' => array(
				'project/testCommitedFiles'
			)
		),
		'release/*' => array(
			'pre-commit' => array(
				'project/fullIntegrationTest'
			)
		),
		'*' => array(
			'pre-commit' => array(
				'project/lintCommittedFiles'
			)
		)
	);

The above example uses [git-flow](http://jeffkreeftmeijer.com/2010/why-arent-you-using-git-flow/),
if you aren't familiar with git flow - it's quite simple. Master is always stable and the latest
release; features are developed in their own branch; when features are completed they are merged
into develop; when it's time for a new version, a release branch is made from develop, any last
minute changes are made (generate changelog, bump version file), and then merged to master.

In this case, we have 3 hooks, one to lint (check for parse errors), test (run test cases for only
the commited files) and another hook to run a full integration test (test everything that has a
test, might take a while). In all cases, on commit, files are linted. develop and feature branches
run tests on the files that are changed on each commit. Only when building a release do we run the
full integration test. Working in this way, you can confidently release newer versions knowing that
when you committed the code, it worked.

# More hooks

The `pre-commit` hooks is only one of the [many](http://book.git-scm.com/5_git_hooks.html) [hooks](http://progit.org/book/ch7-3.html)
that git provides. The standard config file makes use of only `pre-commit`, `post-commit` and
`post-merge`, if you're using this repo, all of the hooks are processed by the one-hook script.

# Optional dependencies

If you want to use the CakePHP coding standard for PHPCodeSniffer, you can find it here:
http://github.com/AD7six/cakephp-codesniffs

# Credits

This repo originally came from http://github.com/s0enke/git-hooks

The php based config etc. originally came from http://github.com/ardell/git-hooks
