<?php

namespace Goldcrab\Delma\EquineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CoagulationTest
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Goldcrab\Delma\EquineBundle\Entity\CoagulationTestRepository")
 */
class CoagulationTest
{
    /**
     * @var integer
     *
     * @ORM\Column(name="coagulation_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var \Goldcrab\Delma\EquineBundle\Entity\Horse
     *
     * @ORM\ManyToOne(targetEntity="Horse")
     * @ORM\JoinColumn(name="coagulation_horse_id", referencedColumnName="horse_id", nullable=false)
     * @Assert\NotBlank()
     */
    private $horse;

    /**
     * @var \Goldcrab\Delma\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Goldcrab\Delma\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="coagulation_doctor_user_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank()
     */
    private $doctor;

    /**
     * @var \Goldcrab\Delma\UserBundle\Entity\User

     * @ORM\ManyToOne(targetEntity="Goldcrab\Delma\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="coagulation_tested_user_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank()
     */
    private $testedBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="coagulation_testedDate", type="datetime", nullable=true)
     * @Assert\NotBlank()
     */
    private $testedDate;

    /**
     * @var float
     *
     * @ORM\Column(name="coagulation_thrombin", type="float", nullable=true)
     */
    private $thrombin;

    /**
     * @var float
     *
     * @ORM\Column(name="coagulation_prothrombin", type="float", nullable=true)
     */
    private $prothrombin;

    /**
     * @var float
     *
     * @ORM\Column(name="coagulation_aptt", type="float", nullable=true)
     */
    private $aptt;

    /**
     * @var float
     *
     * @ORM\Column(name="coagulation_fibrinogen", type="float", nullable=true)
     */
    private $fibrinogen;

    /**
     * @var string
     *
     * @ORM\Column(name="coagulation_comments", type="text", nullable=true)
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
     * @return CoagulationTest
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
     * Set thrombin
     *
     * @param float $thrombin
     * @return CoagulationTest
     */
    public function setThrombin($thrombin)
    {
        $this->thrombin = $thrombin;
    
        return $this;
    }

    /**
     * Get thrombin
     *
     * @return float 
     */
    public function getThrombin()
    {
        return $this->thrombin;
    }

    /**
     * Set prothrombin
     *
     * @param float $prothrombin
     * @return CoagulationTest
     */
    public function setProthrombin($prothrombin)
    {
        $this->prothrombin = $prothrombin;
    
        return $this;
    }

    /**
     * Get prothrombin
     *
     * @return float 
     */
    public function getProthrombin()
    {
        return $this->prothrombin;
    }

    /**
     * Set aptt
     *
     * @param float $aptt
     * @return CoagulationTest
     */
    public function setAptt($aptt)
    {
        $this->aptt = $aptt;
    
        return $this;
    }

    /**
     * Get aptt
     *
     * @return float 
     */
    public function getAptt()
    {
        return $this->aptt;
    }

    /**
     * Set fibrinogen
     *
     * @param float $fibrinogen
     * @return CoagulationTest
     */
    public function setFibrinogen($fibrinogen)
    {
        $this->fibrinogen = $fibrinogen;
    
        return $this;
    }

    /**
     * Get fibrinogen
     *
     * @return float 
     */
    public function getFibrinogen()
    {
        return $this->fibrinogen;
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
