<?php

namespace Goldcrab\Delma\EquineBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GlucoseEntryType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('time', 'text',array(
            'attr' => array(
                'attr' => 'time',
                'readonly' => 'readonly',
                'tabindex' => -1

            ),
            'required' => false
        ));

        $builder->add('value', 'text',array(
            'attr' => array(
                'attr' => 'value'
            ),
            'required' => false
        ));

    }






    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Goldcrab\Delma\EquineBundle\Entity\GlucoseEntry'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'goldcrab_delma_equinebundle_glucoseEntry';
    }
}
