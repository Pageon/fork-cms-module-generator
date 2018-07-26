<?php

namespace ModuleGenerator\Module\Backend\Layout\Templates\Add;

use ModuleGenerator\CLI\Service\Generate\GeneratableModuleFile;
use ModuleGenerator\Module\Backend\Actions\CRUDActionsDataTransferObject;
use ModuleGenerator\PhpGenerator\ClassName\ClassName;
use ModuleGenerator\PhpGenerator\ModuleName\ModuleName;

final class Add extends GeneratableModuleFile
{
    /** @var ClassName */
    private $entityClassName;

    public function __construct(ModuleName $moduleName, ClassName $entityClassName)
    {
        parent::__construct($moduleName);
        $this->entityClassName = $entityClassName;
    }

    public function getFilePath(float $targetPhpVersion): string
    {
        return 'Backend/Modules/' . $this->getModuleName() . '/Layout/Templates/' .
            $this->entityClassName->getName() . 'Add.html.twig';
    }

    public function getEntityClassName(): ClassName
    {
        return $this->entityClassName;
    }

    public function getTemplatePath(float $targetPhpVersion): string
    {
        return __DIR__ . '/Add.html.twig';
    }

    public static function fromDataTransferObject(CRUDActionsDataTransferObject $crudActionsDataTransferObject): self
    {
        return new self(
            ModuleName::fromDataTransferObject($crudActionsDataTransferObject->moduleName),
            ClassName::fromDataTransferObject($crudActionsDataTransferObject->entityClassName)
        );
    }
}
