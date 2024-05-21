<?php

namespace App\Doctrine;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Id\AbstractIdGenerator;

class AdresseIdGenerator extends AbstractIdGenerator
{
    public function generate(EntityManager $em, $entity)
    {
        // TODO: implement real own generator logic
        return mt_rand();

        // get max id from database.. etc.
    }
}
