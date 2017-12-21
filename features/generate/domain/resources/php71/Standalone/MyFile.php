<?php

namespace Standalone;

use Common\Doctrine\ValueObject\AbstractFile;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

class MyFile extends AbstractFile
{
    /**
     * @var UploadedFile
     *
     * @Assert\File(maxSize = "3M")
     */
    protected $file;

    protected function getUploadDir(): string
    {
        return 'MyFile';
    }
}
