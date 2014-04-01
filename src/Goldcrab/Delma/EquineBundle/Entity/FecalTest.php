<?php

namespace Goldcrab\Delma\EquineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * FecalTest
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Goldcrab\Delma\EquineBundle\Entity\FecalTestRepository")
 */
class FecalTest
{
    /**
     * @var integer
     *
     * @ORM\Column(name="fecal_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var \Goldcrab\Delma\EquineBundle\Entity\Horse
     *
     * @ORM\ManyToOne(targetEntity="Horse")
     * @ORM\JoinColumn(name="fecal_horse_id", referencedColumnName="horse_id", nullable=false)
     * @Assert\NotBlank()
     */
    private $horse;

    /**
     * @var \Goldcrab\Delma\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Goldcrab\Delma\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="fecal_doctor_user_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank()
     */
    private $doctor;

    /**
     * @var \Goldcrab\Delma\UserBundle\Entity\User

     * @ORM\ManyToOne(targetEntity="Goldcrab\Delma\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="fecal_tested_user_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank()
     */
    private $testedBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecal_testedDate", type="datetime", nullable=true)
     * @Assert\NotBlank()
     */
    private $testedDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="fecal_anoplocephala", type="integer", nullable=true)
     */
    private $anoplocephala;

    /**
     * @var string
     *
     * @ORM\Column(name="fecal_strongyle", type="string", length=50, nullable=true)
     */
    private $strongyle;

    /**
     * @var string
     *
     * @ORM\Column(name="fecal_parascaris", type="string", length=50, nullable=true)
     */
    private $parascaris;

    /**
     * @var string
     *
     * @ORM\Column(name="fecal_occult", type="string", length=50, nullable=true)
     */
    private $occult;

    /**
     * @var string
     *
     * @ORM\Column(name="fecal_clostridium", type="string", length=50, nullable=true)
     */
    private $clostridium;

    /**
     * @var string
     *
     * @ORM\Column(name="fecal_comments", type="text", nullable=true)
     */
    private $comments;


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
     * @param \Goldcrab\Delma\UserBundle\Entity\User $doctor
     */
    public function setDoctor($doctor)
    {
        $this->doctor = $doctor;
    }

    /**
     * @return \Goldcrab\Delma\UserBundle\Entity\User
     */
    public function getDoctor()
    {
        return $this->doctor;
    }

    /**
     * @param \Goldcrab\Delma\EquineBundle\Entity\Horse $horse
     */
    public function setHorse($horse)
    {
        $this->horse = $horse;
    }

    /**
     * @return \Goldcrab\Delma\EquineBundle\Entity\Horse
     */
    public function getHorse()
    {
        return $this->horse;
    }

    /**
     * @param \Goldcrab\Delma\UserBundle\Entity\User $testedBy
     */
    public function setTestedBy($testedBy)
    {
        $this->testedBy = $testedBy;
    }

    /**
     * @return \Goldcrab\Delma\UserBundle\Entity\User
     */
    public function getTestedBy()
    {
        return $this->testedBy;
    }

    /**
     * Set testedDate
     *
     * @param \DateTime $testedDate
     * @return FecalTest
     */
    public function setTestedDate($testedDate)
    {
        $this->testedDate = $testedDate;
    
        return $this;
    }

    /**
     * Get testedDate
     *
     * @return \DateTime 
     */
    public function getTestedDate()
    {
        return $this->testedDate;
    }

    /**
     * Set anoplocephala
     *
     * @param integer $anoplocephala
     * @return FecalTest
     */
    public function setAnoplocephala($anoplocephala)
    {
        $this->anoplocephala = $anoplocephala;
    
        return $this;
    }

    /**
     * Get anoplocephala
     *
     * @return integer 
     */
    public function getAnoplocephala()
    {
        return $this->anoplocephala;
    }

    /**
     * Set strongyle
     *
     * @param string $strongyle
     * @return FecalTest
     */
    public function setStrongyle($strongyle)
    {
        $this->strongyle = $strongyle;
    
        return $this;
    }

    /**
     * Get strongyle
     *
     * @return string 
     */
    public function getStrongyle()
    {
        return $this->strongyle;
    }

    /**
     * @param string $parascaris
     */
    public function setParascaris($parascaris)
    {
        $this->parascaris = $parascaris;
    }

    /**
     * @return string
     */
    public function getParascaris()
    {
        return $this->parascaris;
    }

    /**
     * Set occult
     *
     * @param string $occult
     * @return FecalTest
     */
    public function setOccult($occult)
    {
        $this->occult = $occult;
    
        return $this;
    }

    /**
     * Get occult
     *
     * @return string 
     */
    public function getOccult()
    {
        return $this->occult;
    }

    /**
     * Set clostridium
     *
     * @param string $clostridium
     * @return FecalTest
     */
    public function setClostridium($clostridium)
    {
        $this->clostridium = $clostridium;
    
        return $this;
    }

    /**
     * Get clostridium
     *
     * @return string 
     */
    public function getClostridium()
    {
        return $this->clostridium;
    }

    /**
     * Set comments
     *
     * @param string $comments
     * @return FecalTest
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    
        return $this;
    }

    /**
     * Get comments
     *
     * @return string 
     */
    public function getComments()
    {
        return $this->comments;
    }
}
