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

    /** @var Dumper */
    private $dumper;

    /**
     * @param TwigEngine $templating
     */
    public function __construct(TwigEngine $templating, Dumper $dumper)
    {
        $this->currentWorkingDirectory = getcwd();
        $this->templating = $templating;
        $this->dumper = $dumper;
    }

    /**
     * @throws SrcDirectoryNotFound
     *
     * @return string The src directory
     */
    protected function getGenerateDirectory()
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

    public function generateClasses(array $classes, float $targetPhpVersion)
    {
        array_map(
            function (GeneratableClass $class) use ($targetPhpVersion) {
                $fileDirectory = '/' . str_replace('\\', '/', $class->getClassName()->getNamespace()->getName());
                $filename = $fileDirectory . '/' . $class->getClassName()->getName() . '.php';

                $this->dumper->dump(
                    $this->getGenerateDirectory() . $filename,
                    $this->templating->render($class->getTemplatePath($targetPhpVersion), ['class' => $class])
                );
            },
            $classes
        );
    }

    public function generateFiles(array $files, float $targetPhpVersion)
    {
        array_map(
            function (GeneratableFile $file) use ($targetPhpVersion) {
                $this->dumper->dump(
                    $this->getGenerateDirectory() . '/' . $file->getFilePath($targetPhpVersion),
                    $this->templating->render($file->getTemplatePath($targetPhpVersion), ['file' => $file])
                );
            },
            $files
        );
    }

    public function generateClass(GeneratableClass $class, float $targetPhpVersion)
    {
        $this->generateClasses([$class], $targetPhpVersion);
    }

    public function generateFile(GeneratableFile $file, float $targetPhpVersion)
    {
        $this->generateFiles([$file], $targetPhpVersion);
    }
}
