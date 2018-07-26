<?php

namespace WidgetGenerator\PhpGenerator\WidgetName;

final class WidgetName
{
    /** @var string */
    private $name;

    public function __construct(string $name)
    {
        $this->name = ucfirst($name);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function __toString(): string
    {
        return $this->getName();
    }

    public static function fromDataTransferObject(
        WidgetNameDataTransferObject $widgetNameDataTransferObject
    ): self {
        if ($widgetNameDataTransferObject->hasExistingWidgetName()) {
            $widgetNameDataTransferObject->getWidgetNameClass()->name = ucfirst($widgetNameDataTransferObject->name);

            return $widgetNameDataTransferObject->getWidgetNameClass();
        }

        return new self(
            $widgetNameDataTransferObject->name
        );
    }
}
