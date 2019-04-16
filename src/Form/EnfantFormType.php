<?php


namespace App\Form;


use App\Entity\EnfantProfil;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnfantFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options); // TODO: Change the autogenerated stub
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('dateNaissance', DateType::class)
            ->add('allergie')
            ->add('maladies')
            ->add('traitement')
            ->add('acteDeNaissance', FileType::class, ['label' => 'Acte de naissance (PDF)', 'required' => false])
            ->add('certificatDeGrossesse', FileType::class, ['label' => 'Certificat de grossesse (PDF)', 'required' => false])
            ->add('livretDeFamilleEnfant', FileType::class, ['label' => 'Livret de famille de l\'enfant (PDF)', 'required' => false])
            ->add('autres')
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver); // TODO: Change the autogenerated stub
        $resolver
            ->setDefaults([
                'data_class' => EnfantProfil::class,
                'csrf_protection' => false
            ]);
    }

}