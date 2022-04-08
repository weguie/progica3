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
     * @var string|null
     */
    private $city;


    public function getId(): ?int
    {
        return $this->id;
    }

     /**
     * @return string|null
     */
    public function getTitle()
    {
        return $this->title;
    }

     /**
     * @param string|null $title
     * @return PropertySearch
     */
    public function setTitle(string $title): PropertySearch
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity()
    {
        return $this->city;
    }

        /**
         * @param string|null $city
         * @return PropertySearch
         */
    public function setCity($city): PropertySearch
    {
        $this->city = $city;

        return $this;
    }



}