<?php 
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class PropertySearch {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string|null
     */
    private $title;

    /**
     * @var int|null
     */
    private $price;

     /**
     * @var string|null
     */
    private $regions;

    /**
     * @var bool|null
     */
    private $isAllowed;

    /**
     * @return string|null
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string|null
     */
    public function getRegions()
    {
        return $this->regions;
    }

    /**
     * @param string|null $price
     * @return PropertySearch
     */
    public function setTitle(string $title): PropertySearch
    {
        $this->title = $title;

        return $this;
    }

        /**
     * @return bool|null
     */
    public function getIsAllowed(): ?bool
    {
        return $this->isAllowed;
    }

    /**
     * @param bool|null $isAllowed
     * @return PropertySearch
     */
    public function setisAllowed(bool $isAllowed)
    {
        $this->isAllowed = $isAllowed;
        return $this->isAllowed;
    }

    /**
     * @return int|null
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param int|null $price
     * @return PropertySearch
     */
    public function setPrice(int $price): PropertySearch
    {
        $this->price = $price;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}