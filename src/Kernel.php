<?php

declare(strict_types=1);

namespace App;

use App\Doctrine\DBAL\Types\GeschlechtType;
use Doctrine\DBAL\Types\Type;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    protected function initializeContainer()
    {
        parent::initializeContainer();

        if (!Type::hasType(GeschlechtType::GESCHLECHT)) {
            Type::addType(GeschlechtType::GESCHLECHT, GeschlechtType::class);
        }
    }
}
