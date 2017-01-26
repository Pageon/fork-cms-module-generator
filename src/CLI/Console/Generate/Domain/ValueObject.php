<?php

namespace ModuleGenerator\CLI\Console\Generate\Domain;

use ModuleGenerator\CLI\Console\GenerateCommand;
use ModuleGenerator\Domain\ValueObject\ValueObject as ValueObjectClass;
use ModuleGenerator\Domain\ValueObject\ValueObjectType;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class ValueObject extends GenerateCommand
{
    protected function configure()
    {
        parent::configure();

        $this->setName('generate:domain:value-object')
            ->setDescription('Generates a value object');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        parent::execute($input, $output);

        $valueObject = ValueObjectClass::fromDataTransferObject($this->getFormData(ValueObjectType::class));
        $this->generateService->generateClass($valueObject, $this->getTargetPhpVersion());
    }
}
