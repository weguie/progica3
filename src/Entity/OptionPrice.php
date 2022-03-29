<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OptionPrice
 *
 * @ORM\Table(name="option_price", uniqueConstraints={@ORM\UniqueConstraint(name="id_option", columns={"id_option"}), @ORM\UniqueConstraint(name="id_gite", columns={"id_gite"})})
 * @ORM\Entity
 */
class OptionPrice
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="string", length=255, nullable=false)
     */
    private $price;

    /**
     * @var \Option
     *
     * @ORM\ManyToOne(targetEntity="Option")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_option", referencedColumnName="id")
     * })
     */
    private $idOption;

    /**
     * @var \Gite
     *
     * @ORM\ManyToOne(targetEntity="Gite")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_gite", referencedColumnName="id")
     * })
     */
    private $idGite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getIdOption(): ?Option
    {
        return $this->idOption;
    }

    public function setIdOption(?Option $idOption): self
    {
        $this->idOption = $idOption;

        return $this;
    }

    public function getIdGite(): ?Gite
    {
        return $this->idGite;
    }

    public function setIdGite(?Gite $idGite): self
    {
        $this->idGite = $idGite;

        return $this;
    }


}
