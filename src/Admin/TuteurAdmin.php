<?php


namespace App\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class TuteurAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        parent::configureFormFields($form); // TODO: Change the autogenerated stub
        $form
            ->add('nom')
            ->add('prenom')
        ;
    }

    protected function configureListFields(ListMapper $list)
    {
        parent::configureListFields($list); // TODO: Change the autogenerated stub
        $list
            ->addIdentifier('nom')
            ->add('prenom')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        parent::configureDatagridFilters($filter); // TODO: Change the autogenerated stub
        $filter
            ->add('nom')
        ;
    }

}