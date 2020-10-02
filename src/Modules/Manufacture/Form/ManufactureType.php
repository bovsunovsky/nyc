<?php

declare(strict_types=1);

namespace App\Modules\Manufacture\Form;

use App\Modules\Manufacture\Dto\ManufactureDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ManufactureType extends AbstractType implements DataMapperInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setAction($options['action'])
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Name',
                ],
            ])
            ->setDataMapper($this);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ManufactureDto::class,
            'empty_data' => null,
        ]);
    }

    public function mapDataToForms($manufactureDto, iterable $forms)
    {
        $forms = iterator_to_array($forms);
        $forms['name']->setData($manufactureDto ? $manufactureDto->getName() : '');
    }

    public function mapFormsToData(iterable $forms, &$manufactureDto)
    {
        $forms = iterator_to_array($forms);
        $manufactureDto = new ManufactureDto($forms['name']->getData());
    }
}
