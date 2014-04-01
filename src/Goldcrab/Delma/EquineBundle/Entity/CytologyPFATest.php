<?php

namespace Goldcrab\Delma\EquineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CytologyPFATest
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Goldcrab\Delma\EquineBundle\Entity\CytologyPFATestRepository")
 */
class CytologyPFATest
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cytology_pfa_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \Goldcrab\Delma\EquineBundle\Entity\Horse
     *
     * @ORM\ManyToOne(targetEntity="Horse")
     * @ORM\JoinColumn(name="cytology_pfa_horse_id", referencedColumnName="horse_id", nullable=false)
     * @Assert\NotBlank()
     */
    private $horse;

    /**
     * @var \Goldcrab\Delma\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Goldcrab\Delma\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="cytology_pfa_doctor_user_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank()
     */
    private $doctor;

    /**
     * @var \Goldcrab\Delma\UserBundle\Entity\User

     * @ORM\ManyToOne(targetEntity="Goldcrab\Delma\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="cytology_pfa_tested_user_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank()
     */
    private $testedBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cytology_pfa_testedDate", type="datetime", nullable=true)
     * @Assert\NotBlank()
     */
    private $testedDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cytology_pfa_sampleDate", type="datetime", nullable=true)
     */
    private $sampleDate;

    /**
     * @var string
     *
     * @ORM\Column(name="cytology_pfa_csaerobic", type="string", length=255, nullable=true)
     */
    private $csaerobic;

    /**
     * @var string
     *
     * @ORM\Column(name="cytology_pfa_csanaerobic", type="string", length=255, nullable=true)
     */
    private $csanaerobic;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_pfa_test1", type="boolean", nullable=true)
     */
    private $test1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_pfa_test2", type="boolean", nullable=true)
     */
    private $test2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_pfa_test3", type="boolean", nullable=true)
     */
    private $test3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_pfa_test4", type="boolean", nullable=true)
     */
    private $test4;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_pfa_test5", type="boolean", nullable=true)
     */
    private $test5;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_pfa_test6", type="boolean", nullable=true)
     */
    private $test6;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_pfa_test7", type="boolean", nullable=true)
     */
    private $test7;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_pfa_test8", type="boolean", nullable=true)
     */
    private $test8;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_pfa_test9", type="boolean", nullable=true)
     */
    private $test9;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_pfa_test10", type="boolean", nullable=true)
     */
    private $test10;

    /**
     * @var float
     *
     * @ORM\Column(name="cytology_pfa_wbc", type="float", nullable=true)
     */
    private $wbc;

    /**
     * @var float
     *
     * @ORM\Column(name="cytology_pfa_pmn", type="float", nullable=true)
     */
    private $pmn;

    /**
     * @var float
     *
     * @ORM\Column(name="cytology_pfa_mononucl", type="float", nullable=true)
     */
    private $mononucl;

    /**
     * @var float
     *
     * @ORM\Column(name="cytology_pfa_tprefrac", type="float", nullable=true)
     */
    private $tprefrac;

    /**
     * @var float
     *
     * @ORM\Column(name="cytology_pfa_lactate", type="float", nullable=true)
     */
    private $lactate;

    /**
     * @var float
     *
     * @ORM\Column(name="cytology_pfa_triglyc", type="float", nullable=true)
     */
    private $triglyc;

    /**
     * @var float
     *
     * @ORM\Column(name="cytology_pfa_glucose", type="float", nullable=true)
     */
    private $glucose;

    /**
     * @var string
     *
     * @ORM\Column(name="cytology_pfa_comments", type="text", nullable=true)
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
     * @return CytologyPFATest
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
     * Set sampleDate
     *
     * @param \DateTime $sampleDate
     * @return CytologyPFATest
     */
    public function setSampleDate($sampleDate)
    {
        $this->sampleDate = $sampleDate;
    
        return $this;
    }

    /**
     * Get sampleDate
     *
     * @return \DateTime 
     */
    public function getSampleDate()
    {
        return $this->sampleDate;
    }

    /**
     * Set csaerobic
     *
     * @param string $csaerobic
     * @return CytologyPFATest
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
     * @return CytologyPFATest
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
     * Set test1
     *
     * @param float $test1
     * @return CytologyPFATest
     */
    public function setTest1($test1)
    {
        $this->test1 = $test1;
    
        return $this;
    }

    /**
     * Get test1
     *
     * @return float 
     */
    public function getTest1()
    {
        return $this->test1;
    }

    /**
     * Set test2
     *
     * @param float $test2
     * @return CytologyPFATest
     */
    public function setTest2($test2)
    {
        $this->test2 = $test2;
    
        return $this;
    }

    /**
     * Get test2
     *
     * @return float 
     */
    public function getTest2()
    {
        return $this->test2;
    }

    /**
     * Set test3
     *
     * @param float $test3
     * @return CytologyPFATest
     */
    public function setTest3($test3)
    {
        $this->test3 = $test3;
    
        return $this;
    }

    /**
     * Get test3
     *
     * @return float 
     */
    public function getTest3()
    {
        return $this->test3;
    }

    /**
     * Set test4
     *
     * @param float $test4
     * @return CytologyPFATest
     */
    public function setTest4($test4)
    {
        $this->test4 = $test4;
    
        return $this;
    }

    /**
     * Get test4
     *
     * @return float 
     */
    public function getTest4()
    {
        return $this->test4;
    }

    /**
     * Set test5
     *
     * @param float $test5
     * @return CytologyPFATest
     */
    public function setTest5($test5)
    {
        $this->test5 = $test5;
    
        return $this;
    }

    /**
     * Get test5
     *
     * @return float 
     */
    public function getTest5()
    {
        return $this->test5;
    }

    /**
     * Set test6
     *
     * @param float $test6
     * @return CytologyPFATest
     */
    public function setTest6($test6)
    {
        $this->test6 = $test6;
    
        return $this;
    }

    /**
     * Get test6
     *
     * @return float 
     */
    public function getTest6()
    {
        return $this->test6;
    }

    /**
     * Set test7
     *
     * @param float $test7
     * @return CytologyPFATest
     */
    public function setTest7($test7)
    {
        $this->test7 = $test7;
    
        return $this;
    }

    /**
     * Get test7
     *
     * @return float 
     */
    public function getTest7()
    {
        return $this->test7;
    }

    /**
     * Set test8
     *
     * @param float $test8
     * @return CytologyPFATest
     */
    public function setTest8($test8)
    {
        $this->test8 = $test8;
    
        return $this;
    }

    /**
     * Get test8
     *
     * @return float 
     */
    public function getTest8()
    {
        return $this->test8;
    }

    /**
     * Set test9
     *
     * @param float $test9
     * @return CytologyPFATest
     */
    public function setTest9($test9)
    {
        $this->test9 = $test9;
    
        return $this;
    }

    /**
     * Get test9
     *
     * @return float 
     */
    public function getTest9()
    {
        return $this->test9;
    }

    /**
     * Set test10
     *
     * @param float $test10
     * @return CytologyPFATest
     */
    public function setTest10($test10)
    {
        $this->test10 = $test10;
    
        return $this;
    }

    /**
     * Get test10
     *
     * @return float 
     */
    public function getTest10()
    {
        return $this->test10;
    }

    /**
     * Set wbc
     *
     * @param float $wbc
     * @return CytologyPFATest
     */
    public function setWbc($wbc)
    {
        $this->wbc = $wbc;
    
        return $this;
    }

    /**
     * Get wbc
     *
     * @return float 
     */
    public function getWbc()
    {
        return $this->wbc;
    }

    /**
     * Set pmn
     *
     * @param float $pmn
     * @return CytologyPFATest
     */
    public function setPmn($pmn)
    {
        $this->pmn = $pmn;
    
        return $this;
    }

    /**
     * Get pmn
     *
     * @return float 
     */
    public function getPmn()
    {
        return $this->pmn;
    }

    /**
     * Set mononucl
     *
     * @param float $mononucl
     * @return CytologyPFATest
     */
    public function setMononucl($mononucl)
    {
        $this->mononucl = $mononucl;
    
        return $this;
    }

    /**
     * Get mononucl
     *
     * @return float 
     */
    public function getMononucl()
    {
        return $this->mononucl;
    }

    /**
     * Set tprefrac
     *
     * @param float $tprefrac
     * @return CytologyPFATest
     */
    public function setTprefrac($tprefrac)
    {
        $this->tprefrac = $tprefrac;
    
        return $this;
    }

    /**
     * Get tprefrac
     *
     * @return float 
     */
    public function getTprefrac()
    {
        return $this->tprefrac;
    }

    /**
     * Set lactate
     *
     * @param float $lactate
     * @return CytologyPFATest
     */
    public function setLactate($lactate)
    {
        $this->lactate = $lactate;
    
        return $this;
    }

    /**
     * Get lactate
     *
     * @return float 
     */
    public function getLactate()
    {
        return $this->lactate;
    }

    /**
     * Set triglyc
     *
     * @param float $triglyc
     * @return CytologyPFATest
     */
    public function setTriglyc($triglyc)
    {
        $this->triglyc = $triglyc;
    
        return $this;
    }

    /**
     * Get triglyc
     *
     * @return float 
     */
    public function getTriglyc()
    {
        return $this->triglyc;
    }

    /**
     * Set glucose
     *
     * @param float $glucose
     * @return CytologyPFATest
     */
    public function setGlucose($glucose)
    {
        $this->glucose = $glucose;
    
        return $this;
    }

    /**
     * Get glucose
     *
     * @return float 
     */
    public function getGlucose()
    {
        return $this->glucose;
    }

    /**
     * Set comments
     *
     * @param string $comments
     * @return CytologyPFATest
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
