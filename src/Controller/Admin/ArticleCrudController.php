<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title'),
            ImageField::new('image')->setBasePath('images/article')->setUploadDir('public/images/article')->setUploadedFileNamePattern('[slug]-[timestamp].[extension]'),
            TextEditorField::new('content')->onlyOnForms(),
            DateTimeField::new('createdAt')->setFormat('d/M/Y à H:m:s')->hideOnForm(),
            AssociationField::new('category'),
        ];
    }
    
    public function createEntity(string $entityFqcn)
    {
        $article = new $entityFqcn;
        $article->setCreatedAt(new DateTime);
        return $article;
    }
}
