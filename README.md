Git hooks
=========

Various git hooks, mix and match however you want on a project by project (and even branch by branch) basis.

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

This will symlink the commands you might want to use into your .git/hooks folder, link all git hooks to the one-hook file, and create a config file which you can use to customize how the hooks work
for each project

# Optional dependencies

If you want to use the CakePHP coding standard for PHPCodeSniffer, you can find it here: http://github.com/AD7six/cakephp-codesniffs

# Credits

This repo originally came from http://github.com/s0enke/git-hooks

The php based config etc. originally came from http://github.com/ardell/git-hooks
