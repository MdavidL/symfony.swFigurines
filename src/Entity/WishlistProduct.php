<?php

namespace App\Entity;

use App\Repository\WishlistProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WishlistProductRepository::class)
 */
class WishlistProduct
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $user_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $manufacturer;

    /**
     * @ORM\ManyToOne(targetEntity=Productadd::class, inversedBy="wishlists")
     * @ORM\JoinColumn(nullable=false)
     */
    private $productadd;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getManufacturer(): ?string
    {
        return $this->manufacturer;
    }

    public function setManufacturer(string $manufacturer): self
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getProductadd(): ?Productadd
    {
        return $this->productadd;
    }

    public function setProductadd(?Productadd $productadd): self
    {
        $this->productadd = $productadd;

        return $this;
    }

}