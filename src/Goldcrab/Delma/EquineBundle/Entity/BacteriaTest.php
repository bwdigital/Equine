<?php

namespace Goldcrab\Delma\EquineBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * BacteriaTest
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Goldcrab\Delma\EquineBundle\Entity\BacteriaTestRepository")
 */
class BacteriaTest
{
    /**
     * @var integer
     *
     * @ORM\Column(name="bacteria_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \Goldcrab\Delma\EquineBundle\Entity\Horse
     *
     * @ORM\ManyToOne(targetEntity="Horse")
     * @ORM\JoinColumn(name="blood_horse_id", referencedColumnName="horse_id", nullable=false)
     * @Assert\NotBlank()
     */
    private $horse;

    /**
     * @var \Goldcrab\Delma\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Goldcrab\Delma\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="blood_doctor_user_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank()
     */
    private $doctor;

    /**
     * @var \Goldcrab\Delma\UserBundle\Entity\User

     * @ORM\ManyToOne(targetEntity="Goldcrab\Delma\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="blood_tested_user_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank()
     */
    private $testedBy;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="bacteria_testedDate", type="datetime")
     * @Assert\NotBlank()
     */
    private $testedDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="bacteria_sampleDate", type="datetime", nullable=true)
     */
    private $sampleDate;

    /**
     * @var string
     *
     * @ORM\Column(name="bacteria_swabSource", type="string", length=250, nullable=true)
     */
    private $swabSource;

    /**
     * @var string
     *
     * @ORM\Column(name="bacteria_gramStain", type="string", length=250, nullable=true)
     */
    private $gramStain;

    /**
     * @var string
     *
     * @ORM\Column(name="bacteria_bacteriaIsolation", type="string", length=250, nullable=true)
     */
    private $bacteriaIsolation;

    /**
     * @var string
     *
     * @ORM\Column(name="bacteria_fungiIsolation", type="string", length=250, nullable=true)
     */
    private $fungiIsolation;

    /**
     * @var string
     *
     * @ORM\Column(name="bacteria_comments", type="text", nullable=true)
     */
    private $comments;

    /**
     * @var ArrayCollection $testValues
     *
     * @ORM\OneToMany(targetEntity="BacteriaEntry", mappedBy="bacteriaTest", cascade={"persist", "remove"})
     * @ORM\OrderBy({"antibiotics" = "asc"})
     */
    private $testValues;

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $testValues
     */
    public function setTestValues(ArrayCollection $testValues)
    {
        foreach($testValues as $testValue){
            /**
             * @var BacteriaEntry $testValue
             */
            $testValue->setBacteriaTest($this);
        }
        $this->testValues = $testValues;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getTestValues()
    {
        return $this->testValues;
    }

    public function removeTestValue(BacteriaEntry $testValue){
        $this->testValues->removeElement($testValue);
    }


    function __construct()
    {
        $this->testValues = new ArrayCollection();
    }


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
     * @return BacteriaTest
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
     * @param string $bacteriaIsolation
     */
    public function setBacteriaIsolation($bacteriaIsolation)
    {
        $this->bacteriaIsolation = $bacteriaIsolation;
    }

    /**
     * @return string
     */
    public function getBacteriaIsolation()
    {
        return $this->bacteriaIsolation;
    }

    /**
     * @param string $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    /**
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param string $fungiIsolation
     */
    public function setFungiIsolation($fungiIsolation)
    {
        $this->fungiIsolation = $fungiIsolation;
    }

    /**
     * @return string
     */
    public function getFungiIsolation()
    {
        return $this->fungiIsolation;
    }

    /**
     * @param string $gramStain
     */
    public function setGramStain($gramStain)
    {
        $this->gramStain = $gramStain;
    }

    /**
     * @return string
     */
    public function getGramStain()
    {
        return $this->gramStain;
    }

    /**
     * @param \DateTime $sampleDate
     */
    public function setSampleDate($sampleDate)
    {
        $this->sampleDate = $sampleDate;
    }

    /**
     * @return \DateTime
     */
    public function getSampleDate()
    {
        return $this->sampleDate;
    }

    /**
     * @param string $swabSource
     */
    public function setSwabSource($swabSource)
    {
        $this->swabSource = $swabSource;
    }

    /**
     * @return string
     */
    public function getSwabSource()
    {
        return $this->swabSource;
    }


}
