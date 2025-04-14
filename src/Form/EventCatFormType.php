<?php

namespace App\Form;

use App\Entity\Booking;
use App\Entity\EventCat;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventCatFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
//            ->add('bookings', EntityType::class, [
//                'class' => Booking::class,
//                'choice_label' => 'bookings',
//                'multiple' => true,
//                'label' => 'Évènement'
//            ])
//            ->add('users', EntityType::class, [
//                'class' => User::class,
//                'choice_label' => 'user',
//                'multiple' => true,
//                'label' => 'Utilisateur'
//            ])
            ->add('submit', SubmitType::class, ['label' => "Valider"])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EventCat::class,
//            'bookings' => null,
//            'users' => null,
        ]);
    }
}
