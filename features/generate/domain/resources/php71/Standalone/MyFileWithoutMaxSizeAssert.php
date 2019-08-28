<?php

namespace Standalone;

use Common\Doctrine\ValueObject\AbstractFile;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

class MyFileWithoutMaxSizeAssert extends AbstractFile
{
    /**
     * @var UploadedFile
     *
     * @Assert\File()
     */
    protected $file;

    protected function getUploadDir(): string
    {
        return 'MyFileWithoutMaxSizeAssert';
    }
}
