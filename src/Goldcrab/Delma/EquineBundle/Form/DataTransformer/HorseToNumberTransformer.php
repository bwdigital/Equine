<?php

namespace Goldcrab\Delma\EquineBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use Goldcrab\Delma\EquineBundle\Entity\Horse;

class HorseToNumberTransformer implements DataTransformerInterface
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
     * Transforms an object (Horse) to a string (number).
     *
     * @param  Horse|null $horse
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
     * Transforms a string (number) to an object (Horse).
     *
     * @param  string $number
     *
     * @return Horse|null
     *
     * @throws TransformationFailedException if object (Horse) is not found.
     */
    public function reverseTransform($number)
    {

        if (!$number) {
            return null;
        }

        $horse = $this->om
            ->getRepository('DelmaEquineBundle:Horse')
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