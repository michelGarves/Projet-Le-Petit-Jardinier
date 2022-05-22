<?php

namespace App\Form;

use App\Entity\Haie;
use App\Entity\Tailler;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaillerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('longueur')
        ->add('hauteur')
        ->add('idHaie', EntityType::class, [
            'label'=>'Nom haie',
            'class' => Haie::class,
            'choice_label' => 'nom']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tailler::class,
        ]);
    }
}
