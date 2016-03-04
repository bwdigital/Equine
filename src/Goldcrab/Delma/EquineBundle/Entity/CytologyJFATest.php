<?php

namespace Goldcrab\Delma\EquineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CytologyJFATest
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Goldcrab\Delma\EquineBundle\Entity\CytologyJFATestRepository")
 */
class CytologyJFATest
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cytology_jfa_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \Goldcrab\Delma\EquineBundle\Entity\Horse
     *
     * @ORM\ManyToOne(targetEntity="Horse")
     * @ORM\JoinColumn(name="cytology_jfa_horse_id", referencedColumnName="horse_id", nullable=false)
     * @Assert\NotBlank()
     */
    private $horse;

    /**
     * @var \Goldcrab\Delma\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Goldcrab\Delma\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="cytology_jfa_doctor_user_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank()
     */
    private $doctor;

    /**
     * @var \Goldcrab\Delma\UserBundle\Entity\User

     * @ORM\ManyToOne(targetEntity="Goldcrab\Delma\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="cytology_jfa_tested_user_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank()
     */
    private $testedBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cytology_jfa_testedDate", type="datetime", nullable=true)
     * @Assert\NotBlank()
     */
    private $testedDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cytology_jfa_sampleDate", type="datetime", nullable=true)
     */
    private $sampleDate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_jfa_slidePrepared", type="boolean", nullable=true)
     */
    private $slidePrepared;

    /**
     * @var string
     *
     * @ORM\Column(name="cytology_jfa_csaerobic", type="string", length=255, nullable=true)
     */
    private $csaerobic;

    /**
     * @var string
     *
     * @ORM\Column(name="cytology_jfa_csanaerobic", type="string", length=255, nullable=true)
     */
    private $csanaerobic;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_jfa_test1", type="boolean", nullable=true)
     */
    private $test1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_jfa_test2", type="boolean", nullable=true)
     */
    private $test2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_jfa_test3", type="boolean", nullable=true)
     */
    private $test3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_jfa_test4", type="boolean", nullable=true)
     */
    private $test4;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_jfa_test5", type="boolean", nullable=true)
     */
    private $test5;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_jfa_test6", type="boolean", nullable=true)
     */
    private $test6;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_jfa_test7", type="boolean", nullable=true)
     */
    private $test7;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_jfa_test8", type="boolean", nullable=true)
     */
    private $test8;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_jfa_test9", type="boolean", nullable=true)
     */
    private $test9;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_jfa_test10", type="boolean", nullable=true)
     */
    private $test10;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_jfa_test11", type="boolean", nullable=true)
     */
    private $test11;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cytology_jfa_test12", type="boolean", nullable=true)
     */
    private $test12;

    /**
     * @var float
     *
     * @ORM\Column(name="cytology_jfa_wbc", type="float", nullable=true)
     */
    private $wbc;

    /**
     * @var float
     *
     * @ORM\Column(name="cytology_jfa_pmn", type="float", nullable=true)
     */
    private $pmn;

    /**
     * @var float
     *
     * @ORM\Column(name="cytology_jfa_mononucl", type="float", nullable=true)
     */
    private $mononucl;

    /**
     * @var float
     *
     * @ORM\Column(name="cytology_jfa_tprefrac", type="float", nullable=true)
     */
    private $tprefrac;

    /**
     * @var float
     *
     * @ORM\Column(name="cytology_jfa_ast", type="float", nullable=true)
     */
    private $ast;

    /**
     * @var float
     *
     * @ORM\Column(name="cytology_jfa_ck", type="float", nullable=true)
     */
    private $ck;

    /**
     * @var float
     *
     * @ORM\Column(name="cytology_jfa_ld", type="float", nullable=true)
     */
    private $ld;

    /**
     * @var float
     *
     * @ORM\Column(name="cytology_jfa_alp", type="float", nullable=true)
     */
    private $alp;

    /**
     * @var float
     *
     * @ORM\Column(name="cytology_jfa_glucose", type="float", nullable=true)
     */
    private $glucose;

    /**
     * @var float
     *
     * @ORM\Column(name="cytology_jfa_lactate", type="float", nullable=true)
     */
    private $lactate;

    /**
     * @var string
     *
     * @ORM\Column(name="cytology_jfa_comments", type="text", nullable=true)
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
     * @return CytologyJFATest
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
     * @return CytologyJFATest
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
     * Set slidePrepared
     *
     * @param boolean $slidePrepared
     * @return CytologyJFATest
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
     * Set csaerobic
     *
     * @param string $csaerobic
     * @return CytologyJFATest
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
     * @return CytologyJFATest
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
     * @param boolean $test1
     * @return CytologyJFATest
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
     * @return CytologyJFATest
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
     * @return CytologyJFATest
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
     * @return CytologyJFATest
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
     * @return CytologyJFATest
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
     * @return CytologyJFATest
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
     * @return CytologyJFATest
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
     * @return CytologyJFATest
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
     * @return CytologyJFATest
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
     * @return CytologyJFATest
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
     * @return CytologyJFATest
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
     * @return CytologyJFATest
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

    /**
     * Set wbc
     *
     * @param float $wbc
     * @return CytologyJFATest
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
     * @return CytologyJFATest
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
     * @return CytologyJFATest
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
     * @return CytologyJFATest
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
     * Set ast
     *
     * @param float $ast
     * @return CytologyJFATest
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
     * Set ck
     *
     * @param float $ck
     * @return CytologyJFATest
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
     * Set ld
     *
     * @param float $ld
     * @return CytologyJFATest
     */
    public function setLd($ld)
    {
        $this->ld = $ld;
    
        return $this;
    }

    /**
     * Get ld
     *
     * @return float 
     */
    public function getLd()
    {
        return $this->ld;
    }

    /**
     * Set alp
     *
     * @param float $alp
     * @return CytologyJFATest
     */
    public function setAlp($alp)
    {
        $this->alp = $alp;
    
        return $this;
    }

    /**
     * Get alp
     *
     * @return float 
     */
    public function getAlp()
    {
        return $this->alp;
    }

    /**
     * Set glucose
     *
     * @param float $glucose
     * @return CytologyJFATest
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
     * @return CytologyJFATest
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

    /**
     * @return float
     */
    public function getLactate()
    {
        return $this->lactate;
    }

    /**
     * @param float $lactate
     */
    public function setLactate($lactate)
    {
        $this->lactate = $lactate;
    }


}
