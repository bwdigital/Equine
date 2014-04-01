<?php

namespace Goldcrab\Delma\EquineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BacteriaEntry
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Goldcrab\Delma\EquineBundle\Entity\BacteriaEntryRepository")
 */
class BacteriaEntry
{
    /**
     * @var integer
     *
     * @ORM\Column(name="bacteria_value_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var BacteriaTest
     *
     * @ORM\ManyToOne(targetEntity="BacteriaTest",inversedBy="testValues")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE", referencedColumnName="bacteria_id")
     *
     */
    private $bacteriaTest;


    /**
     * @var \string
     *
     * @ORM\Column(name="antibiotics", type="string", length=200, nullable=true)
     */
    private $antibiotics;

    /**
     * @var \string
     *
     * @ORM\Column(name="code", type="string", length=50, nullable=true)
     */
    private $code;

    /**
     * @var \string
     *
     * @ORM\Column(name="test1", type="string", length=5, nullable=true)
     */
    private $test1;

    /**
     * @var \string
     *
     * @ORM\Column(name="test2", type="string", length=5, nullable=true)
     */
    private $test2;

    /**
     * @var \string
     *
     * @ORM\Column(name="test3", type="string", length=5, nullable=true)
     */
    private $test3;

    /**
     * @var \string
     *
     * @ORM\Column(name="test4", type="string", length=5, nullable=true)
     */
    private $test4;

    /**
     * @var \string
     *
     * @ORM\Column(name="test5", type="string", length=5, nullable=true)
     */
    private $test5;

    /**
     * @var \string
     *
     * @ORM\Column(name="test6", type="string", length=5, nullable=true)
     */
    private $test6;

    /**
     * @var \string
     *
     * @ORM\Column(name="test7", type="string", length=5, nullable=true)
     */
    private $test7;

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
     * @return \Goldcrab\Delma\EquineBundle\Entity\BacteriaTest
     */
    public function getBacteriaTest()
    {
        return $this->bacteriaTest;
    }

    /**
     * @param \Goldcrab\Delma\EquineBundle\Entity\BacteriaTest $bacteriaTest
     */
    public function setBacteriaTest($bacteriaTest)
    {
        $this->bacteriaTest = $bacteriaTest;
    }

    /**
     * @param string $antibiotics
     */
    public function setAntibiotics($antibiotics)
    {
        $this->antibiotics = $antibiotics;
    }

    /**
     * @return string
     */
    public function getAntibiotics()
    {
        return $this->antibiotics;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $test1
     */
    public function setTest1($test1)
    {
        $this->test1 = $test1;
    }

    /**
     * @return string
     */
    public function getTest1()
    {
        return $this->test1;
    }

    /**
     * @param string $test2
     */
    public function setTest2($test2)
    {
        $this->test2 = $test2;
    }

    /**
     * @return string
     */
    public function getTest2()
    {
        return $this->test2;
    }

    /**
     * @param string $test3
     */
    public function setTest3($test3)
    {
        $this->test3 = $test3;
    }

    /**
     * @return string
     */
    public function getTest3()
    {
        return $this->test3;
    }

    /**
     * @param string $test4
     */
    public function setTest4($test4)
    {
        $this->test4 = $test4;
    }

    /**
     * @return string
     */
    public function getTest4()
    {
        return $this->test4;
    }

    /**
     * @param string $test5
     */
    public function setTest5($test5)
    {
        $this->test5 = $test5;
    }

    /**
     * @return string
     */
    public function getTest5()
    {
        return $this->test5;
    }

    /**
     * @param string $test6
     */
    public function setTest6($test6)
    {
        $this->test6 = $test6;
    }

    /**
     * @return string
     */
    public function getTest6()
    {
        return $this->test6;
    }

    /**
     * @param string $test7
     */
    public function setTest7($test7)
    {
        $this->test7 = $test7;
    }

    /**
     * @return string
     */
    public function getTest7()
    {
        return $this->test7;
    }


}
