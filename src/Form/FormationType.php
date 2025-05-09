<?php

namespace App\Form;

use App\Entity\Formations;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\{TextType, MoneyType, UrlType, TextareaType};
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class) // titre de la formation
            ->add('description', TextareaType::class) // description de la formation
            ->add('price', MoneyType::class) // prix de la formation
            ->add('imageUrl', UrlType::class) // lien image (url) de la formation
            ->add('category', EntityType::class, [ //catégorie de formation
                'class' => Category::class, 
                'choice_label' => 'name',
                'label' => 'Catégorie'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formations::class,
        ]);
    }
}
