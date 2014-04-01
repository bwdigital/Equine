<?php

namespace Goldcrab\Delma\EquineBundle\Form;

use Goldcrab\Delma\EquineBundle\Form\DataTransformer\HorseToNumberTransformer;
use Goldcrab\Delma\EquineBundle\Form\DataTransformer\UserToNumberTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class CytologyTTWTestType extends AbstractType
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

        $builder->add('microscopicEval','textarea',
            array(
                'max_length'=>500,
                'required' => false,
                'label' => 'Address'
            )
        );

        $builder
            ->add('test1')
            ->add('test2')
            ->add('test3')
            ->add('test4')
            ->add('test5')
            ->add('test6')
            ->add('test7')
            ->add('test8')
            ->add('test9')
            ->add('test10')
            ->add('test11')
            ->add('test12');

        $builder->add('cellSamplePrep', 'choice', array(
            'choices' => array(
                'Concentrated' => 'Concentrated',
                'Direct' => 'Direct'
            ),
            'empty_value' => '',
            'required' => false,
            'label' => 'Cell Sample'
        ));

        $builder->add('sampleStain', 'choice', array(
            'choices' => array(
                'Grams' => 'Grams',
                'Wrights' => 'Wrights',
                'Grams & Wrights' => 'Grams & Wrights'
            ),
            'empty_value' => '',
            'required' => false,
            'label' => 'Sample Stain'
        ));

        $builder->add('csaerobic', 'choice', array(
            'choices' => array(
                'Yes' => 'Yes',
                'No' => 'No'
            ),
            'empty_value' => '',
            'required' => false,
            'label' => 'csaerobic'
        ));

        $builder->add('csanaerobic', 'choice', array(
            'choices' => array(
                'Yes' => 'Yes',
                'No' => 'No'
            ),
            'empty_value' => '',
            'required' => false,
            'label' => 'csanaerobic'
        ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Goldcrab\Delma\EquineBundle\Entity\CytologyTTWTest'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'goldcrab_delma_equinebundle_cytologyttwtesttype';
    }
}
