<?php

namespace Goldcrab\Delma\EquineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * BloodTest
 *
 * @ORM\Table(name="BloodTest")
 * @ORM\Entity(repositoryClass="Goldcrab\Delma\EquineBundle\Entity\BloodTestRepository")
 */
class BloodTest
{
    /**
     * @var integer
     *
     * @ORM\Column(name="blood_id", type="integer")
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
     * @ORM\Column(name="blood_testedDate", type="datetime", nullable=false)
     * @Assert\NotBlank()
     */
    private $testedDate;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_h_wbc", type="float", nullable=true)
     */
    private $hWbc = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_h_rbc", type="float", nullable=true)
     */
    private $hRbc = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_h_hb", type="float", nullable=true)
     */
    private $hHb = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_h_hct", type="float", nullable=true)
     */
    private $hHct = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_h_mch", type="float", nullable=true)
     */
    private $hMch = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_h_mcv", type="float", nullable=true)
     */
    private $hMcv = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_h_mchc", type="float", nullable=true)
     */
    private $hMchc = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_h_plt", type="float", nullable=true)
     */
    private $hPlt = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_h_neut", type="float", nullable=true)
     */
    private $hNeut = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_h_neut2", type="float", nullable=true)
     */
    private $hNeut2 = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_h_lymph", type="float", nullable=true)
     */
    private $hLymph = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_h_lymph2", type="float", nullable=true)
     */
    private $hLymph2 = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_h_mono", type="float", nullable=true)
     */
    private $hMono = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_h_mono2", type="float", nullable=true)
     */
    private $hMono2 = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_h_eosino", type="float", nullable=true)
     */
    private $hEosino = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_h_eosino2", type="float", nullable=true)
     */
    private $hEosino2 = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_h_baso", type="float", nullable=true)
     */
    private $hBaso = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_h_baso2", type="float", nullable=true)
     */
    private $hBaso2 = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_h_bands", type="float", nullable=true)
     */
    private $hBands = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_h_ptp", type="float", nullable=true)
     */
    private $hPtp = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_h_hp_fib", type="float", nullable=true)
     */
    private $hHpFib = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_c_alb", type="float", nullable=true)
     */
    private $cAlb = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_c_alp", type="float", nullable=true)
     */
    private $cAlp = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_c_ast", type="float", nullable=true)
     */
    private $cAst = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_c_ck", type="float", nullable=true)
     */
    private $cCk = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_c_crea", type="float", nullable=true)
     */
    private $cCrea = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_c_d_bil", type="float", nullable=true)
     */
    private $cDBil = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_c_gct", type="float", nullable=true)
     */
    private $cGct = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_c_gluc", type="float", nullable=true)
     */
    private $cGluc = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_c_ld", type="float", nullable=true)
     */
    private $cLd = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_c_t_bil", type="float", nullable=true)
     */
    private $cTBil = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_c_stp", type="float", nullable=true)
     */
    private $cStp = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_c_un", type="float", nullable=true)
     */
    private $cUn = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_c_trig", type="float", nullable=true)
     */
    private $cTrig = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_c_lactate", type="float", nullable=true)
     */
    private $cLactate = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_c_saa", type="float", nullable=true)
     */
    private $cSaa = -1.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_c_lac", type="float", nullable=true)
     */
    private $cLac = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_c_iron", type="float", nullable=true)
     */
    private $cIron = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_c_troponin", type="float", nullable=true)
     */
    private $cTroponin = -1.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_c_phos", type="float", nullable=true)
     */
    private $cPhos = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_c_foal", type="string", length=100, nullable=true)
     */
    private $cFoal =  '';

    /**
     * @var boolean
     *
     * @ORM\Column(name="blood_c_extra", type="boolean", nullable=true)
     */
    private $cExtra = true;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_e_gluc", type="float", nullable=true)
     */
    private $eGluc = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_e_bun", type="float", nullable=true)
     */
    private $eBun = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_e_na", type="float", nullable=true)
     */
    private $eNa = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_e_k", type="float", nullable=true)
     */
    private $eK = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_e_cl", type="float", nullable=true)
     */
    private $eCl = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_e_hct", type="float", nullable=true)
     */
    private $eHct = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_e_hb", type="float", nullable=true)
     */
    private $eHb = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_e_ph", type="float", nullable=true)
     */
    private $ePh = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_e_bicarb", type="float", nullable=true)
     */
    private $eBicarb = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_e_mg", type="float", nullable=true)
     */
    private $eMg = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_e_ca", type="float", nullable=true)
     */
    private $eCa = 0.0;

    /**
     * @var float
     *
     * @ORM\Column(name="blood_e_ica", type="float", nullable=true)
     */
    private $eIca = 0.0;

    /**
     * @var string
     *
     * @ORM\Column(name="glucose_comments", type="text", nullable=true)
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
     * @param \DateTime $testedDate
     */
    public function setTestedDate($testedDate)
    {
        $this->testedDate = $testedDate;
    }

    /**
     * @return \DateTime
     */
    public function getTestedDate()
    {
        return $this->testedDate;
    }

    /**
     * Set hWbc
     *
     * @param float $hWbc
     * @return BloodTest
     */
    public function setHWbc($hWbc)
    {
        $this->hWbc = $hWbc;
    
        return $this;
    }

    /**
     * Get hWbc
     *
     * @return float 
     */
    public function getHWbc()
    {
        return $this->hWbc;
    }

    /**
     * Set hRbc
     *
     * @param float $hRbc
     * @return BloodTest
     */
    public function setHRbc($hRbc)
    {
        $this->hRbc = $hRbc;
    
        return $this;
    }

    /**
     * Get hRbc
     *
     * @return float 
     */
    public function getHRbc()
    {
        return $this->hRbc;
    }

    /**
     * Set hHb
     *
     * @param float $hHb
     * @return BloodTest
     */
    public function setHHb($hHb)
    {
        $this->hHb = $hHb;
    
        return $this;
    }

    /**
     * Get hHb
     *
     * @return float 
     */
    public function getHHb()
    {
        return $this->hHb;
    }

    /**
     * Set hHct
     *
     * @param float $hHct
     * @return BloodTest
     */
    public function setHHct($hHct)
    {
        $this->hHct = $hHct;
    
        return $this;
    }

    /**
     * Get hHct
     *
     * @return float 
     */
    public function getHHct()
    {
        return $this->hHct;
    }

    /**
     * Set hMch
     *
     * @param float $hMch
     * @return BloodTest
     */
    public function setHMch($hMch)
    {
        $this->hMch = $hMch;
    
        return $this;
    }

    /**
     * Get hMch
     *
     * @return float 
     */
    public function getHMch()
    {
        return $this->hMch;
    }

    /**
     * Set hMcv
     *
     * @param float $hMcv
     * @return BloodTest
     */
    public function setHMcv($hMcv)
    {
        $this->hMcv = $hMcv;
    
        return $this;
    }

    /**
     * Get hMcv
     *
     * @return float 
     */
    public function getHMcv()
    {
        return $this->hMcv;
    }

    /**
     * Set hMchc
     *
     * @param float $hMchc
     * @return BloodTest
     */
    public function setHMchc($hMchc)
    {
        $this->hMchc = $hMchc;
    
        return $this;
    }

    /**
     * Get hMchc
     *
     * @return float 
     */
    public function getHMchc()
    {
        return $this->hMchc;
    }

    /**
     * Set hPlt
     *
     * @param float $hPlt
     * @return BloodTest
     */
    public function setHPlt($hPlt)
    {
        $this->hPlt = $hPlt;
    
        return $this;
    }

    /**
     * Get hPlt
     *
     * @return float 
     */
    public function getHPlt()
    {
        return $this->hPlt;
    }

    /**
     * Set hNeut
     *
     * @param float $hNeut
     * @return BloodTest
     */
    public function setHNeut($hNeut)
    {
        $this->hNeut = $hNeut;
    
        return $this;
    }

    /**
     * Get hNeut
     *
     * @return float 
     */
    public function getHNeut()
    {
        return $this->hNeut;
    }

    /**
     * Set hLymph
     *
     * @param float $hLymph
     * @return BloodTest
     */
    public function setHLymph($hLymph)
    {
        $this->hLymph = $hLymph;
    
        return $this;
    }

    /**
     * Get hLymph
     *
     * @return float 
     */
    public function getHLymph()
    {
        return $this->hLymph;
    }

    /**
     * Set hMono
     *
     * @param float $hMono
     * @return BloodTest
     */
    public function setHMono($hMono)
    {
        $this->hMono = $hMono;
    
        return $this;
    }

    /**
     * Get hMono
     *
     * @return float 
     */
    public function getHMono()
    {
        return $this->hMono;
    }

    /**
     * Set hEosino
     *
     * @param float $hEosino
     * @return BloodTest
     */
    public function setHEosino($hEosino)
    {
        $this->hEosino = $hEosino;
    
        return $this;
    }

    /**
     * Get hEosino
     *
     * @return float 
     */
    public function getHEosino()
    {
        return $this->hEosino;
    }

    /**
     * Set hBaso
     *
     * @param float $hBaso
     * @return BloodTest
     */
    public function setHBaso($hBaso)
    {
        $this->hBaso = $hBaso;
    
        return $this;
    }

    /**
     * Get hBaso
     *
     * @return float 
     */
    public function getHBaso()
    {
        return $this->hBaso;
    }

    /**
     * Set hBands
     *
     * @param float $hBands
     * @return BloodTest
     */
    public function setHBands($hBands)
    {
        $this->hBands = $hBands;
    
        return $this;
    }

    /**
     * Get hBands
     *
     * @return float 
     */
    public function getHBands()
    {
        return $this->hBands;
    }

    /**
     * Set hPtp
     *
     * @param float $hPtp
     * @return BloodTest
     */
    public function setHPtp($hPtp)
    {
        $this->hPtp = $hPtp;
    
        return $this;
    }

    /**
     * Get hPtp
     *
     * @return float 
     */
    public function getHPtp()
    {
        return $this->hPtp;
    }

    /**
     * Set hHpFib
     *
     * @param float $hHpFib
     * @return BloodTest
     */
    public function setHHpFib($hHpFib)
    {
        $this->hHpFib = $hHpFib;
    
        return $this;
    }

    /**
     * Get hHpFib
     *
     * @return float 
     */
    public function getHHpFib()
    {
        return $this->hHpFib;
    }

    /**
     * Set cAlb
     *
     * @param float $cAlb
     * @return BloodTest
     */
    public function setCAlb($cAlb)
    {
        $this->cAlb = $cAlb;
    
        return $this;
    }

    /**
     * Get cAlb
     *
     * @return float 
     */
    public function getCAlb()
    {
        return $this->cAlb;
    }

    /**
     * Set cAlp
     *
     * @param float $cAlp
     * @return BloodTest
     */
    public function setCAlp($cAlp)
    {
        $this->cAlp = $cAlp;
    
        return $this;
    }

    /**
     * Get cAlp
     *
     * @return float 
     */
    public function getCAlp()
    {
        return $this->cAlp;
    }

    /**
     * Set cAst
     *
     * @param float $cAst
     * @return BloodTest
     */
    public function setCAst($cAst)
    {
        $this->cAst = $cAst;
    
        return $this;
    }

    /**
     * Get cAst
     *
     * @return float 
     */
    public function getCAst()
    {
        return $this->cAst;
    }

    /**
     * Set cCk
     *
     * @param float $cCk
     * @return BloodTest
     */
    public function setCCk($cCk)
    {
        $this->cCk = $cCk;
    
        return $this;
    }

    /**
     * Get cCk
     *
     * @return float 
     */
    public function getCCk()
    {
        return $this->cCk;
    }

    /**
     * Set cCrea
     *
     * @param float $cCrea
     * @return BloodTest
     */
    public function setCCrea($cCrea)
    {
        $this->cCrea = $cCrea;
    
        return $this;
    }

    /**
     * Get cCrea
     *
     * @return float 
     */
    public function getCCrea()
    {
        return $this->cCrea;
    }

    /**
     * Set cDBil
     *
     * @param float $cDBil
     * @return BloodTest
     */
    public function setCDBil($cDBil)
    {
        $this->cDBil = $cDBil;
    
        return $this;
    }

    /**
     * Get cDBil
     *
     * @return float 
     */
    public function getCDBil()
    {
        return $this->cDBil;
    }

    /**
     * Set cGct
     *
     * @param float $cGct
     * @return BloodTest
     */
    public function setCGct($cGct)
    {
        $this->cGct = $cGct;
    
        return $this;
    }

    /**
     * Get cGct
     *
     * @return float 
     */
    public function getCGct()
    {
        return $this->cGct;
    }

    /**
     * Set cGluc
     *
     * @param float $cGluc
     * @return BloodTest
     */
    public function setCGluc($cGluc)
    {
        $this->cGluc = $cGluc;
    
        return $this;
    }

    /**
     * Get cGluc
     *
     * @return float 
     */
    public function getCGluc()
    {
        return $this->cGluc;
    }

    /**
     * Set cLd
     *
     * @param float $cLd
     * @return BloodTest
     */
    public function setCLd($cLd)
    {
        $this->cLd = $cLd;
    
        return $this;
    }

    /**
     * Get cLd
     *
     * @return float 
     */
    public function getCLd()
    {
        return $this->cLd;
    }

    /**
     * Set cTBil
     *
     * @param float $cTBil
     * @return BloodTest
     */
    public function setCTBil($cTBil)
    {
        $this->cTBil = $cTBil;
    
        return $this;
    }

    /**
     * Get cTBil
     *
     * @return float 
     */
    public function getCTBil()
    {
        return $this->cTBil;
    }

    /**
     * Set cStp
     *
     * @param float $cStp
     * @return BloodTest
     */
    public function setCStp($cStp)
    {
        $this->cStp = $cStp;
    
        return $this;
    }

    /**
     * Get cStp
     *
     * @return float 
     */
    public function getCStp()
    {
        return $this->cStp;
    }

    /**
     * Set cUn
     *
     * @param float $cUn
     * @return BloodTest
     */
    public function setCUn($cUn)
    {
        $this->cUn = $cUn;
    
        return $this;
    }

    /**
     * Get cUn
     *
     * @return float 
     */
    public function getCUn()
    {
        return $this->cUn;
    }

    /**
     * Set cTrig
     *
     * @param float $cTrig
     * @return BloodTest
     */
    public function setCTrig($cTrig)
    {
        $this->cTrig = $cTrig;
    
        return $this;
    }

    /**
     * Get cTrig
     *
     * @return float 
     */
    public function getCTrig()
    {
        return $this->cTrig;
    }

    /**
     * Set cLactate
     *
     * @param float $cLactate
     * @return BloodTest
     */
    public function setCLactate($cLactate)
    {
        $this->cLactate = $cLactate;
    
        return $this;
    }

    /**
     * Get cLactate
     *
     * @return float 
     */
    public function getCLactate()
    {
        return $this->cLactate;
    }

    /**
     * Set cSaa
     *
     * @param float $cSaa
     * @return BloodTest
     */
    public function setCSaa($cSaa)
    {
        $this->cSaa = $cSaa;
    
        return $this;
    }

    /**
     * Get cSaa
     *
     * @return float 
     */
    public function getCSaa()
    {
        return $this->cSaa;
    }

    /**
     * Set cLac
     *
     * @param float $cLac
     * @return BloodTest
     */
    public function setCLac($cLac)
    {
        $this->cLac = $cLac;
    
        return $this;
    }

    /**
     * Get cLac
     *
     * @return float 
     */
    public function getCLac()
    {
        return $this->cLac;
    }

    /**
     * Set cIron
     *
     * @param float $cIron
     * @return BloodTest
     */
    public function setCIron($cIron)
    {
        $this->cIron = $cIron;
    
        return $this;
    }

    /**
     * Get cIron
     *
     * @return float 
     */
    public function getCIron()
    {
        return $this->cIron;
    }

    /**
     * Set cTroponin
     *
     * @param float $cTroponin
     * @return BloodTest
     */
    public function setCTroponin($cTroponin)
    {
        $this->cTroponin = $cTroponin;
    
        return $this;
    }

    /**
     * Get cTroponin
     *
     * @return float 
     */
    public function getCTroponin()
    {
        return $this->cTroponin;
    }

    /**
     * Set cPhos
     *
     * @param float $cPhos
     * @return BloodTest
     */
    public function setCPhos($cPhos)
    {
        $this->cPhos = $cPhos;
    
        return $this;
    }

    /**
     * Get cPhos
     *
     * @return float 
     */
    public function getCPhos()
    {
        return $this->cPhos;
    }

    /**
     * Set cFoal
     *
     * @param float $cFoal
     * @return BloodTest
     */
    public function setCFoal($cFoal)
    {
        $this->cFoal = $cFoal;
    
        return $this;
    }

    /**
     * Get cFoal
     *
     * @return float 
     */
    public function getCFoal()
    {
        return $this->cFoal;
    }

    /**
     * Set eGluc
     *
     * @param float $eGluc
     * @return BloodTest
     */
    public function setEGluc($eGluc)
    {
        $this->eGluc = $eGluc;
    
        return $this;
    }

    /**
     * Get eGluc
     *
     * @return float 
     */
    public function getEGluc()
    {
        return $this->eGluc;
    }

    /**
     * Set eBun
     *
     * @param float $eBun
     * @return BloodTest
     */
    public function setEBun($eBun)
    {
        $this->eBun = $eBun;
    
        return $this;
    }

    /**
     * Get eBun
     *
     * @return float 
     */
    public function getEBun()
    {
        return $this->eBun;
    }

    /**
     * Set eNa
     *
     * @param float $eNa
     * @return BloodTest
     */
    public function setENa($eNa)
    {
        $this->eNa = $eNa;
    
        return $this;
    }

    /**
     * Get eNa
     *
     * @return float 
     */
    public function getENa()
    {
        return $this->eNa;
    }

    /**
     * Set eK
     *
     * @param float $eK
     * @return BloodTest
     */
    public function setEK($eK)
    {
        $this->eK = $eK;
    
        return $this;
    }

    /**
     * Get eK
     *
     * @return float 
     */
    public function getEK()
    {
        return $this->eK;
    }

    /**
     * Set eCl
     *
     * @param float $eCl
     * @return BloodTest
     */
    public function setECl($eCl)
    {
        $this->eCl = $eCl;
    
        return $this;
    }

    /**
     * Get eCl
     *
     * @return float 
     */
    public function getECl()
    {
        return $this->eCl;
    }

    /**
     * Set eHct
     *
     * @param float $eHct
     * @return BloodTest
     */
    public function setEHct($eHct)
    {
        $this->eHct = $eHct;
    
        return $this;
    }

    /**
     * Get eHct
     *
     * @return float 
     */
    public function getEHct()
    {
        return $this->eHct;
    }

    /**
     * Set eHb
     *
     * @param float $eHb
     * @return BloodTest
     */
    public function setEHb($eHb)
    {
        $this->eHb = $eHb;
    
        return $this;
    }

    /**
     * Get eHb
     *
     * @return float 
     */
    public function getEHb()
    {
        return $this->eHb;
    }

    /**
     * Set ePh
     *
     * @param float $ePh
     * @return BloodTest
     */
    public function setEPh($ePh)
    {
        $this->ePh = $ePh;
    
        return $this;
    }

    /**
     * Get ePh
     *
     * @return float 
     */
    public function getEPh()
    {
        return $this->ePh;
    }

    /**
     * Set eBicarb
     *
     * @param float $eBicarb
     * @return BloodTest
     */
    public function setEBicarb($eBicarb)
    {
        $this->eBicarb = $eBicarb;
    
        return $this;
    }

    /**
     * Get eBicarb
     *
     * @return float 
     */
    public function getEBicarb()
    {
        return $this->eBicarb;
    }

    /**
     * Set eMg
     *
     * @param float $eMg
     * @return BloodTest
     */
    public function setEMg($eMg)
    {
        $this->eMg = $eMg;
    
        return $this;
    }

    /**
     * Get eMg
     *
     * @return float 
     */
    public function getEMg()
    {
        return $this->eMg;
    }

    /**
     * Set eCa
     *
     * @param float $eCa
     * @return BloodTest
     */
    public function setECa($eCa)
    {
        $this->eCa = $eCa;
    
        return $this;
    }

    /**
     * Get eCa
     *
     * @return float 
     */
    public function getECa()
    {
        return $this->eCa;
    }

    /**
     * Set eIca
     *
     * @param float $eIca
     * @return BloodTest
     */
    public function setEIca($eIca)
    {
        $this->eIca = $eIca;
    
        return $this;
    }

    /**
     * Get eIca
     *
     * @return float 
     */
    public function getEIca()
    {
        return $this->eIca;
    }

    /**
     * @param float $hBaso2
     */
    public function setHBaso2($hBaso2)
    {
        $this->hBaso2 = $hBaso2;
    }

    /**
     * @return float
     */
    public function getHBaso2()
    {
        return $this->hBaso2;
    }

    /**
     * @param float $hEosino2
     */
    public function setHEosino2($hEosino2)
    {
        $this->hEosino2 = $hEosino2;
    }

    /**
     * @return float
     */
    public function getHEosino2()
    {
        return $this->hEosino2;
    }

    /**
     * @param float $hLymph2
     */
    public function setHLymph2($hLymph2)
    {
        $this->hLymph2 = $hLymph2;
    }

    /**
     * @return float
     */
    public function getHLymph2()
    {
        return $this->hLymph2;
    }

    /**
     * @param float $hMono2
     */
    public function setHMono2($hMono2)
    {
        $this->hMono2 = $hMono2;
    }

    /**
     * @return float
     */
    public function getHMono2()
    {
        return $this->hMono2;
    }

    /**
     * @param float $hNeut2
     */
    public function setHNeut2($hNeut2)
    {
        $this->hNeut2 = $hNeut2;
    }

    /**
     * @return float
     */
    public function getHNeut2()
    {
        return $this->hNeut2;
    }

    /**
     * @return boolean
     */
    public function getCExtra()
    {
        return $this->cExtra;
    }

    /**
     * @param boolean $cExtra
     */
    public function setCExtra($cExtra)
    {
        $this->cExtra = $cExtra;
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
