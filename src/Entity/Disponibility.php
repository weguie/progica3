<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Disponibility
 *
 * @ORM\Table(name="disponibility", uniqueConstraints={@ORM\UniqueConstraint(name="gite_id", columns={"gite_id"})})
 * @ORM\Entity
 */
class Disponibility
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_start", type="date", nullable=false)
     */
    private $dateStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_end", type="date", nullable=false)
     */
    private $dateEnd;

    /**
     * @var \Gite
     *
     * @ORM\ManyToOne(targetEntity="Gite")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="gite_id", referencedColumnName="id")
     * })
     */
    private $gite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->dateStart;
    }

    public function setDateStart(\DateTimeInterface $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function setDateEnd(\DateTimeInterface $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    public function getGite(): ?Gite
    {
        return $this->gite;
    }

    public function setGite(?Gite $gite): self
    {
        $this->gite = $gite;

        return $this;
    }


}
