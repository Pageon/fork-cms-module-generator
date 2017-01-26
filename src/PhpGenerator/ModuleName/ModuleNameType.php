<?php

namespace ModuleGenerator\PhpGenerator\ModuleName;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

final class ModuleNameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'name',
            TextType::class,
            [
                'label' => 'Module name (i.e.: Testimonies)',
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new Regex(
                        [
                            'pattern' => '/^[a-zA-Z_\\x7f-\\xff][a-zA-Z0-9_\\x7f-\\xff]*$/',
                            'message' => 'Invalid module name',
                        ]
                    ),
                ],
            ]
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_module' => ModuleNameDataTransferObject::class,
                'label' => false,
                'required' => true,
            ]
        );
    }
}
