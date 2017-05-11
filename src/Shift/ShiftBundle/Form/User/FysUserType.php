<?php

namespace Shift\ShiftBundle\Form\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Shift\ShiftBundle\Entity\User\FysUser;

class ShiftType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setAction("/shift/create")
            ->setMethod('POST')
            ->add('first_name', TextType::class)
            ->add('last_name', TextType::class)
            ->add('email', EmailType::class)
            ->add('mobile_number', TextType::class)
            ->add('user_type', TextType::class)
            ->add('user_id', TextType::class)
            ->add('house_number', TextType::class)
            ->add('address_line1', TextType::class)
            ->add('address_line2', TextType::class)
            ->add('postcode', TextType::class)
            ->add('country', TextType::class)
            ->add('registration_number', TextType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => FysUser::class
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'shift_shiftbundle_user_fysuser';
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getName()
    {
        return 'app_user_registration';
    }
}
