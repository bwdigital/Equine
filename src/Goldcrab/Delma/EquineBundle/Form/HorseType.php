<?php

namespace Goldcrab\Delma\EquineBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityManager;
use Goldcrab\Delma\EquineBundle\Form\DataTransformer\UserToNumberTransformer;
use Doctrine\ORM\EntityRepository;

class HorseType extends AbstractType
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

        $builder->add('alternateName','text',
            array(
                'max_length'=>100,
                'required' => false,
                'label' => 'Alternate Name'
            )
        );

        $userTransformer = new UserToNumberTransformer($this->em);
        $builder->add(
            $builder->create('owner', 'text',array(
                'attr' => array(
                    'style' => "width:80%",
                    'class' => 'userAutoCompleteSelector',
                    'data-userType' => 'Owner'
                ),
                'required' => false,
                'label' => 'Horse Owner'
            ))->addModelTransformer($userTransformer)
        );

        $user2Transformer = new UserToNumberTransformer($this->em);
        $builder->add(
            $builder->create('trainer', 'text',array(
                'attr' => array(
                    'style' => "width:80%",
                    'class' => 'userAutoCompleteSelector',
                    'data-userType' => 'Trainer'
                ),
                'required' => false,
                'label' => 'Trainer'
            ))->addModelTransformer($user2Transformer)
        );


        $builder->add('breed', 'entity', array(
            'class' => 'DelmaEquineBundle:Breed',
            'property' => 'name',
            'required' => false,
            'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('b')
                    ->orderBy('b.name', 'ASC');
            },
            'empty_value' => '',
            'label' => 'Breed'
        ));

        $builder->add('stable', 'genemu_jqueryselect2_entity', array(
            'class' => 'DelmaEquineBundle:Stable',
            'property' => 'name',
            'required' => true,
            'empty_value' => '',
            'label' => 'Stable'
        ));

        $builder->add('dob','date',
            array(
                'widget' => 'single_text',
                'required' => false,
                'format' => 'yyyy-MM-dd',
                'label' => 'Date of Birth',
                'attr' => array('class' => 'onlyDate')
            )
        );

        $builder->add('gender', 'choice', array(
            'choices' => array(
                'Male' => 'Male',
                'Female' => 'Female',
                'Gelding' => 'Gelding',
                'Mare' => 'Mare',
                'Stallion' => 'Stallion',
                'Colt' => 'Colt',
                'Filly' => 'Filly'
            ),
            'empty_value' => '',
            'required' => false,
            'preferred_choices' => array(''),
            'label' => 'Gender'
        ));

        $builder->add('type', 'choice', array(
            'choices' => array(
                'Flat Race' => 'Flat Race',
                'Endurance' => 'Endurance',
                'Pony' => 'Pony',
                'Show Jumper' => 'Show Jumper',
                'Polo pony' => 'Polo pony',
                'Show Horse' => 'Show Horse',
                'Stallion' => 'Stallion',
                'Pleasure' => 'Pleasure',
                'Broodmare' => 'Broodmare',
                'Weanling' => 'Weanling',
                'Foal (suckling)' => 'Foal (suckling)',
                'Police Horse' => 'Police Horse'
            ),
            'empty_value' => '',
            'required' => false,
            'preferred_choices' => array('-'),
            'label' => 'Type'
        ));

        $builder->add('color', 'choice', array(
            'choices' => array(
                'Bay' => 'Bay',
                'Bay/Brown' => 'Bay/Brown',
                'Bay/Gray' => 'Bay/Gray',
                'Black' => 'Black',
                'Black/White' => 'Black/White',
                'Blue Raon' => 'Blue Raon',
                'Brown' => 'Brown',
                'Brown/Dark' => 'Brown/Dark',
                'Brown/White' => 'Brown/White',
                'Buckskin' => 'Buckskin',
                'Buckskin/White' => 'Buckskin/White',
                'Chestnut/Gray' => 'Chestnut/Gray',
                'Chestnut' => 'Chestnut',
                'Chestnut/Liver' => 'Chestnut/Liver',
                'Chestnut/White' => 'Chestnut/White',
                'Chocolate' => 'Chocolate',
                'Cremello' => 'Cremello',
                'Dark Bay' => 'Dark Bay',
                'Dark Bay/Brown' => 'Dark Bay/Brown',
                'Dark Brown' => 'Dark Brown',
                'Dark Brown/White' => 'Dark Brown/White',
                'Dark Grey' => 'Dark Grey',
                'Dunn' => 'Dunn',
                'GE' => 'GE',
                'Gray' => 'Gray',
                'Gray/White' => 'Gray/White',
                'GREG' => 'GREG',
                'Gruella' => 'Gruella',
                'Overo' => 'Overo',
                'Paint' => 'Paint',
                'Palomino' => 'Palomino',
                'Palomino/White' => 'Palomino/White',
                'Piebald' => 'Piebald',
                'Pinto' => 'Pinto',
                'Red' => 'Red',
                'Red Roan' => 'Red Roan',
                'Red Roan/White' => 'Red Roan/White',
                'Roan' => 'Roan',
                'Roan/Strawberry' => 'Roan/Strawberry',
                'Skewbald' => 'Skewbald',
                'Sorrell' => 'Sorrell',
                'Sorrell/White' => 'Sorrell/White',
                'Spotted' => 'Spotted',
                'Tobiano' => 'Tobiano',
                'UNKNOWN' => 'UNKNOWN',
                'White' => 'White',
                'Yellow' => 'Yellow'
            ),
            'empty_value' => '',
            'required' => false,
            'preferred_choices' => array('-'),
            'label' => 'Type'
        ));


        $builder->add('sire','text',
            array(
                'max_length'=>100,
                'required' => false,
                'label' => 'Sire'
            )
        );

        $builder->add('dam','text',
            array(
                'max_length'=>100,
                'required' => false,
                'label' => 'Dam'
            )
        );

        $builder->add('country', 'genemu_jqueryselect2_country', array(
            'preferred_choices' => array('AE'),
            'label' => 'Country'
        ));


        $builder->add('code','text',
            array(
                'max_length'=>100,
                'required' => false,
                'label' => 'Dam'
            )
        );

        $builder->add('status','text',
            array(
                'max_length'=>100,
                'required' => false,
                'label' => 'Dam'
            )
        );


    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Goldcrab\Delma\EquineBundle\Entity\Horse'
        ));
    }

    public function getName()
    {
        return 'goldcrab_delma_equinebundle_horsetype';
    }
}
