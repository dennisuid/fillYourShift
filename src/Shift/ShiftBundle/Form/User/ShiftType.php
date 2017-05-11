<?php

namespace Shift\ShiftBundle\Form\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Shift\ShiftBundle\Entity\Shift\Shift;

class ShiftType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setAction("/user/add")
            ->setMethod('POST')
            ->add('org_name', TextType::class)
            ->add('pay_leadtime', TextType::class)
            ->add('role_id', EmailType::class)
            ->add('role_name', TextType::class)
            ->add('start_date_hours', TextType::class)
            ->add('end_date_hours', TextType::class)
            ->add('shift_duration', TextType::class)
            ->add('shift_rate', TextType::class)
            ->add('shift_job_rate', TextType::class)
            ->add('shift_status', TextType::class)
            ->add('shift_created_by', TextType::class)
            ->add('shift_created_by_id', TextType::class)
            ->add('shift_assigned_employee', TextType::class)
            ->add('shift_assigned_employee_id', TextType::class)
            ->add('shift_assigned_resume_id', TextType::class)
            ->add('shift_assigned_phone', TextType::class)
            ->add('shift_assigned_email', TextType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => Shift::class
            )
        );
    }
}
