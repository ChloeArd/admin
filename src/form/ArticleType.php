<?php
namespace Chloe\Admin\form;

use Chloe\Admin\Model\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('title')
            ->add('picture', UrlType::class)
            ->add('email');
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(['data_class' => Article::class]);
    }
}