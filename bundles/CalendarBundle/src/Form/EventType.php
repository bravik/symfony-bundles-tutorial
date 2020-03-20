<?php

namespace bravik\CalendarBundle\Form;

use bravik\CalendarBundle\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Название'
            ])
            ->add('startsAt', DateTimeType::class, [
                'label' => 'Начало',
                'widget' => 'single_text',
            ])
            ->add('endsAt', DateTimeType::class, [
                'label' => 'Конец',
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('description', TextType::class, ['label' => 'Описание'])
            ->add('venueName', TextType::class, ['label' => 'Место'])
            ->add('venueAddress', TextType::class, ['label' => 'Адрес'])
            ->add('archived', CheckboxType::class, [
                'label' => 'В архиве',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
