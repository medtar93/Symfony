<?php

namespace BoutiqueBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType; //Type="text"
use Symfony\Component\Form\Extension\Core\Type\PasswordType; // type="password"
use Symfony\Component\Form\Extension\Core\Type\EmailType; //type="email"
use Symfony\Component\Form\Extension\Core\Type\ChoiceType; //champs select
use Symfony\Component\Form\Extension\Core\Type\CheckboxType; //type="checkbox"
use Symfony\Component\Form\Extension\Core\Type\IntegerType; //type="number"
use Symfony\Component\Form\Extension\Core\Type\SubmitType; //type="submit"
use Symfony\Component\Form\Extension\Core\Type\DateType; //

use Symfony\Component\Validator\Constraints as Assert;
/*
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Type;
*/

class MembreType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 
          
            -> add('prenom', TextType::class, array(
                'required' => false,
                'constraints' => array(
                    new Assert\NotBlank,
                    new Assert\Length(array(
                        'min' => 3,
                        'max' => 20,
                        'minMessage' => 'Le pseudo doit comporter minimum 3 caractères',
                        'maxMessage' => 'Le pseudo doit comporter maximum 20 caractères'
                    ))
                )
            ))
            -> add('nom', TextType::class, array(
                'required' => false,
                'constraints' => array(
                    new Assert\NotBlank,
                    new Assert\Length(array(
                        'min' => 3,
                        'max' => 20,
                        'minMessage' => 'Le pseudo doit comporter minimum 3 caractères',
                        'maxMessage' => 'Le pseudo doit comporter maximum 20 caractères'
                    ))
                )
            ))
            
            -> add('civilite', ChoiceType::class, array(
                'choices' => array(
                    'Homme' => 'm',
                    'Femme' => 'f'
                )
            ))
            -> add('ville', TextType::class, array(
                'required' => false,
                'constraints' => array(
                    new Assert\NotBlank,
                    new Assert\Length(array(
                        'min' => 3,
                        'max' => 20,
                        'minMessage' => 'Le pseudo doit comporter minimum 3 caractères',
                        'maxMessage' => 'Le pseudo doit comporter maximum 20 caractères'
                    ))
                )
            ))
            -> add('code_postal', IntegerType::class, array(
                'required' => false,
                'constraints' => array(
                    new Assert\NotBlank,
                    new Assert\Type(array(
                        'type' => 'integer',
                        'message' => 'Votre code postal doit être composé de chiffres'
                    )),
                    new Assert\Length(array(
                        'min' => 5,
                        'max' => 5,
                        'minMessage' => 'Votre code postal doit être composé de 5 chiffres'
                    ))
                )
            ))
            -> add('adresse', TextType::class, array(
                'required' => false,
                'constraints' => array(
                    new Assert\NotBlank,
                    new Assert\Length(array(
                        'min' => 3,
                        'max' => 50,
                        'minMessage' => 'Le pseudo doit comporter minimum 3 caractères',
                        'maxMessage' => 'Le pseudo doit comporter maximum 20 caractères'
                    ))
                ),
                'attr' => array(
                    'placeholder' => 'Votre Adresse',
                    'class' => 'form-control'
                )
            ));
    }

    public function getPArent(){
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BoutiqueBundle\Entity\Membre'
        ));
    }



    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'boutiquebundle_membre';
    }


}
