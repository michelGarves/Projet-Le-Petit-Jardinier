<?php

namespace App\Form;

use App\Entity\Haie;
use App\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HaieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code')
            ->add('nom')
            ->add('prix')
            ->add('categorie', EntityType::class, [
                'label'=>'Categorie haie',
                'class' => Categorie::class,
                'choice_label' => 'libelle'])
            ->add('save', SubmitType::class, array('label' => 'VALIDER'));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Haie::class,
        ]);
    }
}
