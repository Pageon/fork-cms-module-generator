# Fork-cms module generator

## Installation

Assuming you're on Mac OSX or GNU/Linux with `git`, `php` and `curl` installed:

	git clone https://github.com/carakas/fork-cms-module-generator.git /usr/local/fork-cms-module-generator && cd /usr/local/fork-cms-module-generator && curl -sS https://getcomposer.org/installer | php && php composer.phar install && ln -s /usr/local/fork-cms-module-generator/app/console /usr/local/bin/module-generator && cd -

Or you could use the installer, do this (the installer will allow you to use a prefix):

	curl https://raw.githubusercontent.com/carakas/fork-cms-module-generator/master/install.sh | sh

You can now run the `module-generator` command from your command line.

## Update

run the following command

    module-generator module-generator:update
    
## Settings

You can use the `php` parameter to change the minimum supported version of php for the generated code.

The current supported options are:
* 5.6
* 7.0 [default]
