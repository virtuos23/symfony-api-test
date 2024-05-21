<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;
use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'sec.user')]
#[ApiResource(
    routePrefix: '/foo',
    operations: [
        new GetCollection(uriTemplate: '/user'),
        new Get(uriTemplate: '/user/{id}'),
        new Post(uriTemplate: '/user'),
        new Put(uriTemplate: '/user/{id}'),
        new Delete(uriTemplate: '/user/{id}'),
    ],
)]
#[ApiResource(
    routePrefix: '/foo',
    uriTemplate: '/kunden/{id}/user',
    uriVariables: [
        'id' => new Link(
            fromClass: Kunde::class,
            fromProperty: 'user'
        )
    ],
    operations: [new Get()]
)]
class User implements UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    private array $roles = [];

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'kundenid', referencedColumnName: 'id', nullable: true)]
    private ?Kunde $kunde = null;

    #[ORM\Column(nullable: true)]
    private ?bool $aktiv = null;

    #[ORM\Column(name: 'last_login', type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $lastLogin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getKunde(): ?Kunde
    {
        return $this->kunde;
    }

    public function setKunde(?Kunde $kunde): static
    {
        $this->kunde = $kunde;

        return $this;
    }

    public function isAktiv(): ?bool
    {
        return $this->aktiv;
    }

    public function setAktiv(?bool $aktiv): static
    {
        $this->aktiv = $aktiv;

        return $this;
    }

    public function getLastLogin(): ?\DateTimeInterface
    {
        return $this->lastLogin;
    }

    public function setLastLogin(?\DateTimeInterface $lastLogin): static
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }
}
