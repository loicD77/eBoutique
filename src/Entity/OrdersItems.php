<?php

namespace App\Entity;

use App\Repository\OrdersItemsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdersItemsRepository::class)]
class OrdersItems
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $order_id = null;

    #[ORM\Column]
    private ?int $formation_id = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $price = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderId(): ?int
    {
        return $this->order_id;
    }

    public function setOrderId(int $order_id): static
    {
        $this->order_id = $order_id;

        return $this;
    }

    public function getFormationId(): ?int
    {
        return $this->formation_id;
    }

    public function setFormationId(int $formation_id): static
    {
        $this->formation_id = $formation_id;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }
}
