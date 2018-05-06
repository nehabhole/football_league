<?php

namespace AppBundle\Form;

use AppBundle\Entity\FootballLeague;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FootballTeamType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name',TextType::class,[
                'label'  => 'Team Name',
                'attr'   => [
                    'class'   => 'form-control',
                    'required' => 'true'
                ]])
            ->add('strip',EntityType::class,[
                'class' => FootballLeague::class,
                'choice_label' => 'name',
                'label'  => 'League',
                'choice_value' => 'id',
                'attr'   => [
                    'class'   => 'form-control',
                    'required' => 'true'
                ]])
           ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\FootballTeam'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_footballteam';
    }


}
