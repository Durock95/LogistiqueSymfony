<?php

namespace App\Form;

use App\Entity\PointDeVente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PointDeVenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('enseigne', TextType::class, ['label' => "Enseigne"])
            ->add('nom', TextType::class, ['label' => "Nom"])
            ->add('reference', TextType::class, ['label' => "Référence"])
            ->add('adresse', TextType::class, ['label' => "Adresse"])
            ->add('codePostal', TextType::class, ['label' => "Code Postal"])
            ->add('ville', TextType::class, ['label' => "Ville"])
            ->add('telephone', TextType::class, ['label' => "Numéro"])
            ->add('estActif', CheckboxType::class, ['label' => "Actif"])
            ->add('submit', SubmitType::class, ['label' => "Valider"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PointDeVente::class,
        ]);
    }
}
