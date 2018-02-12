<?php

namespace Shift\ShiftBundle\Form\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Shift\ShiftBundle\Entity\Shift\Shift;

class ShiftType extends AbstractType
{
        
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        
        $payLeadTime = $options['payleadtime'];
        $shiftCreatedBy = $options['shiftCreatedBy'];
        $shiftCreatedById = $options['shiftCreatedById'];
        
        $builder->add('org_name', TextType::class)
            ->add('pay_leadtime', HiddenType::class,['data' => $payLeadTime])
            ->add('role_id', TextType::class)
            ->add('role_name', TextType::class)
            ->add('start_date_hours', HiddenType::class)
            ->add('end_date_hours', HiddenType::class)
            ->add('shift_duration', TextType::class)
            ->add('shift_rate', TextType::class)
            ->add('shift_status', TextType::class)
            ->add('shift_created_by', HiddenType::class,['data' => $shiftCreatedBy])
            ->add('shift_created_by_id', HiddenType::class,['data' => $shiftCreatedById]);
           
        if ($options['mode'] != 'create') {
            $builder->add('shift_assigned_employee', TextType::class)
                     ->add('shift_assigned_employee_id', TextType::class)
                     ->add('shift_assigned_resume_id', TextType::class)
                     ->add('shift_assigned_phone', TextType::class)
                     ->add('shift_assigned_email', TextType::class);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => Shift::class,
                'mode' => null,
                'payleadtime' => 5,
                'shiftCreatedBy' => null,
                'shiftCreatedById' => null,
            )
        );
    }
}
