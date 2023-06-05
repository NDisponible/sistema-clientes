<?php
namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class BuscarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder ->add('idCliente', IntegerType::class);
    }
    public function configureOptions(OptionsResolver $resolver) 
    {
        $resolver->setDefaults([
            //Configure
        ]);
    }
}