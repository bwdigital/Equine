<?php

namespace Goldcrab\Delma\EquineBundle\Form;

use Goldcrab\Delma\EquineBundle\Form\DataTransformer\HorseToNumberTransformer;
use Goldcrab\Delma\EquineBundle\Form\DataTransformer\UserToNumberTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityManager;


class BloodTestType extends AbstractType
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
                    'data-stableInfo' => '1',
                    'tabindex' => 1
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
                    'data-userType' => 'Doctor',
                    'tabindex' => 3
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
                    'data-userType' => 'Lab',
                    'tabindex' => 4
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
                'attr' => array('class' => 'date','tabindex' => 2)

            )
        );

        $builder->add('hWbc','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '0.0',
                    'data-vMax' => '99.9',
                    'tabindex' => 5
                )
            )
        );

        $builder->add('hRbc','text',
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

        $builder->add('hHb','text',
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

        $builder->add('hHct','text',
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

        $builder->add('hMch','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'readonly' => 'readonly',
                    'tabindex' => -1
                )
            )
        );

        $builder->add('hMcv','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'readonly' => 'readonly',
                    'tabindex' => -1
                )
            )
        );

        $builder->add('hMchc','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'readonly' => 'readonly',
                    'tabindex' => -1
                )
            )
        );

        $builder->add('hPlt','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '0.0',
                    'data-vMax' => '9999.9',
                    'tabindex' => 10
                )
            )
        );

        $builder->add('hNeut','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '0',
                    'data-vMax' => '99',
                    'tabindex' => 11
                )
            )
        );


        $builder->add('hNeut2','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'readonly' => 'readonly',
                    'tabindex' => -1
                )
            )
        );


        $builder->add('hLymph','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '0',
                    'data-vMax' => '99',
                    'tabindex' => 12
                )
            )
        );


        $builder->add('hLymph2','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'readonly' => 'readonly',
                    'tabindex' => -1
                )
            )
        );


        $builder->add('hMono','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '0',
                    'data-vMax' => '99',
                    'tabindex' => 13
                )
            )
        );


        $builder->add('hMono2','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'readonly' => 'readonly',
                    'tabindex' => -1
                )
            )
        );


        $builder->add('hEosino','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '0',
                    'data-vMax' => '99',
                    'tabindex' => 14
                )
            )
        );


        $builder->add('hEosino2','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'readonly' => 'readonly',
                    'tabindex' => -1
                )
            )
        );


        $builder->add('hBaso','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '0',
                    'data-vMax' => '99',
                    'tabindex' => 15
                )
            )
        );


        $builder->add('hBaso2','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'readonly' => 'readonly',
                    'tabindex' => -1
                )
            )
        );

        $builder->add('hBands','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '0',
                    'data-vMax' => '99',
                    'tabindex' => 16
                )
            )
        );

        $builder->add('hPtp','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '00.0',
                    'data-vMax' => '99.9',
                    'tabindex' => 17
                )
            )
        );

        $builder->add('hHpFib','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '0000',
                    'data-vMax' => '9999',
                    'tabindex' => 18
                )
            )
        );

        $builder->add('cAlb','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '-1.0',
                    'data-vMax' => '9.9',
                    'tabindex' => 19
                )
            )
        );

        $builder->add('cAlp','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '-1',
                    'data-vMax' => '9999',
                    'tabindex' => 20
                )
            )
        );

        $builder->add('cAst','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '-1',
                    'data-vMax' => '999999',
                    'tabindex' => 21
                )
            )
        );

        $builder->add('cCk','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '-1',
                    'data-vMax' => '9999999',
                    'tabindex' => 22
                )
            )
        );




        $builder->add('cCrea','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '-1.0',
                    'data-vMax' => '99.9',
                    'tabindex' => 23
                )
            )
        );

        $builder->add('cDBil','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '-1.0',
                    'data-vMax' => '99.9',
                    'tabindex' => 24
                )
            )
        );

        $builder->add('cGct','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '-1',
                    'data-vMax' => '9999',
                    'tabindex' => 25
                )
            )
        );

        $builder->add('cGluc','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '-1',
                    'data-vMax' => '999',
                    'tabindex' => 26
                )
            )
        );

        $builder->add('cLd','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '-1',
                    'data-vMax' => '999999',
                    'tabindex' => 27
                )
            )
        );


        $builder->add('cTBil','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '-1.0',
                    'data-vMax' => '99.9',
                    'tabindex' => 28
                )
            )
        );

        $builder->add('cStp','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '-1.0',
                    'data-vMax' => '99.9',
                    'tabindex' => 29
                )
            )
        );

        $builder->add('cUn','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '-1',
                    'data-vMax' => '9999',
                    'tabindex' => 30
                )
            )
        );

        $builder->add('cTrig','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '-1',
                    'data-vMax' => '9999',
                    'tabindex' => 50
                )
            )
        );

        $builder->add('cLactate','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '00.00',
                    'data-vMax' => '99.99',
                    'tabindex' => 50
                )
            )
        );

        $builder->add('cSaa','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '-1.00',
                    'data-vMax' => '99999.99',
                    'tabindex' => 50
                )
            )
        );

        $builder->add('cLac','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '-1.00',
                    'data-vMax' => '99.99',
                    'tabindex' => 50
                )
            )
        );

        $builder->add('cIron','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '-1.0',
                    'data-vMax' => '99.9',
                    'tabindex' => 50
                )
            )
        );

        $builder->add('cTroponin','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '-1.00',
                    'data-vMax' => '99.99',
                    'tabindex' => 50
                )
            )
        );

        $builder->add('cPhos','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '-1.0',
                    'data-vMax' => '99.9',
                    'tabindex' => 50
                )
            )
        );




        $builder
            ->add('cFoal');

        $builder->add('cExtra', 'checkbox', array(
            'label'     => 'Show this entry publicly?',
            'required'  => false,
        ));


        $builder->add('eGluc','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '-1',
                    'data-vMax' => '999',
                    'tabindex' => 33
                )
            )
        );

        $builder->add('eBun','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '-1',
                    'data-vMax' => '999',
                    'tabindex' => 34
                )
            )
        );

        $builder->add('eNa','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '-1',
                    'data-vMax' => '999',
                    'tabindex' => 35
                )
            )
        );

        $builder->add('eK','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '-1.0',
                    'data-vMax' => '99.9',
                    'tabindex' => 36
                )
            )
        );

        $builder->add('eCl','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '-1',
                    'data-vMax' => '999',
                    'tabindex' => 37
                )
            )
        );



        $builder->add('eHct','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '-1.0',
                    'data-vMax' => '99.9',
                    'tabindex' => 38
                )
            )
        );

        $builder->add('eHb','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '-1.0',
                    'data-vMax' => '99.9',
                    'tabindex' => 39
                )
            )
        );

        $builder->add('ePh','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '-1.00',
                    'data-vMax' => '99.999',
                    'tabindex' => 40
                )
            )
        );

        $builder->add('eBicarb','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '-1',
                    'data-vMax' => '99.99',
                    'tabindex' => 41
                )
            )
        );

        $builder->add('eMg','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '-1.0',
                    'data-vMax' => '99.9',
                    'tabindex' => 42
                )
            )
        );

        $builder->add('eCa','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '-1.0',
                    'data-vMax' => '99.9',
                    'tabindex' => 43
                )
            )
        );

        $builder->add('eIca','text',
            array(
                'max_length'=>100,
                'required' => false,
                'attr' => array(
                    'class' => 'formatInput',
                    'data-vMin' => '-1.0',
                    'data-vMax' => '9.99',
                    'tabindex' => 44
                )
            )
        );

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
            'data_class' => 'Goldcrab\Delma\EquineBundle\Entity\BloodTest'
        ));

    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'goldcrab_delma_equinebundle_bloodtesttype';
    }
}
