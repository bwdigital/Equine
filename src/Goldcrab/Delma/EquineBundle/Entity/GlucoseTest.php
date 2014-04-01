<?php

namespace Goldcrab\Delma\EquineBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * GlucoseTest
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Goldcrab\Delma\EquineBundle\Entity\GlucoseTestRepository")
 */
class GlucoseTest
{
    /**
     * @var integer
     *
     * @ORM\Column(name="glucose_id", type="integer")
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
     * @ORM\Column(name="testedDate", type="datetime")
     * @Assert\NotBlank()
     */
    private $testedDate;

    /**
     * @var ArrayCollection $testValues
     *
     * @ORM\OneToMany(targetEntity="GlucoseEntry", mappedBy="glucoseTest", cascade={"persist", "remove"})
     * @ORM\OrderBy({"time" = "asc"})
     */
    private $testValues;


    /**
     * @var string
     *
     * @ORM\Column(name="glucose_comments", type="text", nullable=true)
     */
    private $comments;

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $testValues
     */
    public function setTestValues(ArrayCollection $testValues)
    {
        foreach($testValues as $testValue){
            /**
             * @var GlucoseEntry $testValue
             */
            $testValue->setGlucoseTest($this);
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

    public function removeTestValue(GlucoseEntry $testValue){
        $this->testValues->removeElement($testValue);
    }


    function __construct()
    {
        $this->testValues = new ArrayCollection();
    }



//    public function addTestValue(GlucoseEntries $entry){
//        $this->testValues->add()
//    }

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
     * @return GlucoseTest
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


}
