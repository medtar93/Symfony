<?php

namespace BoutiqueBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use Symfony\Component\Validator\Constraints as Assert;


class ProduitType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('reference', TextType::class, array(
                    'required'      => false,
                    'constraints'    => array(
                        new Assert\NotBlank(array(
                            'message' => 'veuillez remplir ce champs'
                        )),
                        new Assert\Length(array(
                            'min'   => 3,
                            'max'   => 20,
                            'minMessage' => 'Veuillez saisir mini 3 caractères',
                            'maxMessage' => 'Veuillez saisir maxi 20 caractères',  
                        ))
                    )
                 ))
                ->add('categorie', TextType::class,array(
                    'required' => false,
                    'constraints' => array(
                        new Assert\NotBlank(array(
                            'message'=> 'Veuillez, renseigner ce champs'
                        )),
                        new Assert\Length(array(
                            'min' => 3,
                            'minMessage'=> 'Veuillez saisir au min 3 caractères',
                            'max' => 30,
                            'maxMessage' => 'Vous êtes limité à 30 caractères max' 
                        ))

                    )
                ))
                ->add('titre', TextType::class,array(
                    'required' => false))
                ->add('description', TextareaType::class,array(
                    'required' => false))
                ->add('couleur',TextType::class,array(
                    'required' => false))
                ->add('taille',TextType::class,array(
                    'required' => false))
                ->add('public',ChoiceType::class,array(
                    'required' => false,
                    'choices' =>array(
                        'Homme'=>'m',
                        'Femme'=>'f'
                         )
                    ))
                ->add('file', FileType::class, array(
                    'required' => false,
                        'constraints' => array(
                            new Assert\File(array(
                                'maxSize' => '3M',
                                'maxSizeMessage' => 'Veuillez uploader une image de 3 Mo maximum'
                            )),
                        )
                    ))
               
                ->add('prix', MoneyType::class,array(
                    'required' => false))
                ->add('stock',IntegerType::class,array(
                    'required' => false))
                ->add('enregistrer', SubmitType::class);
    }
    
    
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BoutiqueBundle\Entity\Produit'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'boutiquebundle_produit';
    }


}
