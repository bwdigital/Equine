<?php

namespace Goldcrab\Delma\UserBundle\Form;

use FOS\UserBundle\Event\UserEvent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstname','text',
            array(
                'max_length'=>100,
                'required' => true,
                'label' => 'Firstname'
            )
        );

        $builder->add('lastname','text',
            array(
                'max_length'=>100,
                'required' => false,
                'label' => 'Lastname'
            )
        );

        $builder->add('email','email',
            array(
                'max_length'=>100,
                'required' => true,
                'label' => 'Email'
            )
        );

        $builder->add('plainPassword', 'repeated',
            array(
                'type' => 'password',
                'invalid_message' => 'The password fields must match.',
                'options' => array(
                    'attr' => array(
                        'class' => 'password-field'
                    )
                ),
                'required' => false,
                'first_options'  => array(
                    'label' => 'Password'
                ),
                'second_options' => array(
                    'label' => 'Repeat Password'
                ),
            )
        );

        $builder->add('type', 'choice', array(
            'choices' => array(
                'Admin' => 'Admin',
                'Doctor' => 'Doctor',
                'Lab' => 'Lab',
                'Owner' => 'Owner',
                'Trainer' => 'Trainer'
            ),
            'required' => true,
            'empty_value' => '',
            'label' => 'User Type'
        ));

        $builder->add('mobile','text',
            array(
                'max_length'=>20,
                'required' => false,
                'label' => 'Mobile'
            )
        );

        $builder->add('address','textarea',
            array(
                'max_length'=>500,
                'required' => false,
                'label' => 'Address'
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

        $builder->add('country', 'choice', array(
            'choices' => array('AE' => 'United Arab Emirates'),
            'preferred_choices' => array('AE'),
            'label' => 'Country'
        ));

        $builder->add('enabled', 'choice', array(
            'choices'   => array('1' => 'Enabled', '0' => 'Disabled'),
            'required'  => true,
            'label' => 'Enabled'
        ));

        $builder->add('adminType', 'choice', array(
            'choices'   => array('1' => 'Normal', '2' => 'Admin'),
            'required'  => true,
            'label' => 'User Mode'
        ));

        $builder->add('locked', 'choice', array(
            'choices'   => array('1' => 'Yes', '0' => 'No'),
            'required'  => true,
            'label' => 'Locked'
        ));


    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Goldcrab\Delma\UserBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'goldcrab_delma_userbundle_usertype';
    }
}
