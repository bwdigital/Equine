<?php

namespace Goldcrab\Delma\EquineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Horse
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Goldcrab\Delma\EquineBundle\Entity\HorseRepository")
 */
class Horse
{
    /**
     * @var integer
     *
     * @ORM\Column(name="horse_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="horse_name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="horse_alternate_name", type="string", length=100, nullable=true)
     */
    private $alternateName;


    /**
     * @var \Goldcrab\Delma\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Goldcrab\Delma\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="owner_user_id", referencedColumnName="id", nullable=true)
     */
    private $owner;


    /**
     * @var \Goldcrab\Delma\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Goldcrab\Delma\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="trainer_user_id", referencedColumnName="id", nullable=true)
     */
    private $trainer;

    /**
     * @var \Goldcrab\Delma\EquineBundle\Entity\Breed
     *
     * @ORM\ManyToOne(targetEntity="Breed")
     * @ORM\JoinColumn(name="breed_id", referencedColumnName="breed_id", nullable=true)
     */
    private $breed;

    /**
     * @ORM\ManyToOne(targetEntity="Stable")
     * @ORM\JoinColumn(name="stable_id", referencedColumnName="stable_id", nullable=false)
     * @Assert\NotBlank()
     */
    private $stable;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="horse_dob", type="date", length=255, nullable=true)
     */
    private $dob;

    /**
     * @var string
     *
     * @ORM\Column(name="horse_gender", type="string", length=10, nullable=true)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="horse_color", type="string", length=100, nullable=true)
     */
    private $color;

    /**
     * @var string
     *
     * @ORM\Column(name="horse_type", type="string", length=50, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="horse_species", type="string", length=50, nullable=true)
     */
    private $species;

    /**
     * @var string
     *
     * @ORM\Column(name="horse_sire", type="string", length=100, nullable=true)
     */
    private $sire;

    /**
     * @var string
     *
     * @ORM\Column(name="horse_dam", type="string", length=100, nullable=true)
     */
    private $dam;

    /**
     * @var string
     *
     * @ORM\Column(name="horse_country", type="string", length=2, nullable=true)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="horse_code", type="string", length=100, nullable=true)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="horse_status", type="string", length=100, nullable=true)
     */
    private $status;



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
     * @return Horse
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
     * Set dob
     *
     * @param string $dob
     * @return Horse
     */
    public function setDob($dob)
    {
        $this->dob = $dob;
    
        return $this;
    }

    /**
     * Get dob
     *
     * @return string 
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * Set gender
     *
     * @param string $gender
     * @return Horse
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    
        return $this;
    }

    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Horse
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set sire
     *
     * @param string $sire
     * @return Horse
     */
    public function setSire($sire)
    {
        $this->sire = $sire;
    
        return $this;
    }

    /**
     * Get sire
     *
     * @return string 
     */
    public function getSire()
    {
        return $this->sire;
    }

    /**
     * Set dam
     *
     * @param string $dam
     * @return Horse
     */
    public function setDam($dam)
    {
        $this->dam = $dam;
    
        return $this;
    }

    /**
     * Get dam
     *
     * @return string 
     */
    public function getDam()
    {
        return $this->dam;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Horse
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

    /**
     * Set color
     *
     * @param string $color
     * @return Horse
     */
    public function setColor($color)
    {
        $this->color = $color;
    
        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @return string
     */
    public function getAlternateName()
    {
        return $this->alternateName;
    }

    /**
     * @param string $alternateName
     */
    public function setAlternateName($alternateName)
    {
        $this->alternateName = $alternateName;
    }

    /**
     * @param \Goldcrab\Delma\UserBundle\Entity\User $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }

    /**
     * @return \Goldcrab\Delma\UserBundle\Entity\User
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param \Goldcrab\Delma\UserBundle\Entity\User $trainer
     */
    public function setTrainer($trainer)
    {
        $this->trainer = $trainer;
    }

    /**
     * @return \Goldcrab\Delma\UserBundle\Entity\User
     */
    public function getTrainer()
    {
        return $this->trainer;
    }


    /**
     * @return \Goldcrab\Delma\EquineBundle\Entity\Stable
     */
    public function getStable()
    {
        return $this->stable;
    }

    /**
     * @param \Goldcrab\Delma\EquineBundle\Entity\Stable $stable
     */
    public function setStable(\Goldcrab\Delma\EquineBundle\Entity\Stable $stable)
    {
        $this->stable = $stable;
    }

    /**
     * @return \Goldcrab\Delma\EquineBundle\Entity\Breed
     */
    public function getBreed()
    {
        return $this->breed;
    }

    /**
     * @param \Goldcrab\Delma\EquineBundle\Entity\Breed $breed
     */
    public function setBreed(\Goldcrab\Delma\EquineBundle\Entity\Breed $breed = null)
    {
        $this->breed = $breed;
    }

    /**
     * @param string $species
     */
    public function setSpecies($species)
    {
        $this->species = $species;
    }

    /**
     * @return string
     */
    public function getSpecies()
    {
        return $this->species;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }



}
