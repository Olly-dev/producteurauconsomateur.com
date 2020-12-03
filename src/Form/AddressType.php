<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Address;
use App\Form\PositionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 *  class AddressType
 * @package App\Form
 */
class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("address", TextType::class)
            ->add("restAddress", TextType::class, ["required" => false])
            ->add("zipCode", TextType::class)
            ->add("city", TextType::class)
            ->add("position", PositionType::class, ["label" => false]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault("data_class", Address::class);
    }
}
