<?php

namespace Goldcrab\Delma\EquineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GlucoseEntry
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Goldcrab\Delma\EquineBundle\Entity\GlucoseEntryRepository")
 */
class GlucoseEntry
{
    /**
     * @var integer
     *
     * @ORM\Column(name="glucose_value_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

//* @ORM\JoinColumn(name="entry_glucose_id", referencedColumnName="glucose_id")

    /**
     * @var GlucoseTest
     *
     * @ORM\ManyToOne(targetEntity="GlucoseTest",inversedBy="testValues")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE", referencedColumnName="glucose_id")
     *
     */
    private $glucoseTest;

    /**
     * @var integer
     *
     * @ORM\Column(name="time", type="integer")
     */
    private $time;

    /**
     * @var float
     *
     * @ORM\Column(name="value", type="float")
     */
    private $value;

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
     * @param \Goldcrab\Delma\EquineBundle\Entity\GlucoseTest $glucoseTest
     */
    public function setGlucoseTest($glucoseTest)
    {
        $this->glucoseTest = $glucoseTest;
    }

    /**
     * @return \Goldcrab\Delma\EquineBundle\Entity\GlucoseTest
     */
    public function getGlucoseTest()
    {
        return $this->glucoseTest;
    }

    /**
     * Set time
     *
     * @param integer $time
     * @return GlucoseEntry
     */
    public function setTime($time)
    {
        $this->time = $time;
    
        return $this;
    }

    /**
     * Get time
     *
     * @return integer 
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set value
     *
     * @param float $value
     * @return GlucoseEntry
     */
    public function setValue($value)
    {
        $this->value = $value;
    
        return $this;
    }

    /**
     * Get value
     *
     * @return float 
     */
    public function getValue()
    {
        return $this->value;
    }
}
