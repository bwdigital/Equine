<?php

namespace Goldcrab\Delma\EquineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CytologyGeneralTest
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Goldcrab\Delma\EquineBundle\Entity\CytologyGeneralTestRepository")
 */
class CytologyGeneralTest
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cytology_general_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \Goldcrab\Delma\EquineBundle\Entity\Horse
     *
     * @ORM\ManyToOne(targetEntity="Horse")
     * @ORM\JoinColumn(name="cytology_general_horse_id", referencedColumnName="horse_id", nullable=false)
     * @Assert\NotBlank()
     */
    private $horse;

    /**
     * @var \Goldcrab\Delma\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Goldcrab\Delma\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="cytology_general_doctor_user_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank()
     */
    private $doctor;

    /**
     * @var \Goldcrab\Delma\UserBundle\Entity\User

     * @ORM\ManyToOne(targetEntity="Goldcrab\Delma\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="cytology_general_tested_user_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank()
     */
    private $testedBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cytology_general_testedDate", type="datetime", nullable=true)
     * @Assert\NotBlank()
     */
    private $testedDate;

    /**
     * @var string
     *
     * @ORM\Column(name="cytology_general_cellSamplePrep", type="string", length=255, nullable=true)
     */
    private $cellSamplePrep;

    /**
     * @var string
     *
     * @ORM\Column(name="cytology_general_sampleStain", type="string", length=255, nullable=true)
     */
    private $sampleStain;

    /**
     * @var string
     *
     * @ORM\Column(name="cytology_general_csaerobic", type="string", length=255, nullable=true)
     */
    private $csaerobic;

    /**
     * @var string
     *
     * @ORM\Column(name="cytology_general_csanaerobic", type="string", length=255, nullable=true)
     */
    private $csanaerobic;

    /**
     * @var string
     *
     * @ORM\Column(name="cytology_general_microscopicEval", type="text", nullable=true)
     */
    private $microscopicEval;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_general_test1", type="boolean", nullable=true)
     */
    private $test1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_general_test2", type="boolean", nullable=true)
     */
    private $test2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_general_test3", type="boolean", nullable=true)
     */
    private $test3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_general_test4", type="boolean", nullable=true)
     */
    private $test4;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_general_test5", type="boolean", nullable=true)
     */
    private $test5;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_general_test6", type="boolean", nullable=true)
     */
    private $test6;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_general_test7", type="boolean", nullable=true)
     */
    private $test7;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_general_test8", type="boolean", nullable=true)
     */
    private $test8;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_general_test9", type="boolean", nullable=true)
     */
    private $test9;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_general_test10", type="boolean", nullable=true)
     */
    private $test10;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_general_test11", type="boolean", nullable=true)
     */
    private $test11;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_general_test12", type="boolean", nullable=true)
     */
    private $test12;


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
     * @return CytologyTTWTest
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
     * Set cellSamplePrep
     *
     * @param string $cellSamplePrep
     * @return CytologyTTWTest
     */
    public function setCellSamplePrep($cellSamplePrep)
    {
        $this->cellSamplePrep = $cellSamplePrep;
    
        return $this;
    }

    /**
     * Get cellSamplePrep
     *
     * @return string 
     */
    public function getCellSamplePrep()
    {
        return $this->cellSamplePrep;
    }

    /**
     * Set sampleStain
     *
     * @param string $sampleStain
     * @return CytologyTTWTest
     */
    public function setSampleStain($sampleStain)
    {
        $this->sampleStain = $sampleStain;
    
        return $this;
    }

    /**
     * Get sampleStain
     *
     * @return string 
     */
    public function getSampleStain()
    {
        return $this->sampleStain;
    }

    /**
     * Set csaerobic
     *
     * @param string $csaerobic
     * @return CytologyTTWTest
     */
    public function setCsaerobic($csaerobic)
    {
        $this->csaerobic = $csaerobic;
    
        return $this;
    }

    /**
     * Get csaerobic
     *
     * @return string 
     */
    public function getCsaerobic()
    {
        return $this->csaerobic;
    }

    /**
     * Set csanaerobic
     *
     * @param string $csanaerobic
     * @return CytologyTTWTest
     */
    public function setCsanaerobic($csanaerobic)
    {
        $this->csanaerobic = $csanaerobic;
    
        return $this;
    }

    /**
     * Get csanaerobic
     *
     * @return string 
     */
    public function getCsanaerobic()
    {
        return $this->csanaerobic;
    }

    /**
     * Set microscopicEval
     *
     * @param string $microscopicEval
     * @return CytologyTTWTest
     */
    public function setMicroscopicEval($microscopicEval)
    {
        $this->microscopicEval = $microscopicEval;
    
        return $this;
    }

    /**
     * Get microscopicEval
     *
     * @return string 
     */
    public function getMicroscopicEval()
    {
        return $this->microscopicEval;
    }

    /**
     * Set test1
     *
     * @param boolean $test1
     * @return CytologyTTWTest
     */
    public function setTest1($test1)
    {
        $this->test1 = $test1;
    
        return $this;
    }

    /**
     * Get test1
     *
     * @return boolean 
     */
    public function getTest1()
    {
        return $this->test1;
    }

    /**
     * Set test2
     *
     * @param boolean $test2
     * @return CytologyTTWTest
     */
    public function setTest2($test2)
    {
        $this->test2 = $test2;
    
        return $this;
    }

    /**
     * Get test2
     *
     * @return boolean 
     */
    public function getTest2()
    {
        return $this->test2;
    }

    /**
     * Set test3
     *
     * @param boolean $test3
     * @return CytologyTTWTest
     */
    public function setTest3($test3)
    {
        $this->test3 = $test3;
    
        return $this;
    }

    /**
     * Get test3
     *
     * @return boolean 
     */
    public function getTest3()
    {
        return $this->test3;
    }

    /**
     * Set test4
     *
     * @param boolean $test4
     * @return CytologyTTWTest
     */
    public function setTest4($test4)
    {
        $this->test4 = $test4;
    
        return $this;
    }

    /**
     * Get test4
     *
     * @return boolean 
     */
    public function getTest4()
    {
        return $this->test4;
    }

    /**
     * Set test5
     *
     * @param boolean $test5
     * @return CytologyTTWTest
     */
    public function setTest5($test5)
    {
        $this->test5 = $test5;
    
        return $this;
    }

    /**
     * Get test5
     *
     * @return boolean 
     */
    public function getTest5()
    {
        return $this->test5;
    }

    /**
     * Set test6
     *
     * @param boolean $test6
     * @return CytologyTTWTest
     */
    public function setTest6($test6)
    {
        $this->test6 = $test6;
    
        return $this;
    }

    /**
     * Get test6
     *
     * @return boolean 
     */
    public function getTest6()
    {
        return $this->test6;
    }

    /**
     * Set test7
     *
     * @param boolean $test7
     * @return CytologyTTWTest
     */
    public function setTest7($test7)
    {
        $this->test7 = $test7;
    
        return $this;
    }

    /**
     * Get test7
     *
     * @return boolean 
     */
    public function getTest7()
    {
        return $this->test7;
    }

    /**
     * Set test8
     *
     * @param boolean $test8
     * @return CytologyTTWTest
     */
    public function setTest8($test8)
    {
        $this->test8 = $test8;
    
        return $this;
    }

    /**
     * Get test8
     *
     * @return boolean 
     */
    public function getTest8()
    {
        return $this->test8;
    }

    /**
     * Set test9
     *
     * @param boolean $test9
     * @return CytologyTTWTest
     */
    public function setTest9($test9)
    {
        $this->test9 = $test9;
    
        return $this;
    }

    /**
     * Get test9
     *
     * @return boolean 
     */
    public function getTest9()
    {
        return $this->test9;
    }

    /**
     * Set test10
     *
     * @param boolean $test10
     * @return CytologyTTWTest
     */
    public function setTest10($test10)
    {
        $this->test10 = $test10;
    
        return $this;
    }

    /**
     * Get test10
     *
     * @return boolean 
     */
    public function getTest10()
    {
        return $this->test10;
    }

    /**
     * Set test11
     *
     * @param boolean $test11
     * @return CytologyTTWTest
     */
    public function setTest11($test11)
    {
        $this->test11 = $test11;
    
        return $this;
    }

    /**
     * Get test11
     *
     * @return boolean 
     */
    public function getTest11()
    {
        return $this->test11;
    }

    /**
     * Set test12
     *
     * @param boolean $test12
     * @return CytologyTTWTest
     */
    public function setTest12($test12)
    {
        $this->test12 = $test12;
    
        return $this;
    }

    /**
     * Get test12
     *
     * @return boolean 
     */
    public function getTest12()
    {
        return $this->test12;
    }
}
