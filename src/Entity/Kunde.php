<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;
use App\Repository\KundeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: KundeRepository::class)]
#[ORM\Table(name: 'std.tbl_kunden')]
#[ApiResource(
    routePrefix: '/foo',
    operations: [
        new GetCollection(uriTemplate: '/kunden'),
        new Get(uriTemplate: '/kunden/{id}'),
        new Post(uriTemplate: '/kunden'),
        new Put(uriTemplate: '/kunden/{id}'),
        new Delete(uriTemplate: '/kunden/{id}'),
    ],
)]
class Kunde
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'App\Doctrine\KundeIdGenerator')]
    #[ORM\Column(type: Types::STRING, length: 36, unique: true)]
    private ?string $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank]
    private ?string $vorname = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $firma = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Assert\NotBlank]
    private ?\DateTimeInterface $geburtsdatum = null;

    #[ORM\Column(nullable: true)]
    private ?bool $geloescht = null;

    #[ORM\Column(type: 'geschlecht', nullable: true)]
    private $geschlecht = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $email = null;

    #[ORM\ManyToOne(inversedBy: 'kunden', targetEntity: Vermittler::class)]
    #[ORM\JoinColumn(name: 'vermittler_id', referencedColumnName: 'id')]
    private ?Vermittler $vermittler = null;

    #[ORM\OneToMany(mappedBy: 'kunde', targetEntity: KundeAdresse::class, cascade: ['persist', 'remove'])]
    private Collection $adressen;

    #[ORM\OneToOne(mappedBy: 'kunde', targetEntity: User::class)]
    private User $user;

    public function __construct()
    {
        $this->adressen = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getVorname(): ?string
    {
        return $this->vorname;
    }

    public function setVorname(?string $vorname): static
    {
        $this->vorname = $vorname;

        return $this;
    }

    public function getFirma(): ?string
    {
        return $this->firma;
    }

    public function setFirma(?string $firma): static
    {
        $this->firma = $firma;

        return $this;
    }

    public function getGeburtsdatum(): ?\DateTimeInterface
    {
        return $this->geburtsdatum;
    }

    public function setGeburtsdatum(?\DateTimeInterface $geburtsdatum): static
    {
        $this->geburtsdatum = $geburtsdatum;

        return $this;
    }

    public function isGeloescht(): ?bool
    {
        return $this->geloescht;
    }

    public function setGeloescht(?bool $geloescht): static
    {
        $this->geloescht = $geloescht;

        return $this;
    }

    public function getGeschlecht()
    {
        return $this->geschlecht;
    }

    public function setGeschlecht($geschlecht): static
    {
        $this->geschlecht = $geschlecht;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getVermittler(): ?Vermittler
    {
        return $this->vermittler;
    }

    public function setVermittler(?Vermittler $vermittler): static
    {
        $this->vermittler = $vermittler;

        return $this;
    }

    /**
     * @return Collection<int, KundeAdresse>
     */
    public function getAdressen(): Collection
    {
        return $this->adressen;
    }

    public function addAdressen(KundeAdresse $adressen): static
    {
        if (!$this->adressen->contains($adressen)) {
            $this->adressen->add($adressen);
            $adressen->setKunde($this);
        }

        return $this;
    }

    public function removeAdressen(KundeAdresse $adressen): static
    {
        if ($this->adressen->removeElement($adressen)) {
            // set the owning side to null (unless already changed)
            if ($adressen->getKunde() === $this) {
                $adressen->setKunde(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setKunde(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getKunde() !== $this) {
            $user->setKunde($this);
        }

        $this->user = $user;

        return $this;
    }
}
