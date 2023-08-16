<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function initStorage(): void
    {
        // nothing now
    }

    public function initLangs(): void
    {
        // just init my translations
    }
}
