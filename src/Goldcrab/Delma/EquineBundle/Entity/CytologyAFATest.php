<?php

namespace Goldcrab\Delma\EquineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CytologyAFATest
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Goldcrab\Delma\EquineBundle\Entity\CytologyAFATestRepository")
 */
class CytologyAFATest
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cytology_afa_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \Goldcrab\Delma\EquineBundle\Entity\Horse
     *
     * @ORM\ManyToOne(targetEntity="Horse")
     * @ORM\JoinColumn(name="cytology_afa_horse_id", referencedColumnName="horse_id", nullable=false)
     * @Assert\NotBlank()
     */
    private $horse;

    /**
     * @var \Goldcrab\Delma\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Goldcrab\Delma\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="cytology_afa_doctor_user_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank()
     */
    private $doctor;

    /**
     * @var \Goldcrab\Delma\UserBundle\Entity\User

     * @ORM\ManyToOne(targetEntity="Goldcrab\Delma\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="cytology_afa_tested_user_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank()
     */
    private $testedBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cytology_afa_testedDate", type="datetime", nullable=true)
     * @Assert\NotBlank()
     */
    private $testedDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cytology_afa_sampleDate", type="datetime", nullable=true)
     */
    private $sampleDate;

    /**
     * @var string
     *
     * @ORM\Column(name="cytology_afa_csaerobic", type="string", length=255, nullable=true)
     */
    private $csaerobic;

    /**
     * @var string
     *
     * @ORM\Column(name="cytology_afa_csanaerobic", type="string", length=255, nullable=true)
     */
    private $csanaerobic;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_afa_slidePrepared", type="boolean", nullable=true)
     */
    private $slidePrepared;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_afa_test1", type="boolean", nullable=true)
     */
    private $test1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_afa_test2", type="boolean", nullable=true)
     */
    private $test2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_afa_test3", type="boolean", nullable=true)
     */
    private $test3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_afa_test4", type="boolean", nullable=true)
     */
    private $test4;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_afa_test5", type="boolean", nullable=true)
     */
    private $test5;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_afa_test6", type="boolean", nullable=true)
     */
    private $test6;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_afa_test7", type="boolean", nullable=true)
     */
    private $test7;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_afa_test8", type="boolean", nullable=true)
     */
    private $test8;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_afa_test9", type="boolean", nullable=true)
     */
    private $test9;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_afa_test10", type="boolean", nullable=true)
     */
    private $test10;

    /**
     * @var float
     *
     * @ORM\Column(name="cytology_afa_wbc", type="float", nullable=true)
     */
    private $wbc;

    /**
     * @var float
     *
     * @ORM\Column(name="cytology_afa_pmn", type="float", nullable=true)
     */
    private $pmn;

    /**
     * @var float
     *
     * @ORM\Column(name="cytology_afa_mononucl", type="float", nullable=true)
     */
    private $mononucl;

    /**
     * @var float
     *
     * @ORM\Column(name="cytology_afa_tp", type="float", nullable=true)
     */
    private $tp;

    /**
     * @var float
     *
     * @ORM\Column(name="cytology_afa_ast", type="float", nullable=true)
     */
    private $ast;

    /**
     * @var float
     *
     * @ORM\Column(name="cytology_afa_tprefrac", type="float", nullable=true)
     */
    private $tprefrac;

    /**
     * @var float
     *
     * @ORM\Column(name="cytology_afa_ck", type="float", nullable=true)
     */
    private $ck;

    /**
     * @var float
     *
     * @ORM\Column(name="cytology_afa_glucose", type="float", nullable=true)
     */
    private $glucose;

    /**
     * @var float
     *
     * @ORM\Column(name="cytology_afa_alb", type="float", nullable=true)
     */
    private $alb;

    /**
     * @var string
     *
     * @ORM\Column(name="cytology_afa_comments", type="text", nullable=true)
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
     * @return CytologyAFATest
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
     * @return CytologyAFATest
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
     * @return CytologyAFATest
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
     * @return CytologyAFATest
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
     * Set slidePrepared
     *
     * @param boolean $slidePrepared
     * @return CytologyAFATest
     */
    public function setSlidePrepared($slidePrepared)
    {
        $this->slidePrepared = $slidePrepared;
    
        return $this;
    }

    /**
     * Get slidePrepared
     *
     * @return boolean 
     */
    public function getSlidePrepared()
    {
        return $this->slidePrepared;
    }

    /**
     * Set test1
     *
     * @param boolean $test1
     * @return CytologyAFATest
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
     * @return CytologyAFATest
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
     * @return CytologyAFATest
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
     * @return CytologyAFATest
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
     * @return CytologyAFATest
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
     * @return CytologyAFATest
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
     * @return CytologyAFATest
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
     * @return CytologyAFATest
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
     * @return CytologyAFATest
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
     * @return CytologyAFATest
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
     * Set wbc
     *
     * @param float $wbc
     * @return CytologyAFATest
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
     * @return CytologyAFATest
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
     * @return CytologyAFATest
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
     * Set tp
     *
     * @param float $tp
     * @return CytologyAFATest
     */
    public function setTp($tp)
    {
        $this->tp = $tp;
    
        return $this;
    }

    /**
     * Get tp
     *
     * @return float 
     */
    public function getTp()
    {
        return $this->tp;
    }

    /**
     * Set ast
     *
     * @param float $ast
     * @return CytologyAFATest
     */
    public function setAst($ast)
    {
        $this->ast = $ast;
    
        return $this;
    }

    /**
     * Get ast
     *
     * @return float 
     */
    public function getAst()
    {
        return $this->ast;
    }

    /**
     * Set tprefrac
     *
     * @param float $tprefrac
     * @return CytologyAFATest
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
     * Set ck
     *
     * @param float $ck
     * @return CytologyAFATest
     */
    public function setCk($ck)
    {
        $this->ck = $ck;
    
        return $this;
    }

    /**
     * Get ck
     *
     * @return float 
     */
    public function getCk()
    {
        return $this->ck;
    }

    /**
     * Set glucose
     *
     * @param float $glucose
     * @return CytologyAFATest
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
     * Set alb
     *
     * @param float $alb
     * @return CytologyAFATest
     */
    public function setAlb($alb)
    {
        $this->alb = $alb;
    
        return $this;
    }

    /**
     * Get alb
     *
     * @return float 
     */
    public function getAlb()
    {
        return $this->alb;
    }

    /**
     * Set comments
     *
     * @param string $comments
     * @return CytologyAFATest
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
