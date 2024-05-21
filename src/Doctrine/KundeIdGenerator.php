<?php

namespace App\Doctrine;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Id\AbstractIdGenerator;
use Symfony\Component\Validator\Constraints\Uuid;

class KundeIdGenerator extends AbstractIdGenerator
{
    public function generate(EntityManager $em, $entity)
    {
        // TODO: implement real own generator logic
        return uniqid(mt_rand(), true);
    }
}
