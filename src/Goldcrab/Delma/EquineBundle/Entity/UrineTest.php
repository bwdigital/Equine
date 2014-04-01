<?php

namespace Goldcrab\Delma\EquineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * UrineTest
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Goldcrab\Delma\EquineBundle\Entity\UrineTestRepository")
 */
class UrineTest
{
    /**
     * @var integer
     *
     * @ORM\Column(name="urine_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \Goldcrab\Delma\EquineBundle\Entity\Horse
     *
     * @ORM\ManyToOne(targetEntity="Horse")
     * @ORM\JoinColumn(name="urine_horse_id", referencedColumnName="horse_id", nullable=false)
     * @Assert\NotBlank()
     */
    private $horse;

    /**
     * @var \Goldcrab\Delma\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Goldcrab\Delma\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="urine_doctor_user_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank()
     */
    private $doctor;

    /**
     * @var \Goldcrab\Delma\UserBundle\Entity\User

     * @ORM\ManyToOne(targetEntity="Goldcrab\Delma\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="urine_tested_user_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank()
     */
    private $testedBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="urine_testedDate", type="datetime", nullable=true)
     * @Assert\NotBlank()
     */
    private $testedDate;

    /**
     * @var string
     *
     * @ORM\Column(name="urine_leukocytes", type="string", length=50, nullable=true)
     */
    private $leukocytes;

    /**
     * @var string
     *
     * @ORM\Column(name="urine_nitrates", type="string", length=50, nullable=true)
     */
    private $nitrates;

    /**
     * @var string
     *
     * @ORM\Column(name="urine_urobilinogen", type="string", length=50, nullable=true)
     */
    private $urobilinogen;

    /**
     * @var string
     *
     * @ORM\Column(name="urine_protein", type="string", length=50, nullable=true)
     */
    private $protein;

    /**
     * @var string
     *
     * @ORM\Column(name="urine_ph", type="string", length=50, nullable=true)
     */
    private $ph;

    /**
     * @var string
     *
     * @ORM\Column(name="urine_bloodsang", type="string", length=50, nullable=true)
     */
    private $bloodsang;

    /**
     * @var string
     *
     * @ORM\Column(name="urine_sgravity", type="string", length=50, nullable=true)
     */
    private $sgravity;

    /**
     * @var string
     *
     * @ORM\Column(name="urine_ketones", type="string", length=50, nullable=true)
     */
    private $ketones;

    /**
     * @var string
     *
     * @ORM\Column(name="urine_bilirubin", type="string", length=50, nullable=true)
     */
    private $bilirubin;

    /**
     * @var string
     *
     * @ORM\Column(name="urine_glucose", type="string", length=50, nullable=true)
     */
    private $glucose;

    /**
     * @var string
     *
     * @ORM\Column(name="urine_comments", type="text", nullable=true)
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
     * @return UrineTest
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
     * Set leukocytes
     *
     * @param string $leukocytes
     * @return UrineTest
     */
    public function setLeukocytes($leukocytes)
    {
        $this->leukocytes = $leukocytes;
    
        return $this;
    }

    /**
     * Get leukocytes
     *
     * @return string 
     */
    public function getLeukocytes()
    {
        return $this->leukocytes;
    }

    /**
     * Set nitrates
     *
     * @param string $nitrates
     * @return UrineTest
     */
    public function setNitrates($nitrates)
    {
        $this->nitrates = $nitrates;
    
        return $this;
    }

    /**
     * Get nitrates
     *
     * @return string 
     */
    public function getNitrates()
    {
        return $this->nitrates;
    }

    /**
     * Set urobilinogen
     *
     * @param string $urobilinogen
     * @return UrineTest
     */
    public function setUrobilinogen($urobilinogen)
    {
        $this->urobilinogen = $urobilinogen;
    
        return $this;
    }

    /**
     * Get urobilinogen
     *
     * @return string 
     */
    public function getUrobilinogen()
    {
        return $this->urobilinogen;
    }

    /**
     * Set protein
     *
     * @param string $protein
     * @return UrineTest
     */
    public function setProtein($protein)
    {
        $this->protein = $protein;
    
        return $this;
    }

    /**
     * Get protein
     *
     * @return string 
     */
    public function getProtein()
    {
        return $this->protein;
    }

    /**
     * Set ph
     *
     * @param string $ph
     * @return UrineTest
     */
    public function setPh($ph)
    {
        $this->ph = $ph;
    
        return $this;
    }

    /**
     * Get ph
     *
     * @return string 
     */
    public function getPh()
    {
        return $this->ph;
    }

    /**
     * Set bloodsang
     *
     * @param string $bloodsang
     * @return UrineTest
     */
    public function setBloodsang($bloodsang)
    {
        $this->bloodsang = $bloodsang;
    
        return $this;
    }

    /**
     * Get bloodsang
     *
     * @return string 
     */
    public function getBloodsang()
    {
        return $this->bloodsang;
    }

    /**
     * Set sgravity
     *
     * @param string $sgravity
     * @return UrineTest
     */
    public function setSgravity($sgravity)
    {
        $this->sgravity = $sgravity;
    
        return $this;
    }

    /**
     * Get sgravity
     *
     * @return string 
     */
    public function getSgravity()
    {
        return $this->sgravity;
    }

    /**
     * Set ketones
     *
     * @param string $ketones
     * @return UrineTest
     */
    public function setKetones($ketones)
    {
        $this->ketones = $ketones;
    
        return $this;
    }

    /**
     * Get ketones
     *
     * @return string 
     */
    public function getKetones()
    {
        return $this->ketones;
    }

    /**
     * Set bilirubin
     *
     * @param string $bilirubin
     * @return UrineTest
     */
    public function setBilirubin($bilirubin)
    {
        $this->bilirubin = $bilirubin;
    
        return $this;
    }

    /**
     * Get bilirubin
     *
     * @return string 
     */
    public function getBilirubin()
    {
        return $this->bilirubin;
    }

    /**
     * Set glucose
     *
     * @param string $glucose
     * @return UrineTest
     */
    public function setGlucose($glucose)
    {
        $this->glucose = $glucose;
    
        return $this;
    }

    /**
     * Get glucose
     *
     * @return string 
     */
    public function getGlucose()
    {
        return $this->glucose;
    }

    /**
     * Set comments
     *
     * @param string $comments
     * @return UrineTest
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
