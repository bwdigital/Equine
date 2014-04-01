<?php

namespace Goldcrab\Delma\EquineBundle\Form;

use Goldcrab\Delma\EquineBundle\Form\DataTransformer\HorseToNumberTransformer;
use Goldcrab\Delma\EquineBundle\Form\DataTransformer\UserToNumberTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class CytologyAFATestType extends AbstractType
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
                'required' => true,
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

        $builder->add('sampleDate','date',
            array(
                'widget' => 'single_text',
                'required' => false,
                'format' => 'yyyy-MM-dd HH:mm',
                'label' => 'Sampled Date',
                'attr' => array('class' => 'date')
            )
        );

        $builder->add('wbc','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '0.0',
                    'data-vMax' => '999999.99',
                    'tabindex' => 5
                )
            )
        );

        $builder->add('pmn','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '0.0',
                    'data-vMax' => '99.9',
                    'tabindex' => 6
                )
            )
        );

        $builder->add('mononucl','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '0.0',
                    'data-vMax' => '99.9',
                    'tabindex' => 7
                )
            )
        );

        $builder->add('tprefrac','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '0.0',
                    'data-vMax' => '99.9',
                    'tabindex' => 8
                )
            )
        );

        $builder->add('ast','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '0.0',
                    'data-vMax' => '99.9',
                    'tabindex' => 9
                )
            )
        );

        $builder->add('ck','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '0.0',
                    'data-vMax' => '99.9',
                    'tabindex' => 10
                )
            )
        );

        $builder->add('glucose','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '0.0',
                    'data-vMax' => '99.9',
                    'tabindex' => 11
                )
            )
        );

        $builder->add('tp','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '0.0',
                    'data-vMax' => '99.9',
                    'tabindex' => 12
                )
            )
        );

        $builder->add('alb','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '0.0',
                    'data-vMax' => '99.9',
                    'tabindex' => 13
                )
            )
        );



        $builder
            ->add('slidePrepared')
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
            ->add('comments');

        $builder->add('csaerobic', 'choice', array(
            'choices' => array(
                'Yes' => 'Yes',
                'No' => 'No'
            ),
            'empty_value' => '',
            'label' => 'csaerobic'
        ));

        $builder->add('csanaerobic', 'choice', array(
            'choices' => array(
                'Yes' => 'Yes',
                'No' => 'No'
            ),
            'empty_value' => '',
            'label' => 'csanaerobic'
        ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Goldcrab\Delma\EquineBundle\Entity\CytologyAFATest'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'goldcrab_delma_equinebundle_cytologyafatesttype';
    }
}
