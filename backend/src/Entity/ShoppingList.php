<?php

namespace App\Entity;

use App\Repository\ShoppingListRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ShoppingListRepository::class)]
class ShoppingList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['shopping_list:read'])]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'shoppingLists')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['shopping_list:read'])]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'shoppingList', targetEntity: ShoppingListItem::class, orphanRemoval: true)]
    #[Groups(['shopping_list:read'])]
    private Collection $items;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column]
    private \DateTimeImmutable $updatedAt;

    public function __construct()
    {
        $this->items = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return Collection<int, ShoppingListItem>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(ShoppingListItem $item): static
    {
        if (!$this->items->contains($item)) {
            $this->items->add($item);
            $item->setShoppingList($this);
        }
        return $this;
    }

    public function removeItem(ShoppingListItem $item): static
    {
        if ($this->items->removeElement($item)) {
            if ($item->getShoppingList() === $this) {
                $item->setShoppingList(null);
            }
        }
        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
} 
