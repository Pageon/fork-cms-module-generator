<?php

namespace ModuleGenerator\CLI\Console\Generate\Actions;

use ModuleGenerator\CLI\Console\GenerateCommand;
use ModuleGenerator\Module\Backend\Actions\CRUDActionsDataTransferObject;
use ModuleGenerator\Module\Backend\Actions\CRUDActionsType;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CRUDActions extends GenerateCommand
{
    protected function configure()
    {
        parent::configure();

        $this->setName('generate:backend:crud')
            ->setDescription('Generates the index, add, update and delete action for an entity');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        parent::execute($input, $output);

        /** @var CRUDActionsDataTransferObject $crudActionsDataTransferObject */
        $crudActionsDataTransferObject = $this->getFormData(CRUDActionsType::class);

        $classes = [
            AddAction::class,
            DeleteAction::class,
            EditAction::class,
            IndexAction::class,
        ];

        foreach ($classes as $class) {
            (new $class($this->generateService))->setTargetPhpVersion($this->getTargetPhpVersion())->generateAction(
                $crudActionsDataTransferObject
            );
        }
    }
}
