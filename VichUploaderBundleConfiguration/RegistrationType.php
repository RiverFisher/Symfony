<?php

namespace Management\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\Common\Persistence\ObjectManager;

class RegistrationType extends AbstractType {
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

//        $transformer = new AvailabilityDataTransformer();

        $builder
//            ->add('username', TextType::class, array(
//                'label' => 'Имя пользователя',
//                'label_attr' => [
//                    'class' => 'control-label'
//                ],
//                'required' => true,
//                'attr' => [
//                    'class' => 'form-control'
//                ]
//            ))
            ->add('email', EmailType::class, array(
                'label' => 'Электронная почта',
                'label_attr' => [
                    'class' => 'control-label'
                ],
                'required' => true,
                'attr' => [
                    'class' => 'form-control'
                ],
//                'error_bubbling' => true,
                'invalid_message' => 'Адрес электронной почты не действителен'
            ))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array(
                    'label' => 'Введите пароль',
                    'label_attr' => [
                        'class' => 'control-label'
                    ],
                    'required' => true,
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ),
                'second_options' => array(
                    'label' => 'Повторите ввод пароля',
                    'label_attr' => [
                        'class' => 'control-label'
                    ],
                    'required' => true,
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ),
            ))
//            ->add('fullName', TextType::class, array(
//                'label' => 'Полное имя',
//                'label_attr' => [
//                    'class' => 'control-label'
//                ],
//                'required' => true,
//                'attr' => [
//                    'class' => 'form-control'
//                ]
//            ))
            ->add('firstName', TextType::class, array(
                'label' => 'Имя',
                'required' => true,
                'attr' => [
                    'class' => 'form-control'
                ]
            ))
//            ->add('middleName', TextType::class, array(
//                'label' => 'Отчество',
//                'label_attr' => [
//                    'class' => 'control-label'
//                ],
//                'required' => false,
//                'attr' => [
//                    'class' => 'form-control'
//                ]
//            ))
            ->add('lastName', TextType::class, array(
                'label' => 'Фамилия',
                'required' => true,
                'attr' => [
                    'class' => 'form-control'
                ]
            ))
            ->add('profileImageFile', VichImageType::class, array(
                'label' => 'Фото профиля',
                'required' => false
            ))
            ->add('country', EntityType::class, array(
                'label' => 'Страна',
                'attr' => array(
                    'class' => 'form-control'
                ),
                'class' => 'Geo\LocationBundle\Entity\Country',
                'choice_label' => 'name',
                'mapped' => false,
                'required' => true
            ))
            ->add('city', EntityType::class, array(
                'label' => 'Город',
                'attr' => array(
                    'class' => 'form-control'
                ),
                'class' => 'Geo\LocationBundle\Entity\City',
                'choice_label' => 'name',
                'required' => true
            ))
            ->add('phoneNumber', TextType::class, array(
                'label' => 'Номер телефона',
                'label_attr' => [
                    'class' => 'control-label'
                ],
                'required' => true,
                'attr' => [
                    'class' => 'form-control'
                ]
            ))
//            ->add('phoneNumber', PhoneNumberType::class, array(
//                'label' => 'Номер телефона',
//                'label_attr' => [
//                    'class' => 'control-label'
//                ],
//                'default_region' => 'RU',
//                'format' => PhoneNumberFormat::NATIONAL,
//                'required' => true,
//                'attr' => [
//                    'class' => 'form-control'
//                ]
//            ))
            ->add('dateOfBirth', DateType::class, array(
                'label' => 'Дата рождения',
                'label_attr' => [
                    'class' => 'control-label'
                ],
                'required' => true,
                'widget' => 'single_text',
                //'format' => 'yyyy-MM-dd',
                'attr' => [
                    'class' => 'form-control fdatepicker'
                ]
            ))
            ->add('sex', ChoiceType::class, array(
                'label' => 'Пол',
                'label_attr' => [
                    'class' => 'control-label'
                ],
                'choices_as_values' => true,
                'attr' => [
                    'class' => 'form-control'
                ],
                'choices'  => array(
                    'Мужской'   => 'Мужской',
                    'Женский'   => 'Женский'
                ),
            ))
            ->add('skillLevel', EntityType::class, array(
                'label' => 'Уровень мастерства',
                'attr' => array(
                    'class' => 'form-control small-10 large-10',
                    'style' => ''
                ),
                'class' => 'SocialNetwork\TournamentsBundle\Entity\SkillLevel',
                'choice_label' => 'rating',
                'required' => true
            ))
            ->add('experience', IntegerType::class, array(
                'label' => 'Игровой опыт',
                'label_attr' => [
                    'class' => 'control-label'
                ],
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'min' => 0,
                    'max' => 70
                ]
            ))
            ->add('tennisClub', TextType::class, array(
                'label' => 'Теннисный клуб',
                'label_attr' => [
                    'class' => 'control-label'
                ],
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ))
//            ->add('availability', ChoiceType::class, array(
//                'label' => 'Доступность',
//                'label_attr' => [
//                    'class' => 'control-label'
//                ],
//                'choices_as_values' => true,
//                'multiple' => true,
//                'attr' => [
//                    'class' => 'form-control'
//                ],
//                'choices' => array(
//                    '' => 'Не указано',
//                    'Будние дни / выходные дни' => array(
//                        'Будние дни' => 'Будние дни',
//                        'Выходные дни' => 'Выходные дни',
//                    ),
//                    'Временной диапазон' => array(
//                        'с 7 до 12 часов' => 'с 7 до 12 часов',
//                        'с 12 до 18 часов' => 'с 12 до 18 часов',
//                        'с 18 до 23 часов' => 'с 18 до 23 часов'
//                    ),
//                ),
//            ))
//            ->add('aWeekdaysFrom', TimeType::class, array(
            ->add('aWeekdaysFrom', IntegerType::class, array(
                'label'  => 'с',
                'required' => false,
                'attr' => [
                    'class' => 'form-control small-3 large-3',
                    'min' => 0,
                    'max' => 23
                ]
//                'input'  => 'datetime',
//                'widget' => 'single_text',
            ))
//            ->add('aWeekdaysTo', TimeType::class, array(
            ->add('aWeekdaysTo', IntegerType::class, array(
                'label'  => 'по',
                'required' => false,
                'attr' => [
                    'class' => 'form-control small-3 large-3',
                    'min' => 1,
                    'max' => 24
                ]
//                'input'  => 'datetime',
//                'widget' => 'single_text',
            ))
//            ->add('aWeekendFrom', TimeType::class, array(
            ->add('aWeekendFrom', IntegerType::class, array(
                'label'  => 'с',
                'required' => false,
                'attr' => [
                    'class' => 'form-control small-3 large-3',
                    'min' => 0,
                    'max' => 23
                ]
//                'input'  => 'datetime',
//                'widget' => 'single_text',
            ))
//            ->add('aWeekendTo', TimeType::class, array(
            ->add('aWeekendTo', IntegerType::class, array(
                'label'  => 'по',
                'required' => false,
                'attr' => [
                    'class' => 'form-control small-3 large-3',
                    'min' => 1,
                    'max' => 24
                ]
//                'input'  => 'datetime',
//                'widget' => 'single_text',
            ))
            ->add('briefInfo', TextType::class, array(
                'label' => 'О себе (краткий текст)',
                'label_attr' => [
                    'class' => 'control-label'
                ],
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ))
        ;

//        $builder->get('availability')
//            ->addModelTransformer($transformer);
////            ->addModelTransformer(new CallbackTransformer(
////                function ($tagsAsArray) {
////                    var_dump($tagsAsArray);
////                    // transform the array to a string
////                    return implode(', ', $tagsAsArray);
////                },
////                function ($tagsAsString) {
////                    var_dump($tagsAsString);
////                    // transform the string back to an array
////                    return explode(', ', $tagsAsString);
////                }
////            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Management\AdminBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
//        return 'management_adminbundle_user';
        return 'app_user_registration';
    }

//    public function getParent() {
//        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
//    }
}
