<?php

namespace Goldcrab\Delma\EquineBundle\Form;

use Goldcrab\Delma\EquineBundle\Form\DataTransformer\HorseToNumberTransformer;
use Goldcrab\Delma\EquineBundle\Form\DataTransformer\UserToNumberTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class FecalTestType extends AbstractType
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

        $transformer = new HorseToNumberTransformer($this->em);

        $builder->add(
            $builder->create('horse', 'text',array(
                'attr' => array(
                    'style' => "width:80%",
                    'class' => 'horseAutoCompleteSelector',
                    'data-stableInfo' => '1'
                ),
                'max_length'=>100,
                'required' => true,
                'label' => 'Name'
            ))->addModelTransformer($transformer)
        );

        $userTransformer = new UserToNumberTransformer($this->em);
        $builder->add(
            $builder->create('doctor', 'text',array(
                'attr' => array(
                    'style' => "width:80%",
                    'class' => 'userAutoCompleteSelector',
                    'data-userType' => 'Doctor'
                ),
                'required' => true,
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
                'required' => true,
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

        $builder
            ->add('anoplocephala')
            ->add('strongyle')
            ->add('parascaris');


        $builder->add('occult', 'choice', array(
            'choices' => array(
                'Negative' => 'Negative',
                'Positive' => 'Positive'
            ),
            'empty_value' => ''
        ));

        $builder->add('clostridium', 'choice', array(
            'choices' => array(
                'Negative' => 'Negative',
                'Positive' => 'Positive'
            ),
            'empty_value' => ''
        ));

        $builder->add('comments','textarea',
            array(
                'max_length'=>500,
                'required' => false,
                'label' => 'Address'
            )
        );


    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Goldcrab\Delma\EquineBundle\Entity\FecalTest'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'goldcrab_delma_equinebundle_fecaltesttype';
    }
}
