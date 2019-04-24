<?php

namespace FormBuilder;

use App\FormBuilder;
use App\StringField;
use App\TextField;
use App\MaxLengthValidator;
use App\NotNullValidator;

/**
 * Class CommentFormBuilder
 * @package FormBuilder
 */
class CommentFormBuilder extends FormBuilder
{
    /**
     * @return mixed|void
     */
    public function build()
    {
        $this->form->add(new StringField([
            'label' => 'Auteur',
            'name' => 'auteur',
            'maxLength' => 50,
            'validators' => [
                new MaxLengthValidator('L\'auteur spécifié est trop long (50 caractères maximum)', 50),
                new NotNullValidator('Merci de spécifier l\'auteur du commentaire'),
            ],
        ]))
            ->add(new TextField([
                'label' => 'Contenu',
                'name' => 'contenu',
                'rows' => 7,
                'cols' => 50,
                'validators' => [
                    new NotNullValidator('Merci de spécifier votre commentaire'),
                ],
            ]));
    }
}