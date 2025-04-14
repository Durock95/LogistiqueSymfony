<?php

namespace App\Form;

use App\Entity\Booking;
use App\Entity\EventCat;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ['label' => "Titre"])
            ->add('eventCat', EntityType::class, [
                'class' => EventCat::class,
                'choices' => $options['eventCat'],
                'choice_label' => 'name',
                'label' => "Catégorie d'évènement"
            ])
            ->add('users', EntityType::class, [
                'class' => User::class,
//                'choices' => $options['users'],
//                (User $user) {
//                    $user->getNom();
//                    $user->getPrenom();
//                $allChoices, $currentUser, $user->getId();

                'choice_label' => 'nom',
                'label' => 'Utilisateur'
            ])
            ->add('start', DateTimeType::class, [
        'widget' => 'single_text'
    ])
        ->add('end', DateTimeType::class, [
            'widget' => 'single_text'
        ])
        // ->add('allDay', CheckboxType::class)
        // ->add('backgroundcolor', ColorType::class)
        // ->add('textColor', ColorType::class)
        // ->add('borderColor', ColorType::class)

    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
            'eventCat' => null,
            'users' => null,
        ]);
    }
}
