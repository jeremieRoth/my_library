<?php

namespace App\Form;

use App\Entity\Series;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserSeriesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
//            ->add('creationDate')
//            ->add('updateDate')
//            ->add('validate')
//            ->add('finished')
//            ->add('status')
//            ->add('bookCategory')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Series::class,
        ]);
    }
}
