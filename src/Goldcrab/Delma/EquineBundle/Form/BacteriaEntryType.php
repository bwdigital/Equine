<?php

namespace Goldcrab\Delma\EquineBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BacteriaEntryType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('antibiotics','text',
            array(
                'max_length'=>200,
                'required' => false,
                'attr' => array('readonly' => 'readonly','tabindex' => -1,'style' => 'width:300px;'),
                'label' => 'Antibiotics'
            )
        );

        $builder->add('code','text',
            array(
                'max_length'=>50,
                'required' => false,
                'attr' => array('readonly' => 'readonly','tabindex' => -1,'style' => 'width:50px;'),
                'label' => 'Code'
            )
        );

        $builder->add('test1', 'choice', array(
            'choices' => array(
                'S' => 'S',
                'I' => 'I',
                'R' => 'R'
            ),
            'empty_value' => '',
            'required' => false,
            'attr' => array('tabindex' => 10,'style' => 'width:80px;'),
            'label' => 'Test 1'
        ));

        $builder->add('test2', 'choice', array(
            'choices' => array(
                'S' => 'S',
                'I' => 'I',
                'R' => 'R'
            ),
            'empty_value' => '',
            'required' => false,
            'attr' => array('tabindex' => 11, 'style' => 'width:80px;'),
            'label' => 'Test 2'
        ));

        $builder->add('test3', 'choice', array(
            'choices' => array(
                'S' => 'S',
                'I' => 'I',
                'R' => 'R'
            ),
            'empty_value' => '',
            'required' => false,
            'attr' => array('tabindex' => 12, 'style' => 'width:80px;'),
            'label' => 'Test 3'
        ));

        $builder->add('test4', 'choice', array(
            'choices' => array(
                'S' => 'S',
                'I' => 'I',
                'R' => 'R'
            ),
            'empty_value' => '',
            'required' => false,
            'attr' => array('tabindex' => 13, 'style' => 'width:80px;'),
            'label' => 'Test 4'
        ));

        $builder->add('test5', 'choice', array(
            'choices' => array(
                'S' => 'S',
                'I' => 'I',
                'R' => 'R'
            ),
            'empty_value' => '',
            'required' => false,
            'attr' => array('tabindex' => 14, 'style' => 'width:80px;'),
            'label' => 'Test 5'
        ));

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Goldcrab\Delma\EquineBundle\Entity\BacteriaEntry'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'goldcrab_delma_equinebundle_bacteriaEntry';
    }
}
