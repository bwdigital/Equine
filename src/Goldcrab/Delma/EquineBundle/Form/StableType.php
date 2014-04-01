<?php

namespace Goldcrab\Delma\EquineBundle\Form;

use Doctrine\ORM\EntityManager;
use Goldcrab\Delma\EquineBundle\Form\DataTransformer\UserToNumberTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class StableType extends AbstractType
{
    /**
     * @var EntityManager $em
     */
    protected $em;

    function __construct( EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('name','text',
            array(
                'max_length'=>100,
                'required' => true,
                'label' => 'Name'
            )

        );

        $builder->add('sgroup', 'choice', array(
            'choices' => array('Racing Stables' => 'Racing Stables'),
            'preferred_choices' => array('Racing Stables'),
            'label' => 'Group'
        ));

        $builder->add('phone','text',
            array(
                'max_length'=>20,
                'required' => false,
                'label' => 'Phone'
            )
        );

        $builder->add('fax','text',
            array(
                'max_length'=>20,
                'required' => false,
                'label' => 'Fax'
            )
        );

        $builder->add('address','textarea',
            array(
                'max_length'=>500,
                'required' => false,
                'label' => 'Address'
            )
        );

        $builder->add('city','text',
            array(
                'max_length'=>20,
                'required' => false,
                'label' => 'City'
            )
        );

        $builder->add('city', 'choice', array(
            'choices' => array(
                'AUH' => 'Abu Dhabi',
                'DXB' => 'Dubai',
                'SHJ' => 'Sharjah',
                'AJM' => 'Ajaman',
                'RAK' => 'Ras Al Khaimah',
                'UAQ' => 'Umm Al Quwain',
                'FUJ' => 'Fujairah'
            ),
            'preferred_choices' => array('DXB'),
            'label' => 'City'
        ));

        $builder->add('country', 'genemu_jqueryselect2_country', array(
            'attr' => array(
                'style' => "width:80%"
            )
        ));

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Goldcrab\Delma\EquineBundle\Entity\Stable'
        ));
    }

    public function getName()
    {
        return 'goldcrab_delma_equinebundle_stabletype';
    }
}
