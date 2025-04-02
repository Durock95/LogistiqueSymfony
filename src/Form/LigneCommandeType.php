<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Fournisseur;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LigneCommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('reference')
            ->add('typeConditionnement')
            ->add('quantite', IntegerType::class, [
                
                'label' => 'Quantité'])
            ->add('emplacement')
            ->add('prix')
            ->add('quota')
            ->add('stock')
            ->add('estActif')
            ->add('dateCreation', null, [
                'widget' => 'single_text'
            ])
            ->add('dateMaj', null, [
                'widget' => 'single_text'
            ])
            ->add('imageName')
            ->add('imageSize')
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
'choice_label' => 'id',
            ])
            ->add('fournisseur', EntityType::class, [
                'class' => Fournisseur::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
            // Produit::class,
        ]);
    }
}
