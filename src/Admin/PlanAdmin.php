<?php


namespace App\Admin;


use App\Entity\Plan;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class PlanAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $form)
    {
        parent::configureFormFields($form); // TODO: Change the autogenerated stub
        $form
            ->add('heuredebut', null, [
                'label' => 'Le planning commence à '
            ])
            ->add('heuredefin', null, [
                'label' => 'Le planning fini à '
            ])        ;
    }

    protected function configureListFields(ListMapper $list)
    {
        parent::configureListFields($list); // TODO: Change the autogenerated stub
        $list
            ->addIdentifier('id', null, [
                'route' => [
                    'name' => 'show'
                ]
            ])
            ->add('heuredebut', null, [
                'label' => 'Le planning commence à '
            ])
            ->add('heuredefin', null, [
                'label' => 'Le planning fini à '
            ])
            ->add('enfantProfil', null, ['associated_property' => 'nom', 'label' => 'Enfant'])
            ->add('proProfil', null, ['associated_property' => 'nom_entreprise', 'label' => 'Entrprise'])
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
            ->add('id')
        ;
    }

    protected function configureShowFields(ShowMapper $show)
    {
        parent::configureShowFields($show); // TODO: Change the autogenerated stub
        $show
            ->add('id', null, [
                'route' => [
                    'name' => 'show'
                ]
            ])
            ->add('heuredebut', null, [
                'label' => 'Le planning commence à '
            ])
            ->add('heuredefin', null, [
                'label' => 'Le planning fini à '
            ])
            ->add('enfantProfil', null, ['associated_property' => 'nom', 'label' => 'Enfant'])
            ->add('proProfil', null, ['associated_property' => 'nom_entreprise', 'label' => 'Entrprise'])
            ->add('created_at', null, [
                'label' => 'Date de création du planning'
            ])
            ->add('updated_at', null, [
                'label' => 'Date de dernière modification'
            ])
            ;
    }

}