<?php

namespace FormBuilder;

use App\FormBuilder;
use App\StringField;
use App\TextField;
use App\MaxLengthValidator;
use App\NotNullValidator;

/**
 * Class NewsFormBuilder
 * @package FormBuilder
 */
class NewsFormBuilder extends FormBuilder
{
    /**
     * @return mixed|void
     */
    public function build()
    {
        $this->form->add(new StringField([
            'label' => 'Auteur',
            'name' => 'auteur',
            'maxLength' => 20,
            'validators' => [
                new MaxLengthValidator('L\'auteur spécifié est trop long (20 caractères maximum)', 20),
                new NotNullValidator('Merci de spécifier l\'auteur de la news'),
            ],
        ]))
            ->add(new StringField([
                'label' => 'Titre',
                'name' => 'titre',
                'maxLength' => 100,
                'validators' => [
                    new MaxLengthValidator('Le titre spécifié est trop long (100 caractères maximum)', 100),
                    new NotNullValidator('Merci de spécifier le titre de la news'),
                ],
            ]))
            ->add(new TextField([
                'label' => 'Contenu',
                'name' => 'contenu',
                'rows' => 8,
                'cols' => 60,
                'validators' => [
                    new NotNullValidator('Merci de spécifier le contenu de la news'),
                ],
            ]));
    }
}