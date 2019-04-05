<?php


namespace App\Admin;


use App\Entity\EnfantProfil;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class EnfantProfilAdmin extends AbstractAdmin
{

    public function toString($object)
    {
        return $object instanceof EnfantProfil
            ? $object->getPrenom()
            : 'Prénom';
    }

    protected function configureFormFields(FormMapper $form)
    {
        parent::configureFormFields($form); // TODO: Change the autogenerated stub
        $form
            ->add('nom')
            ->add('prenom')
            ->add('date_naissance', null, [
                'label' => 'Sa date de naissance'
            ])
            ->add('allergie')
            ->add('traitement')
            ->add('maladies')
            ->add('autres')
        ;
    }

    protected function configureListFields(ListMapper $list)
    {
        parent::configureListFields($list); // TODO: Change the autogenerated stub
        $list
            ->addIdentifier('nom', null, [
                'route' =>[
                    'name' => 'show'
                ]
            ])
            ->add('prenom')
            ->add('parentt', null, ['associated_property' => 'nom'])
            ->add('date_naissance', null, [
                'label' => 'Sa date de naissance'
            ])
            ->add('allergie')
            ->add('traitement')
            ->add('maladies')
            ->add('autres')
            ->add('actions', 'actions', [
                'actions' => [
                    'edit' => [],
                    'delete' => []
                ]
            ])
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        parent::configureDatagridFilters($filter); // TODO: Change the autogenerated stub
        $filter
            ->add('nom')
            ->add('maladies')
            ->add('traitement')
            ->add('allergie')
        ;
    }

    protected function configureShowFields(ShowMapper $show)
    {
        parent::configureShowFields($show); // TODO: Change the autogenerated stub
        $show
            ->add('nom')
            ->add('prenom')
            ->add('parentt', null, ['associated_property' => 'nom'])
            ->add('date_naissance', null, [
                'label' => 'Sa date de naissance'
            ])
            ->add('allergie')
            ->add('traitement')
            ->add('maladies')
            ->add('autres')
            ->add('created_at', null, [
                'label' => 'Date de Création'
            ])
            ->add('updated_at', null, [
                'label' => 'Date de Modification'
            ])
            ;
    }

}