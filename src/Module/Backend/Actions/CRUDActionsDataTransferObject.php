<?php

namespace ModuleGenerator\Module\Backend\Actions;

use ModuleGenerator\PhpGenerator\ClassName\ClassNameDataTransferObject;
use ModuleGenerator\PhpGenerator\ModuleName\ModuleNameDataTransferObject;

final class CRUDActionsDataTransferObject
{
    /** @var ModuleNameDataTransferObject */
    public $moduleName;

    /** @var ClassNameDataTransferObject */
    public $entityClassName;
}
