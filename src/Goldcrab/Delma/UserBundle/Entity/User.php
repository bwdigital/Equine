<?php

namespace Goldcrab\Delma\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation\Exclude;

/**
 * @ORM\Entity
 * @ORM\Table(name="Users")
 * @UniqueEntity("email")
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @var string
     *
     * @ORM\Column(name="user_type", type="string", length=50, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="user_firstname", type="string", length=100, nullable=true)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="user_lastname", type="string", length=100, nullable=true)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="user_mobile", type="string", length=20, nullable=true)
     */
    private $mobile;

    /**
     * @var string
     *
     * @ORM\Column(name="user_address", type="string", length=500, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="user_city", type="string", length=3, nullable=false)
     */
    private $city = 'DXB';

    /**
     * @var string
     *
     * @ORM\Column(name="user_country", type="string", length=3, nullable=false)
     */
    private $country = 'AE';

//    /**
//     * @ORM\OneToMany(targetEntity="Goldcrab\Delma\EquineBundle\Entity\Horse", mappedBy="trainer")
//     * @Exclude
//     */
//    private $trainingStables;

    /**
     * @Exclude
     */
    private $adminType = 1;

    public function __construct()
    {
        parent::__construct();
        // your own logic
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
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    
        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    
        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param string $mobile
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return int
     */
    public function getAdminType()
    {
        if( $this->hasRole(static::ROLE_SUPER_ADMIN) ){
            return 2;
        }
        return 1;
    }

    /**
     * @param int $adminType
     */
    public function setAdminType($adminType){
        $this->addRole(static::ROLE_DEFAULT);
        $this->removeRole(static::ROLE_SUPER_ADMIN);
        if($adminType==2){
            $this->addRole(static::ROLE_SUPER_ADMIN);
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->firstname . ' '. $this->lastname .'';
    }

}
