<?php

namespace ModuleGenerator\CLI\Service\Generate;

interface Dumper
{
    public function dump(string $filename, string $content, bool $append = false): void;
}
