<?php

namespace Goldcrab\Delma\EquineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\MaxDepth;

/**
 * Stable
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Goldcrab\Delma\EquineBundle\Entity\StableRepository")
 *
 */
class Stable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="stable_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="stable_name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="stable_group", type="string", length=50)
     */
    private $sgroup;

    /**
     * @var string
     *
     * @ORM\Column(name="stable_phone", type="string", length=20, nullable=true )
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="stable_fax", type="string", length=20, nullable=true )
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="stable_address", type="string", length=20, nullable=true )
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="stable_city", type="string", length=20, nullable=true )
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="stable_country", type="string", length=2)
     */
    private $country;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Stable
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set sgroup
     *
     * @param string $sgroup
     * @return Stable
     */
    public function setSgroup($sgroup)
    {
        $this->sgroup = $sgroup;
    
        return $this;
    }

    /**
     * Get sgroup
     *
     * @return string 
     */
    public function getSgroup()
    {
        return $this->sgroup;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Stable
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    
        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return Stable
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    
        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Stable
     */
    public function setAddress($address)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Stable
     */
    public function setCity($city)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Stable
     */
    public function setCountry($country)
    {
        $this->country = $country;
    
        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }


}
