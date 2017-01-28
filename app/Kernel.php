<?php

namespace App;

use Matthias\SymfonyConsoleForm\Bundle\SymfonyConsoleFormBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Kernel as SymfonyKernel;

class Kernel extends SymfonyKernel
{
    /** @var string */
    private $vendorDirectory;

    public function __construct(string $environment, string $debug, string $vendorDirectory)
    {
        parent::__construct($environment, $debug);
        $this->vendorDirectory = $vendorDirectory;
    }

    public function registerBundles(): array
    {
        return [
            new FrameworkBundle(),
            new TwigBundle(),
            new SymfonyConsoleFormBundle(),
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__ . '/config.yml');
    }

    public function getCacheDir(): string
    {
        return __DIR__ . '/cache';
    }

    public function getLogDir(): string
    {
        return __DIR__ . '/logs';
    }

    protected function buildContainer(): ContainerInterface
    {
        $container = parent::buildContainer();

        $container->setParameter('vendor_directory', $this->vendorDirectory);

        return $container;
    }
}
