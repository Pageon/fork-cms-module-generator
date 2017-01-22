<?php

namespace ModuleGenerator\PhpGenerator\ClassName;

use ModuleGenerator\PhpGenerator\PhpNamespace\PhpNamespaceDataTransferObject;

final class ClassNameDataTransferObject
{
    /** @var string */
    public $name;

    /** @var PhpNamespaceDataTransferObject */
    public $namespace;

    /** @var string|null */
    public $alias;

    /** @var ClassName|null */
    private $classNameClass;

    public function __construct(ClassName $className = null)
    {
        $this->classNameClass = $className;

        if (!$this->classNameClass instanceof ClassName) {
            return;
        }

        $this->name = $this->classNameClass->getName();
        $this->namespace = new PhpNamespaceDataTransferObject($this->classNameClass->getNamespace());
        $this->alias = $this->classNameClass->getAlias();
    }

    public function hasExistingClassName(): bool
    {
        return $this->classNameClass instanceof ClassName;
    }

    public function getClassNameClass(): ClassName
    {
        return $this->classNameClass;
    }
}
