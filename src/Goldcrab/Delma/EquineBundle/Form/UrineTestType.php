<?php

namespace Goldcrab\Delma\EquineBundle\Form;

use Goldcrab\Delma\EquineBundle\Form\DataTransformer\HorseToNumberTransformer;
use Goldcrab\Delma\EquineBundle\Form\DataTransformer\UserToNumberTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class UrineTestType extends AbstractType
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

        $builder->add('glucose', 'choice', array(
            'choices' => array(
                'Negative' => 'Negative',
                'Trace' => 'Trace',
                'Small-Moderate' => 'Small-Moderate',
                'Large' => 'Large'
            ),
            'required' => false,
            'empty_value' => ''
        ));

        $builder->add('bilirubin', 'choice', array(
            'choices' => array(
                'Negative' => 'Negative',
                'Positive' => 'Positive'
            ),
            'required' => false,
            'empty_value' => ''
        ));

        $builder->add('ketones', 'choice', array(
            'choices' => array(
                'Negative' => 'Negative',
                'Trace' => 'Trace',
                'Small-Moderate' => 'Small-Moderate',
                'Large' => 'Large'
            ),
            'required' => false,
            'empty_value' => ''
        ));

        $builder->add('sgravity', 'choice', array(
            'choices' => array(
                '1.000' => '1.000',
                '1.005' => '1.005',
                '1.010' => '1.010',
                '1.015' => '1.015',
                '1.020' => '1.020',
                '1.025' => '1.025',
                '1.030' => '1.030'
            ),
            'required' => false,
            'empty_value' => ''
        ));

        $builder->add('bloodsang', 'choice', array(
            'choices' => array(
                'Negative' => 'Negative',
                'Trace' => 'Trace',
                '+' => '+',
                '++' => '++',
                '+++' => '+++'
            ),
            'required' => false,
            'empty_value' => ''
        ));

        $builder->add('ph', 'choice', array(
            'choices' => array(
                '5.0' => '5.0',
                '5.5' => '5.5',
                '6.0' => '6.0',
                '6.5' => '6.5',
                '7.0' => '7.0',
                '7.5' => '7.5',
                '8.0' => '8.0',
                '8.5' => '8.5'
            ),
            'required' => false,
            'empty_value' => ''
        ));

        $builder->add('protein', 'choice', array(
            'choices' => array(
                'Negative' => 'Negative',
                'Trace' => 'Trace',
                '+' => '+',
                '++' => '++',
                '+++' => '+++'
            ),
            'required' => false,
            'empty_value' => ''
        ));

        $builder->add('urobilinogen', 'choice', array(
            'choices' => array(
                'Negative' => 'Negative',
                'Positive' => 'Positive'
            ),
            'required' => false,
            'empty_value' => ''
        ));

        $builder->add('nitrates', 'choice', array(
            'choices' => array(
                'Negative' => 'Negative',
                'Positive' => 'Positive'
            ),
            'required' => false,
            'empty_value' => ''
        ));

        $builder->add('leukocytes', 'choice', array(
            'choices' => array(
                'Negative' => 'Negative',
                'Trace' => 'Trace',
                '+' => '+',
                '++' => '++',
                '+++' => '+++'
            ),
            'required' => false,
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
            'data_class' => 'Goldcrab\Delma\EquineBundle\Entity\UrineTest'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'goldcrab_delma_equinebundle_urinetesttype';
    }
}
