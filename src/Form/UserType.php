<?php

declare(strict_types=1);

namespace App\Form;

use App\Model\User\Gender;
use App\Dto\UserDto;
use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function date;
use function mb_convert_case;
use const MB_CASE_TITLE;

/**
 * Class UserType
 * @package App\Form
 */
class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add(
                'birthday',
                BirthdayType::class,
                [
                    'input'    => 'datetime_immutable',
                    'widget'   => 'single_text',
                    'required' => false,
                    'attr' => [
                        'min' => (new DateTime())->setDate((int)date('Y') - 120, 1, 1)->format('Y-m-d'),
                        'max' => (new DateTime())->setDate((int)date('Y') - 20, 12, 31)->format('Y-m-d'),
                    ]
                ]
            )
            ->add(
                'gender',
                ChoiceType::class,
                [
                    'choices'      => [
                        new Gender(Gender::MALE),
                        new Gender(Gender::FEMALE),
                    ],
                    'expanded'     => true,
                    'choice_name'  => 'name',
                    'choice_value' => 'name',
                    'choice_label' => fn(Gender $gender): string => mb_convert_case($gender->getName(), MB_CASE_TITLE),
                    'label_attr'   => [
                        'class' => 'radio-custom',
                    ],
                ]
            )
            ->add(
                'address',
                TextType::class,
                [
                    'required' => false,
                ]
            )
            ->add(
                'submit',
                SubmitType::class,
                [
                    'label' => 'Create User',
                    'attr' => [
                        'class' => 'btn-success'
                    ]
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => UserDto::class,
            ]
        );
    }
}