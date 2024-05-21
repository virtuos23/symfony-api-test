<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\Get;
use App\Repository\KundeAdresseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: KundeAdresseRepository::class)]
#[ApiResource(
    routePrefix: '/foo',
    uriTemplate: '/kunden/{id}/adressen',
    uriVariables: [
        'id' => new Link(
            fromClass: Kunde::class,
            fromProperty: 'adressen'
        )
    ],
    operations: [new Get()]
)]
class KundeAdresse
{
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'adressen', targetEntity: Kunde::class)]
    #[ORM\JoinColumn(name: 'kunde_id', referencedColumnName: 'id', nullable: false)]
    private ?Kunde $kunde = null;

    #[ORM\Id]
    #[ORM\OneToOne(cascade: ['persist', 'remove'], targetEntity: Adresse::class)]
    #[ORM\JoinColumn(name: 'adresse_id', referencedColumnName: 'id', nullable: false)]
    private ?Adresse $adresse = null;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $geschaeftlich = null;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $rechnungsadresse = null;

    #[ORM\Column(type: 'boolean', nullable: false)]
    private ?bool $geloescht = null;

    public function getKunde(): ?Kunde
    {
        return $this->kunde;
    }

    public function setKunde(?Kunde $kunde): static
    {
        $this->kunde = $kunde;

        return $this;
    }

    public function getAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setAdresse(Adresse $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function isGeschaeftlich(): ?bool
    {
        return $this->geschaeftlich;
    }

    public function setGeschaeftlich(bool $geschaeftlich): static
    {
        $this->geschaeftlich = $geschaeftlich;

        return $this;
    }

    public function isRechnungsadresse(): ?bool
    {
        return $this->rechnungsadresse;
    }

    public function setRechnungsadresse(bool $rechnungsadresse): static
    {
        $this->rechnungsadresse = $rechnungsadresse;

        return $this;
    }

    public function isGeloescht(): ?bool
    {
        return $this->geloescht;
    }

    public function setGeloescht(bool $geloescht): static
    {
        $this->geloescht = $geloescht;

        return $this;
    }
}
