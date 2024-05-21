<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Link;
use App\Repository\AdresseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AdresseRepository::class)]
#[ORM\Table(name: 'std.adresse')]
#[ApiResource(
    routePrefix: '/foo',
    operations: [
        new GetCollection(uriTemplate: '/adressen'),
        new Get(uriTemplate: '/adressen/{id}'),
        new Post(uriTemplate: '/adressen'),
        new Put(uriTemplate: '/adressen/{id}'),
        new Delete(uriTemplate: '/adressen/{id}'),
    ],
)]
// #[ApiResource(
//     routePrefix: '/foo',
//     uriTemplate: '/kunden/{id}/adressen/{id}/details',
//     uriVariables: [
//         'id' => new Link(
//             fromClass: Kunde::class,
//             fromProperty: 'adressen'
//         ),
//         'id' => new Link(
//             fromClass: Kunde::class,
//             fromProperty: 'adressen'
//         )
//     ],
//     operations: [new Get()]
// )]
class Adresse
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'App\Doctrine\AdresseIdGenerator')]
    #[ORM\Column(name: 'adresse_id')]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\NotBlank]
    private ?string $strasse = null;

    #[ORM\Column(length: 10, nullable: true)]
    #[Assert\NotBlank]
    private ?string $plz = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\NotBlank]
    private ?string $ort = null;

    #[ORM\Column(length: 2, nullable: true)]
    #[Assert\NotBlank]
    private ?string $bundesland = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStrasse(): ?string
    {
        return $this->strasse;
    }

    public function setStrasse(?string $strasse): static
    {
        $this->strasse = $strasse;

        return $this;
    }

    public function getPlz(): ?string
    {
        return $this->plz;
    }

    public function setPlz(string $plz): static
    {
        $this->plz = $plz;

        return $this;
    }

    public function getOrt(): ?string
    {
        return $this->ort;
    }

    public function setOrt(?string $ort): static
    {
        $this->ort = $ort;

        return $this;
    }

    public function getBundesland(): ?string
    {
        return $this->bundesland;
    }

    public function setBundesland(?string $bundesland): static
    {
        $this->bundesland = $bundesland;

        return $this;
    }
}
