<?php

namespace App\Doctrine\DBAL\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class GeschlechtType extends Type
{
    public const GESCHLECHT = 'geschlecht'; // Custom type name

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return "VARCHAR(255)";
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): string
    {
        return (string)$value;
    }

    public function getName(): string
    {
        return self::GESCHLECHT;
    }
}
