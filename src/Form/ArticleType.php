<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('taille', ChoiceType::class, [
                'choices' => $options['taillesDispo'],
                'label' => 'Taille',
                'attr' => [
                    'class' => 'custom-input',

                    'style' => 'border:none;text-align:left;',
                    // Appliquer un style personnalisé au champ de sélection
                ],
            ])
            ->add('quantite', IntegerType::class, ['mapped' => false, 'label' => 'Quantité'])
            ->add('add', SubmitType::class, ['label' => 'Ajout Panier'])
            ->add('selectedSize', HiddenType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([

            'taillesDispo' => [],
        ]);
    }
}