<?php

namespace ModuleGenerator\CLI\Service\Generate;

use ModuleGenerator\CLI\Exception\SrcDirectoryNotFound;
use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\Filesystem\Filesystem;

final class Generate
{
    /** @var string the directory where the command was executed */
    protected $currentWorkingDirectory;

    /** @var string the src directory */
    private $generateDirectory;

    /** @var TwigEngine */
    private $templating;

    /**
     * @param string $currentWorkingDirectory
     * @param TwigEngine $templating
     */
    public function __construct($currentWorkingDirectory, TwigEngine $templating)
    {
        $this->currentWorkingDirectory = $currentWorkingDirectory;
        $this->templating = $templating;
    }

    /**
     * @throws SrcDirectoryNotFound
     *
     * @return string The src directory
     */
    final protected function getGenerateDirectory()
    {
        if ($this->generateDirectory !== null) {
            return $this->generateDirectory;
        }

        $currentDirectory = $this->currentWorkingDirectory;

        // Is this the src directory? Or any of the above directories?
        while ($currentDirectory !== '/') {
            // Is this the src directory?
            if (basename($currentDirectory) === 'src') {
                return $this->generateDirectory = $currentDirectory;
            }
            // Does this directory contain the src directory?
            if (is_dir($currentDirectory . '/src')) {
                return $this->generateDirectory = $currentDirectory . '/src';
            }

            // Try in the parent directory
            $currentDirectory = dirname($currentDirectory);
        }

        throw SrcDirectoryNotFound::forDirectory($this->currentWorkingDirectory);
    }

    public function generateClass(GeneratableClass $class)
    {
        $fileDirectory = '/' . str_replace('\\', '/', $class->getClassName()->getNamespace()->getName());
        $filename = $fileDirectory . '/' . $class->getClassName()->getName() . '.php';
        $fileSystem = new Filesystem();

        $fileSystem->dumpFile(
            $this->getGenerateDirectory() . $filename,
            $this->templating->render($class->getTemplatePath(), ['class' => $class])
        );
    }
}
