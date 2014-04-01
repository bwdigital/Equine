<?php

namespace Goldcrab\Delma\EquineBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use Goldcrab\Delma\UserBundle\Entity\User;

class UserToNumberTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    /**
     * Transforms an object (User) to a string (number).
     *
     * @param  User|null $horse
     * @return string
     */
    public function transform($horse)
    {
        if (null === $horse) {
            return "";
        }

        return $horse->getId();
    }

    /**
     * Transforms a string (number) to an object (User).
     *
     * @param  string $number
     *
     * @return User|null
     *
     * @throws TransformationFailedException if object (User) is not found.
     */
    public function reverseTransform($number)
    {

        if (!$number) {
            return null;
        }

        $horse = $this->om
            ->getRepository('DelmaUserBundle:User')
            ->findOneBy(array('id' => $number))
        ;

        if (null === $horse) {
            throw new TransformationFailedException(sprintf(
                'An issue with number "%s" does not exist!',
                $number
            ));
        }

        return $horse;
    }
}