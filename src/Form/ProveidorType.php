<?php

namespace App\Form;

use App\Entity\Proveidor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProveidorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $accio = $options['accio'];
        $builder
            ->add('nom', TextType::class)
            ->add('email', EmailType::class)
            ->add('telefon', TelType::class, ['required' => false,])
            ->add('tipusProveidor', ChoiceType::class, [
                'choices' => [
                    'Hotel' => 'Hotel',
                    'Pista' => 'Pista',
                    'Complement' => 'Complement',],])
            ->add('actiu', CheckboxType::class, [
                'label' => "Actiu",
                'required' => false,
            ])
            ->add($accio, SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Proveidor::class,
            'accio' => 'Enviar',
        ]);
    }
}
