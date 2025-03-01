<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['user:read', 'recipe:read', 'recipe:list'])]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Groups(['user:read', 'recipe:read', 'recipe:list'])]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user:read', 'recipe:read', 'recipe:list'])]
    private ?string $name = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column]
    private ?string $password = null;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Recipe::class)]
    #[Groups(['user:read'])]
    #[MaxDepth(1)]
    private Collection $recipes;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: ShoppingList::class)]
    #[Groups(['user:read'])]
    #[MaxDepth(1)]
    private Collection $shoppingLists;

    #[ORM\ManyToMany(targetEntity: Recipe::class)]
    #[ORM\JoinTable(name: 'user_favorite_recipes')]
    #[Groups(['user:read'])]
    #[MaxDepth(1)]
    private Collection $favoriteRecipes;

    #[ORM\ManyToMany(targetEntity: self::class)]
    #[ORM\JoinTable(name: 'user_followers')]
    #[Groups(['user:read'])]
    #[MaxDepth(1)]
    private Collection $followers;

    #[ORM\ManyToMany(targetEntity: self::class)]
    #[ORM\JoinTable(name: 'user_following')]
    #[Groups(['user:read'])]
    #[MaxDepth(1)]
    private Collection $following;

    public function __construct()
    {
        $this->recipes = new ArrayCollection();
        $this->shoppingLists = new ArrayCollection();
        $this->favoriteRecipes = new ArrayCollection();
        $this->followers = new ArrayCollection();
        $this->following = new ArrayCollection();
    }

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }

    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
    }

    /**
     * @return Collection<int, Recipe>
     */
    public function getRecipes(): Collection
    {
        return $this->recipes;
    }

    /**
     * @return Collection<int, ShoppingList>
     */
    public function getShoppingLists(): Collection
    {
        return $this->shoppingLists;
    }

    /**
     * @return Collection<int, Recipe>
     */
    public function getFavoriteRecipes(): Collection
    {
        return $this->favoriteRecipes;
    }

    /**
     * @return Collection<int, User>
     */
    public function getFollowers(): Collection
    {
        return $this->followers;
    }

    /**
     * @return Collection<int, User>
     */
    public function getFollowing(): Collection
    {
        return $this->following;
    }
} 
