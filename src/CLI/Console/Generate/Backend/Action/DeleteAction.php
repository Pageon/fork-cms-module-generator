<?php

namespace ModuleGenerator\CLI\Console\Generate\Backend\Action;

use ModuleGenerator\CLI\Console\GenerateCommand;
use ModuleGenerator\Module\Backend\Actions\BackendActionDataTransferObject;
use ModuleGenerator\Module\Backend\Actions\BackendActionType;
use ModuleGenerator\Module\Backend\Actions\Delete\Delete;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DeleteAction extends GenerateCommand
{
    protected function configure()
    {
        parent::configure();

        $this->setName('generate:backend:action:delete')
            ->setDescription('Generate the delete action for an entity');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        parent::execute($input, $output);

        /** @var BackendActionDataTransferObject $crudActionsDataTransferObject */
        $crudActionsDataTransferObject = $this->getFormData(BackendActionType::class);

        $this->generateAction($crudActionsDataTransferObject);
    }

    public function generateAction(BackendActionDataTransferObject $crudActionsDataTransferObject): void
    {
        $this->generateService->generateClass(
            Delete::fromDataTransferObject($crudActionsDataTransferObject),
            $this->getTargetPhpVersion()
        );
    }
}
