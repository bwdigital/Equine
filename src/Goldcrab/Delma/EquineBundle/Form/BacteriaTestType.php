<?php

namespace Goldcrab\Delma\EquineBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Goldcrab\Delma\EquineBundle\Form\DataTransformer\HorseToNumberTransformer;
use Goldcrab\Delma\EquineBundle\Form\DataTransformer\UserToNumberTransformer;
use Doctrine\ORM\EntityManager;

class BacteriaTestType extends AbstractType
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
        $horseTransformer = new HorseToNumberTransformer($this->em);
        $builder->add(
            $builder->create('horse', 'text',array(
                'attr' => array(
                    'style' => "width:80%",
                    'class' => 'horseAutoCompleteSelector',
                    'data-stableInfo' => '1'
                ),
                'required' => false,
                'label' => 'Name'
            ))->addModelTransformer($horseTransformer)
        );


        $userTransformer = new UserToNumberTransformer($this->em);
        $builder->add(
            $builder->create('doctor', 'text',array(
                'attr' => array(
                    'style' => "width:80%",
                    'class' => 'userAutoCompleteSelector',
                    'data-userType' => 'Doctor'
                ),
                'required' => false,
                'label' => 'Doctor'
            ))->addModelTransformer($userTransformer)
        );

        $builder->add(
            $builder->create('testedBy', 'text',array(
                'attr' => array(
                    'style' => "width:80%",
                    'class' => 'userAutoCompleteSelector',
                    'data-userType' => 'Lab'
                ),
                'required' => false,
                'label' => 'Tested By'
            ))->addModelTransformer($userTransformer)
        );

        $builder->add('testedDate','date',
            array(
                'widget' => 'single_text',
                'required' => false,
                'format' => 'yyyy-MM-dd HH:mm',
                'label' => 'Tested Date',
                'attr' => array('class' => 'date')
            )
        );

        $builder->add('sampleDate','date',
            array(
                'widget' => 'single_text',
                'required' => false,
                'format' => 'yyyy-MM-dd HH:mm',
                'label' => 'Sample Date',
                'attr' => array('class' => 'date', 'tabindex' => 5)
            )
        );

        $builder->add('swabSource','text',
            array(
                'max_length'=>250,
                'required' => false,
                'label' => 'Swab Source',
                'attr' => array('tabindex' => 8)
            )
        );

        $builder->add('gramStain','text',
            array(
                'max_length'=>250,
                'required' => false,
                'label' => 'Gram Stain',
                'attr' => array('tabindex' => 6)
            )
        );

        $builder->add('bacteriaIsolation','text',
            array(
                'max_length'=>250,
                'required' => false,
                'label' => 'Bacteria Isolation',
                'attr' => array('tabindex' => 9)
            )
        );

        $builder->add('fungiIsolation','text',
            array(
                'max_length'=>250,
                'required' => false,
                'label' => 'Fungi Isolation',
                'attr' => array('tabindex' => 7)

            )
        );

        $builder->add('testValues', 'collection', array(
            'type'         => new BacteriaEntryType(),
            'allow_add'    => true,
            'allow_delete'    => true,
        ));

        $builder->add('comments','textarea',
            array(
                'max_length'=>500,
                'required' => false,
                'label' => 'Address',
                'attr' => array('tabindex' => 22)
            )
        );

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Goldcrab\Delma\EquineBundle\Entity\BacteriaTest'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'goldcrab_delma_equinebundle_bacteriatest';
    }
}
