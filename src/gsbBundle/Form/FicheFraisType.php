<?php

namespace gsbBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FicheFraisType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder//->add('nbJustificatifs')
                //->add('montantValide')
                //->add('dateModif')
                ->add('mois',\Symfony\Component\Form\Extension\Core\Type\ChoiceType::class,
                        array('choices'=>array('artisan'=>'Artisan', 'entrepreneur'=>'Entrepreneur') , 'expanded'=> false, 'multiple'=>false))
                ->add('annee', \Symfony\Component\Form\Extension\Core\Type\ChoiceType::class);
                //->add('etat')
                //->add('visiteur');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'gsbBundle\Entity\FicheFrais'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'gsbbundle_fichefrais';
    }


}
