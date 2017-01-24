<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Console\Application as FrameworkApplication;
use Symfony\Component\Console\Command\Command;

final class Application extends FrameworkApplication
{
    /**
     * Keep the symfony commands from cluttering
     *
     * @param Command $command
     */
    public function add(Command $command)
    {
        if (in_array(
            $this->extractNamespace($command->getName()),
            [
                'assets',
                'cache',
                'config',
                'debug',
                'lint',
                'server',
                'translation',
                'cache:pool',
            ]
        )) {
            return;
        }

        parent::add($command);
    }
}
